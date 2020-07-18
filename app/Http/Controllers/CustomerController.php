<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Product;
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
        abort(404);
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
}
