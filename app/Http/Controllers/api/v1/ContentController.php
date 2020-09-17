<?php

namespace App\Http\Controllers\api\v1;

use App\Customer;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SaleController;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ReceiptResource;
use App\Inventory;
use App\InventoryProduct;
use App\PaymentType;
use App\Receipt;
use App\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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
        if ($receipt == null) {
            return response()->json([
                'error' => 'Receipt Not Found',
            ]);
        }
        return response()->json([
            'success' => 'Founded',
            'data' => new ReceiptResource($receipt),
        ]);
    }

    /*
     * Confirm sale
     * */
    public function confirmSale(Request $request)
    {
        //check if user can sell products
        if (!Gate::check('sell-product'))
            return response()->json([
                'error' => 'You dont have permission to sell products',
            ]);

        //collect posted products
        $data = collect($request->all());
        $products = collect($data['products']);
        $sales = $products->transform(function ($item) {
            return new Sale([
                'inventory_product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'sellingPrice' => $item['sellingPrice'],
                'discount' => 0,
                'receipt_id' => 0,
            ]);
        });

        $receipt = Receipt::create([
            'number' => SaleController::generateReceiptNo(),
            'payment_type_code' => PaymentType::whereName($data['paymentType'])->first()->code,
            'customer_id' => $request->get('customerId'),
            'issuer' => auth()->id(),
        ]);

        $receipt->sales()->saveMany($sales);
        return response()->json([
            'success' => 'Sale completed',
            'receipt' => new ReceiptResource($receipt),
        ]);
    }

    public function customers($name)
    {
        return response()->json([
            'success' => 'Customer Found',
            'customers' => Customer::where('name', 'like', "%$name%")->get()->transform(function ($customer) {
                return new CustomerResource($customer);
            }),
        ]);
    }
}
