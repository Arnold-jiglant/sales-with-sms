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
        $receipts = $customer->receipts()->orderByDesc('created_at')->get()->paginate(10);
        return view('view-customer',compact('customer','receipts'));
    }

    //get customers
    public function show(Request $request)
    {
        $search = $request->get('search');
        $customers = Customer::where('name', 'like', "%$search%")->get();
        $start = "<ul class=\"pl-0\">";
        if($customers->count()>0){
            foreach ($customers as $customer) {
                $start .= '<li class="dropdown-item" data-id="' . $customer->id . '">' . $customer->name . '</li>';
            }
        }else{
            $start.='<li class="dropdown-item">No results Found</li>';
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
}
