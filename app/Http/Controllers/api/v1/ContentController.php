<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Inventory;
use App\InventoryProduct;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function product($id)
    {
        $product = InventoryProduct::find($id);
        if ($product == null) {
            return response()->json([
                'error' => 'Product Not Found'
            ]);
        }
        return response()->json([
            'success' => 'Product Founded',
            'data' => new ProductResource($product)
        ]);
    }
}
