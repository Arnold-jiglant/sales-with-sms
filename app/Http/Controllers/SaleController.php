<?php

namespace App\Http\Controllers;

use App\Events\InventoryChanged;
use App\Inventory;
use App\PaymentType;
use App\Receipt;
use App\Sale;
use App\TempSale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;

class SaleController extends Controller
{

    public function index()
    {
        Gate::authorize('sell-product');
        $products = collect([]);
        $request = Request::capture();
        $inventories = Inventory::unfinished()->orderBy('created_at')->get();
        $title = '';
        foreach ($inventories as $inventory) {
            $products->add($inventory->inventoryProducts()->get()->filter(function ($product) {  //Filter product with qty>0
                return $product->remainingQty > 0;
            }));
        }
        $products = $products->collapse();
        if ($request->has('search')) {  //filter search
            $search = trim($request->get('search'));
            $title = "Search for '$search'";
            $products = $products->filter(function ($product) use ($request, $search) {
                return str_contains(strtolower($product->name), strtolower($search));
            });
        }
        $products = $products->paginate(10);
        return view('sell', compact('products', 'title'));
    }

    //view sales
    public function viewSales()
    {
        Gate::authorize('sell-product');
        $request = Request::capture();
        $title = '';
        if ($request->has('from') && $request->has('to')) {
            if ($request->get('from') > $request->get('to')) return redirect()->back()->with('error', 'From date cant be greater than To date!');
            $title = "From " . $request->get('from') . ' to ' . $request->get('to');
            $receipts = Receipt::whereDate('created_at', '>=', $request->get('from'))->whereDate('created_at', '<=', $request->get('to'))->paginate(10);
        } else {
            $receipts = Receipt::orderByDesc('created_at')->paginate(10);
        }
        return view('view-sales', compact('receipts', 'title'));
    }

    //add sale
    public function add(Request $request)
    {
        Gate::authorize('sell-product');
        $sale = new TempSale([
            'name' => $request->get('name'),
            'inventory_product_id' => $request->get('inventory_product_id'),
            'quantity' => $request->get('quantity'),
            'sellingPrice' => $request->get('sellingPrice'),
            'discount' => $request->get('discountAmount') ?? 0,
            'total' => $request->get('total'),
        ]);

        if (Session::has('sales')) {
            $sales = Session::get('sales');
            $existing = $sales->filter(function ($sale) use ($request) {
                return $sale->inventory_product_id == $request->get('inventory_product_id');
            });
            if ($existing->count() > 0) {
                $existing = $existing->first();
                $remainQty = $sale->inventoryProduct->remainingQty;
                if (($sale->quantity + $existing->quantity) > $remainQty) {
                    return redirect()->back()->with('error', 'Not Enough Quantity in Stock only ' . $remainQty . ' remain!');
                }
                $sale->quantity += $existing->quantity;
                $sale->total = $sale->quantity * ($sale->sellingPrice - $sale->discount);
                $sales = $sales->reject(function ($sale) use ($request) {
                    return $sale->inventory_product_id == $request->get('inventory_product_id');
                });
                $sales->add($sale);
                Session::put('sales', $sales);
                return redirect()->back()->with('success', 'Product (' . $request->get('name') . ')  already exists!, Quantity has been added');
            } else {
                $sales->add($sale);
                Session::put('sales', $sales);
                return redirect()->back();
            }
        } else {
            $sales = collect();
            $sales->add($sale);
            Session::put('sales', $sales);
        }
        return redirect()->back();
    }

    //delete item
    public function delete($id)
    {
        Gate::authorize('sell-product');
        $sales = Session::get('sales')->reject(function ($sale) use ($id) {
            return $sale->inventory_product_id == $id;
        });
        if ($sales->count() > 0) {
            Session::put('sales', $sales);
        } else {
            Session::forget('sales');
        }
        return redirect()->back()->with('success', 'Item Removed');
    }

    //cancel
    public function cancel()
    {
        Gate::authorize('sell-product');
        Session::forget('sales');
        return redirect()->back()->with('success', 'Sale canceled');
    }

    //confirm
    public function confirm(Request $request)
    {
        Gate::authorize('sell-product');
        $this->validate($request, [
            'paymentType' => 'required'
        ]);
        $receipt = Receipt::create([
            'number' => SaleController::generateReceiptNo(),
            'payment_type_code' => $request->get('paymentType'),
            'customer_id' => $request->get('customer_id'),
            'issuer' => auth()->id(),
        ]);
        $sales = Session::get('sales')->transform(function ($sale) {
            return new Sale([
                'inventory_product_id' => $sale->inventory_product_id,
                'quantity' => $sale->quantity,
                'sellingPrice' => $sale->sellingPrice,
                'discount' => $sale->discount,
            ]);
        });
        Session::forget('sales');
        $receipt->sales()->saveMany($sales);
        //TODO Print Receipt
        //TODO GET Inventory attributes by calculation
        return redirect()->back()->with('success', 'Sale complete! Receipt No. (' . $receipt->number . ')');
    }

    //generate receipt number
    static function generateReceiptNo()
    {
        $characters = 'ABCDEFGHIJKLMONPQRSTUVWXYZ1234567890';
        do {
            $number = substr(str_shuffle($characters), 0, 10);
        } while (Receipt::whereNumber($number)->count() > 0);
        return $number;
    }
}
