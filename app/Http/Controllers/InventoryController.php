<?php

namespace App\Http\Controllers;

use App\DiscountType;
use App\Events\InventoryChanged;
use App\Inventory;
use App\InventoryProduct;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Milon\Barcode\Facades\DNS1DFacade;

class InventoryController extends Controller
{
    public function index()
    {
        Gate::authorize('view-inventory');
        $inventories = Inventory::orderByDesc('created_at')->paginate(10);
        return view('inventory', compact('inventories'));
    }

    //show add inventory form
    public function showAddInventoryForm()
    {
        Gate::authorize('add-inventory');
        $products = Product::orderBy('name')->get();
        $discountTypes = DiscountType::all();
        return view('add-inventory', compact('products', 'discountTypes'));
    }

    //add inventory
    public function add(Request $request)
    {
        Gate::authorize('add-inventory');
        $this->validate($request, [
            'product' => 'required',
            'quantity' => 'required',
            'cost' => 'required',
            'sellingPrice' => 'required'
        ]);
        $discounts = null;
        if ($request->has('discount')) {
            $discounts = collect();
            for ($i = 0; $i < collect($request->get('discountQuantity'))->count(); $i++) {
                $discounts->add(['qty' => (float)$request->get('discountQuantity')[$i], 'amount' => (float)$request->get('discountAmount')[$i]]);
            }
            $discounts = $discounts->sortByDesc(function ($discount, $index) {
                return $discount['qty'];
            })->values()->all();
        }


        $product = new InventoryProduct([
            'product_id' => $request->get('product'),
            'quantity' => $request->get('quantity'),
            'cost' => $request->get('cost'),
            'sellingPrice' => $request->get('sellingPrice'),
            'discountRates' => $discounts,
            'discount_type_id' => $request->get('discountType'),
        ]);

        if (Session::has('products')) {
            $products = Session::get('products');
            if ($products->filter(function ($product) use ($request) {
                    return $product->product_id == $request->get('product');
                })->count() > 0) {
                $request->session()->flash('duplicateProductId', $request->get('product'));
                return redirect()->back()->with('error', 'Product Already Exists In The Collection');
            }
            $products->add($product);
            Session::put('products', $products);
            $this->refreshInventory($products);
        } else {
            $products = collect();
            $products->add($product);
            Session::put('inventory', new Inventory([
                'totalCost' => $product->cost,
                'expectedAmount' => $product->sellingPrice * $product->quantity,
                'issuer' => auth()->id(),
                'finished' => false,
            ]));
            Session::put('products', $products);
        }
        return redirect()->back()->with('success', 'Product Added To Collection');
    }

    //delete product from collection session
    public function deleteProduct($id)
    {
        Gate::authorize('add-inventory');
        $products = Session::get('products')->reject(function ($product) use ($id) {
            return $product->product_id == $id;
        });
        Session::put('products', $products);
        $this->refreshInventory($products);
        return redirect()->back()->with('success', 'Product Removed To Collection');
    }

    //refresh session inventory
    function refreshInventory($products)
    {
        $inventory = Session::get('inventory');
        $inventory->totalCost = $products->sum(function ($product) {
            return $product->cost;
        });
        $inventory->expectedAmount = $products->sum(function ($product) {
            return $product->sellingPrice * $product->quantity;
        });
    }

    //cancel inventory
    public function cancel(Request $request)
    {
        Session::forget('products');
        Session::forget('inventory');
        return redirect()->route('inventories');
    }

    //confirm inventory
    public function confirm(Request $request)
    {
        $inventory = Session::get('inventory');
        $inventory->description = $request->get('description');
        $inventory->save();
        $inventory->inventoryProducts()->saveMany(Session::get('products'));
        Session::forget('products');
        Session::forget('inventory');
        return redirect()->route('inventories');
    }

    //view inventory
    public function view($id)
    {
        Gate::authorize('view-inventory');
        $inventory = Inventory::find($id);
        if ($inventory == null) {
            return redirect()->back()->with('error', 'Inventory Not Found');
        }
        $invProducts = $inventory->inventoryProducts()->paginate(10);
        $products = Product::orderBy('name')->get();
        return view('inventory-products', compact('inventory', 'invProducts', 'products'));
    }

    //edit inventory description
    public function updateDescription(Request $request, $id)
    {
        Gate::authorize('edit-inventory');
        $inventory = Inventory::find($id);
        if ($inventory == null) {
            return redirect()->back()->with('error', 'Inventory Not Found');
        }
        $inventory->description = $request->get('description');
        $inventory->save();
        return redirect()->back()->with('success', 'Inventory Description Updated');
    }

