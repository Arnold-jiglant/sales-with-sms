<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\Product;
use App\Sale;
use App\TempSale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SaleController extends Controller
{
    //TODO change quantity inputs min and step to 0.25
    public function index()
    {
//        Session::forget('sales');
        $products = collect([]);
        $inventories = Inventory::unfinished()->orderBy('created_at')->get();
        foreach ($inventories as $inventory) {
            $products->add($inventory->inventoryProducts()->get());
        }
        $products = $products->collapse()->paginate(10);
        return view('sell', compact('products'));
    }

    //add sale
    public function add(Request $request)
    {
        $sale = new TempSale([
            'name' => $request->get('name'),
            'inventory_product_id' => $request->get('inventory_product_id'),
            'quantity' => $request->get('quantity'),
            'sellingPrice' => $request->get('sellingPrice'),
            'buyingPrice' => $request->get('buyingPrice'),
            'discount' => $request->get('discountAmount'),
            'total' => $request->get('total'),
        ]);

        if (Session::has('sales')) {
            $sales = Session::get('sales');
            $existing = $sales->filter(function ($sale) use ($request) {
                return $sale->inventory_product_id == $request->get('inventory_product_id');
            });
            if ($existing->count() > 0) {
                $existing = $existing->first();
                $sale->quantity += $existing->quantity;
                $sale->discount = $existing->discount;
                $sale->total = $sale->quantity * ($sale->sellingPrice - $sale->discount);
                $sales->add($sales);
            } else {
                $sales->add($sales);
            }
            Session::put('sales', $sales);
        } else {
            $sales = collect();
            $sales->add($sale);
            Session::put('sales', $sales);
        }
        return redirect()->back();
    }
}
