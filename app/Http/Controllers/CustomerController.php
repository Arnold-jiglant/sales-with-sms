<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Product;
use App\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CustomerController extends Controller
{
    public function index()
    {
        Gate::authorize('view-customers');
        $customers = Customer::paginate(10);
        return view('customers', compact('customers'));
    }

    //add customer
    public function add(Request $request)
    {
        Gate::authorize('add-customer');
        $this->validate($request, [
            'customer_name' => 'required|unique:customers,name'
        ]);
        Customer::create(['name' => $request->get('customer_name')]);
        return redirect()->back()->with('success', 'New Customer Added');
    }

    //view customer
    public function view($id)
    {
        Gate::authorize('edit-inventory');
        $customer = Customer::find($id);
        if ($customer == null) {
            return redirect()->back()->with('error', 'Customer Not Found');
        }
        $receipts = $customer->receipts()->orderByDesc('created_at')->get()->paginate(10);
        return view('view-customer', compact('customer', 'receipts'));
    }

    //get customers
    public function show(Request $request)
    {
        $search = $request->get('search');
        $customers = Customer::where('name', 'like', "%$search%")->get();
        $start = "<ul class=\"pl-0\">";
        if ($customers->count() > 0) {
            foreach ($customers as $customer) {
                $start .= '<li class="dropdown-item" data-id="' . $customer->id . '">' . $customer->name . '</li>';
            }
        } else {
            $start .= '<li class="dropdown-item">No results Found</li>';
        }
        $end = "</ul>";
        return $start . $end;
    }

    //update customer
    public function update(Request $request, $id)
    {
        Gate::authorize('edit-customer');
        $customer = Customer::find($id);
        if ($customer == null) {
            return redirect()->back()->with('error', 'Customer Not Found');
        }
        $this->validate($request, [
            'customer_name' => 'required|unique:customers,name,' . $id
        ]);
        $customer->name = $request->get('customer_name');
        $customer->save();
        return redirect()->back()->with('success', 'Customer Updated!');
    }

    //delete customer
    public function delete($id)
    {
        Gate::authorize('delete-customer');
        $customer = Customer::find($id);
        if ($customer == null) {
            return redirect()->back()->with('error', 'Customer Not Found');
        }
        $customer->delete();
        return redirect()->back()->with('success', 'Customer deleted!');
    }

    //
    public function getReceipt($number)
    {
        Gate::authorize('view-customers');
        $receipt = Receipt::whereNumber($number)->first();
        if ($receipt == null) {
            return "<h6 class=\"text-center\">Receipt Not Found</h6>";
        }
        $start = '<div class="form-row">
                                <div class="col-sm-6">
                                    <p><span>Receipt No:</span><span class="ml-1 value font-weight-normal">' . $receipt->number . '</span>
                                    </p>
                                    <p><span>Customer Name:</span><span class="ml-1 value font-weight-normal">' . $receipt->customerName . '</span>
                                    </p>
                                    <p><span>Issuer:</span><span class="ml-1 value font-weight-normal">' . $receipt->user->name . '</span></p>
                                </div>
                                <div class="col-sm-6">
                                    <p><span>Amount Payed:</span>
                                        <span class="ml-1 value font-weight-normal">' . number_format($receipt->totalAmount, 2) . '</span>
                                    </p>
                                    <p><span>Payment Type:</span>
                                        <span class="ml-1 value font-weight-normal">' . strtoupper($receipt->paymentType->name) . '</span>
                                    </p>
                                    <p><span>Issue Date:</span><span class="ml-1 value font-weight-normal">' . $receipt->created_at->format('H:i d-M-Y') . '</span></p>
                                </div>
                            </div>
                            <h6>Products</h6>
                            <div class="table-responsive table-bordered text-center" id="products-table">
                                <table class="table table-bordered table-hover table-sm">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product Name</th>
                                        <th>Qty</th>
                                        <th>Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>';
        $products = '';
        $num = 1;
        foreach ($receipt->sales()->get() as $sale) {
            $products .= '<tr>
                            <td>' . $num . '</td>
                            <td>' . $sale->productName . '</td>
                            <td>' . $sale->quantity . '</td>
                            <td>' . number_format($sale->payedAmount, 2) . '</td>
                        </tr>';
            $num++;
        }
        $end = '</tbody>
                    </table>
                </div>';
        return $start . $products . $end;
    }
}
