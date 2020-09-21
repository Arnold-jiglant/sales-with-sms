<?php

namespace App\Http\Controllers\api\v1;

use App\Customer;
use App\DebtPayment;
use App\Expense;
use App\ExpenseType;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SaleController;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\ExpenseTypeResource;
use App\Http\Resources\IncomeTypeResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ReceiptResource;
use App\Income;
use App\IncomeType;
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
        $request = Request::capture();

        if ($request->has('number')) {
            $number = $request->get('number');
            $receipts = Receipt::where('number', 'like', "%$number%")->get()->transform(function ($receipt) {
                return new ReceiptResource($receipt);
            });
            return response()->json([
                'success' => 'Founded',
                'data' => $receipts,
            ]);
        }

        if ($request->has('customer')) {
            $name = $request->get('customer');
            $customers = Customer::where('name', 'like', "%$name%")->get();
            $receipts = collect();
            foreach ($customers as $customer) {
                $receipts->add($customer->receipts()->get()->filter(function (Receipt $receipt) {
                    return $receipt->incompletePayment;
                }));
            }

            return response()->json([
                'success' => 'Founded',
                'data' => $receipts->collapse()->transform(function ($receipt) {
                    return new ReceiptResource($receipt);
                }),
            ]);
        }

        return response()->json([
            'success' => 'Founded',
            'data' => Receipt::whereDate('created_at', Carbon::today())->orderBy('created_at', 'desc')->get()->transform(function ($receipt) {
                return new ReceiptResource($receipt);
            }),
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

    /*
     * Customers
     * */
    public function customers($name)
    {
        return response()->json([
            'success' => 'Found',
            'customers' => Customer::where('name', 'like', "%$name%")->get()->transform(function ($customer) {
                return new CustomerResource($customer);
            }),
        ]);
    }

    //pay debt
    public function payDebt(Request $request, $id)
    {
        if (!Gate::has('receive-debt-payment')) {
            return response()->json([
                'error' => 'Permission Denied',
            ]);
        }
        $receipt = Receipt::find($id);
        if ($receipt == null) {
            return response()->json([
                'error' => 'Receipt Not Found',
            ]);
        }

        if (doubleval($request->get('amount')) <= 0) {
            return response()->json([
                'error' => 'Invalid Amount',
            ]);
        }
        $receipt->debtPayments()->save(new DebtPayment(['amount' => $request->get('amount'), 'issuer' => auth()->id()]));
        return response()->json([
            'success' => 'Payment Received Successfully',
            'receipt' => new ReceiptResource($receipt),
        ]);
    }


    /*
     * Incomes
     * */
    public function incomes()
    {
        if (!Gate::has('view-incomes')) {
            return response()->json([
                'error' => 'Permission Denied',
            ]);
        }
        return response()->json([
            'success' => 'Found',
            'sources' => IncomeType::all()->transform(function ($type) {
                return new IncomeTypeResource($type);
            }),
        ]);
    }

    /*
     * Add Income
     * */
    public function addIncome(Request $request, $id)
    {
        if (!Gate::has('add-income')) {
            return response()->json([
                'error' => 'Permission Denied',
            ]);
        }
        if ($request->get('amount') <= 0) {
            return response()->json([
                'error' => 'Amount value is required',
            ]);
        }

        $incomeType = IncomeType::find($id);
        if ($incomeType == null) {
            return response()->json([
                'error' => 'Income Source Not Available',
            ]);
        }

        $incomeType->incomes()->save(new Income([
            'amount' => $request->get('amount'),
            'description' => $request->get('description'),
            'issuer' => auth()->id(),
        ]));
        return response()->json([
            'success' => 'Found',
            'source' => new IncomeTypeResource($incomeType),
        ]);
    }
    /*
     * Expenses
     * */
    public function expenses()
    {
        if (!Gate::has('view-expenses')) {
            return response()->json([
                'error' => 'Permission Denied',
            ]);
        }
        return response()->json([
            'success' => 'Found',
            'expenseTypes' => ExpenseType::all()->transform(function ($type) {
                return new ExpenseTypeResource($type);
            }),
        ]);
    }

    /*
     * Add Income
     * */
    public function addExpense(Request $request, $id)
    {
        if (!Gate::has('add-expense')) {
            return response()->json([
                'error' => 'Permission Denied',
            ]);
        }
        if ($request->get('amount') <= 0) {
            return response()->json([
                'error' => 'Amount value is required',
            ]);
        }

        $expenseType = ExpenseType::find($id);
        if ($expenseType == null) {
            return response()->json([
                'error' => 'Expense Type Not Available',
            ]);
        }

        $expenseType->expenses()->save(new Expense([
            'amount' => $request->get('amount'),
            'description' => $request->get('description'),
            'issuer' => auth()->id(),
        ]));
        return response()->json([
            'success' => 'Found',
            'expenseType' => new ExpenseTypeResource($expenseType),
        ]);
    }
}