    //add product to existing inventory
    public function addProduct(Request $request, $invID)
    {
        Gate::authorize('add-inventory');
        $inventory = Inventory::find($invID);
        if ($inventory == null) {
            return redirect()->back()->with('error', 'Inventory Not Found');
        }
        $this->validate($request, [
            'product' => 'required',
            'quantity' => 'required',
            'cost' => 'required',
            'sellingPrice' => 'required'
        ]);
        $invProducts = $inventory->inventoryProducts();
        $product = $invProducts->whereProductId($request->get('product'));
        if ($product->count() > 0) {
            $name = $product->first()->name;
            $request->session()->flash('existingProduct', $request->get('product'));
            return redirect()->back()->with('error', "Product ($name) Already Exist in this inventory!, Try Add Stock");
        }
        $discounts = null;
        if ($request->has('discount')) {
            $discounts = collect();
            for ($i = 0; $i < sizeof($request->get('discountQuantity')); $i++) {
                $discounts->add(['qty' => (float)$request->get('discountQuantity')[$i], 'amount' => (float)$request->get('discountAmount')[$i]]);
            }
            $discounts = $discounts->sortByDesc(function ($discount, $index) {
                return $discount['qty'];
            })->values()->all();
        }
        $newProduct = new InventoryProduct([
            'product_id' => $request->get('product'),
            'quantity' => $request->get('quantity'),
            'cost' => $request->get('cost'),
            'sellingPrice' => $request->get('sellingPrice'),
            'discountRates' => $discounts,
            'discount_type_id' => $request->get('discountType'),
        ]);
        $invProducts->save($newProduct);
        event(new InventoryChanged($inventory));
        return redirect()->back()->with('success', 'Product Added');
    }

    //add Stock to existing product
    public function addToStock(Request $request, $id)
    {
        $this->validate($request, [
            'newQuantity' => 'required',
            'newCost' => 'required',
            'newSellingPrice' => 'required',
        ]);
        $invProduct = InventoryProduct::find($id);
        if ($invProduct == null) {
            return redirect()->back()->with('error', 'Product Not Found');
        }
        $invProduct->quantity += $request->get('newQuantity');
        $invProduct->cost += $request->get('newCost');
        $invProduct->sellingPrice = $request->get('newSellingPrice');
        $invProduct->save();

        //update inventory
        event(new InventoryChanged($invProduct->inventory));
//        return $request->all();
        return redirect()->back()->with('success', 'Product Stock Updated');
    }

    //get discounts AJAX
    public function getDiscounts($id)
    {
        Gate::authorize('edit-inventory');
        $invProduct = InventoryProduct::find($id);
        if ($invProduct == null) {
            return response()->json([
                'error' => 'Inventory Product Not Found'
            ]);
        } else {
            return response()->json([
                'discounts' => $invProduct->discountRates,
            ]);
        }
    }

    //edit existing inventory product
    public function update(Request $request, $invProductId)
    {
        Gate::authorize('edit-inventory');
        $invProduct = InventoryProduct::find($invProductId);
        if ($invProduct == null) {
            return redirect()->back()->with('error', 'Product Not Found in This Inventory!');
        }
        $this->validate($request, [
            'newQuantity' => 'required',
            'newCost' => 'required',
            'newSellingPrice' => 'required',
        ]);
        $discounts = null;
        if ($request->has('hasDiscount')) {
            $discounts = collect();
            for ($i = 0; $i < sizeof($request->get('discountQuantity')); $i++) {
                $discounts->add(['qty' => (double)$request->get('discountQuantity')[$i], 'amount' => (double)$request->get('discountAmount')[$i]]);
            }
            $discounts = $discounts->sortByDesc(function ($discount, $index) {
                return $discount['qty'];
            })->values()->all();
        }

        $invProduct->quantity = $request->get('newQuantity');
        $invProduct->cost = $request->get('newCost');
        $invProduct->sellingPrice = $request->get('newSellingPrice');
        $invProduct->discountRates = $discounts;
        $invProduct->discount_type_id = $request->get('discountType');
        $invProduct->save();
        event(new InventoryChanged($invProduct->inventory));
        return redirect()->back()->with('success', 'Inventory Product Updated');
    }

    public function generateBarcode($id){
        $request = Request::capture();

        $product = InventoryProduct::find($id);
        if($product==null) return redirect()->back()->with('error','Product Not Found');
        $count = $request->get('count');
        $name = $product->name;
        $barcode = DNS1DFacade::getBarcodeSVG($id, 'C39',2,40,'black',false);
        return view('barcode',compact('barcode','count','name'));
    }

    //TODO delete inventory
}
