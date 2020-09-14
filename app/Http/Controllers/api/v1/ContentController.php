<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ReceiptResource;
use App\Inventory;
use App\InventoryProduct;
use App\Receipt;
use Carbon\Carbon;
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

    /*
     * Get receipts*/
    public function receipts()
    {
        return response()->json([
            'success' => 'Founded',
            'data' => Receipt::whereDate('created_at', Carbon::today())->get()->transform(function ($receipt) {
                return new ReceiptResource($receipt);
            }),
        ]);
    }

    /*
    * Get receipt by number*/
    public function receipt($number)
    {
        $receipt = Receipt::whereNumber($number)->first();
        if($receipt==null){
            return response()->json([
                'error' => 'Receipt Not Found',
            ]);
        }
        return response()->json([
            'success' => 'Founded',
            'data' => new ReceiptResource($receipt),
        ]);
    }
}
