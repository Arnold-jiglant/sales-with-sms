<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    public function index()
    {
        Gate::authorize('view-inventory');
        $products = Product::paginate(10);
        return view('products', compact('products'));
    }

    //add product
    public function add(Request $request)
    {
        Gate::authorize('add-inventory');
        $this->validate($request, [
            'product_name' => 'required|unique:products,name'
        ]);
        Product::create(['name' => $request->get('product_name'), 'hasSize' => $request->has('hasSize'),]);
        return redirect()->back()->with('success', 'New Product Added');
    }

    //update product
    public function update(Request $request, $id)
    {
        Gate::authorize('edit-inventory');
        $product = Product::find($id);
        if ($product == null) {
            return redirect()->back()->with('error', 'Product Not Found');
        }
        $this->validate($request, [
            'product_name' => 'required|unique:products,name,' . $id
        ]);
        $product->name = $request->get('product_name');
        $product->hasSize = $request->has('hasSize');
        $product->save();
        return redirect()->back()->with('success', 'Product Updated!');
    }

    //delete product
    public function delete($id)
    {
        Gate::authorize('delete-inventory');
        $product = Product::find($id);
        if ($product == null) {
            return redirect()->back()->with('error', 'Product Not Found');
        }
        abort(404);
        //TODO delete product
    }
}
