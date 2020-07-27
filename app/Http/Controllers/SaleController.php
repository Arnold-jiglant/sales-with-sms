<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\Product;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    //TODO change quantity inputs min and step to 0.25
    public function index()
    {
        $products = collect([]);
        $inventories = Inventory::unfinished()->orderBy('created_at')->get();
        foreach ($inventories as $inventory) {
            $products->add($inventory->inventoryProducts()->get());
        }
        $products = $products->collapse()->paginate(10);
        return view('sell', compact('products'));
    }

    //add sale
    public function add(Request $request, $id)
    {
        return $request->all();
    }
}
