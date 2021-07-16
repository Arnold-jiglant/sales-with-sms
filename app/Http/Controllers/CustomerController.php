<?php

namespace App\Http\Controllers;

use App\Customer;
use App\DebtNotification;
use App\DebtPayment;
use App\Jobs\SendSMSJob;
use App\Product;
use App\Receipt;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CustomerController extends Controller
{
    public function index()
    {
        Gate::authorize('view-customers');
        $request = Request::capture();
        $title = '';
        if ($request->has('search')) {
            $search = $request->get('search');
            $title = "Search for '$search'";
            $customers = Customer::where('name', 'like', "%$search%")->paginate(10);
        } else {
            $customers = Customer::paginate(10);
        }
        return view('customers', compact('customers', 'title'));
    }

    //add customer
    public function add(Request $request)
    {
        Gate::authorize('add-customer');
        $this->validate($request, [
            'customer_name' => 'required|unique:customers,name',
            'phone_number' => 'required'
        ]);
        Customer::create(['name' => $request->get('customer_name'), 'phone_number' => $request->get('phone_number')]);
        return redirect()->back()->with('success', 'New Customer Added');
    }

    //view customer
    public function view($id)
    {
        Gate::authorize('view-customers');
        $customer = Customer::find($id);
        if ($customer == null) return redirect()->back()->with('error', 'Customer Not Found');
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
        if ($customer == null) return redirect()->back()->with('error', 'Customer Not Found');
        $this->validate($request, [
            'customer_name' => 'required|unique:customers,name,' . $id,
            'phone_number' => 'required',
        ]);
        $customer->name = $request->get('customer_name');
        $customer->phone_number = $request->get('phone_number');
        $customer->save();
        return redirect()->back()->with('success', 'Customer Updated!');
    }

    //delete customer
    public function delete($id)
    {
        Gate::authorize('delete-customer');
        $customer = Customer::find($id);
        if ($customer == null) return redirect()->back()->with('error', 'Customer Not Found');
        $customer->delete();
        return redirect()->back()->with('success', 'Customer deleted!');
    }

    //get Receipt info
    public function getReceipt($number)
    {
        Gate::authorize('view-customers');
        $receipt = Receipt::whereNumber($number)->first();
        if ($receipt == null) return "<h6 class=\"text-center\">Receipt Not Found</h6>";
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

    //pay debt
    public function payDebt(Request $request, $id)
    {
        $this->validate($request, [
            'amount' => 'required'
        ]);

        $receipt = Receipt::find($id);
        if ($receipt == null) return redirect()->back()->with('error', 'Receipt info NOT Found');
        $receipt->debtPayments()->save(new DebtPayment(['amount' => $request->get('amount'), 'issuer' => auth()->id()]));
        return redirect()->back()->with('success', 'Payment Received');
    }

    public function notify(Request $request, Customer $customer)
    {
        $this->validate($request, [
            'message' => 'required',
        ]);


        $debtNotification = $customer->debtNotifications()->save(new DebtNotification([
            'message' => $request->get('message'),
        ]));

        $recipients = [
            array("recipient_id" => $customer->id, "dest_addr" => $customer->formattedPhoneNumber)
        ];

        try {
            $http = new \GuzzleHttp\Client();
            $response = $http->request('POST', "https://apisms.beem.africa/v1/send", [
                "headers" => [
                    'Authorization' => "Basic " . base64_encode(env("BEEM_API_KEY") . ":" . env("BEEM_SECRET"))
                ],
                "json" => [
                    "source_addr" => "INFO",
                    "schedule_time" => "",
                    "encoding" => "0",
                    "message" => $request->get('message'),
                    "recipients" => $recipients
                ]
            ]);

            $data = json_decode($response->getBody(), true);
            if ($data['code'] == 100) {

                //update saved notification
                $debtNotification->status = DebtNotification::$SENT;
                $debtNotification->save();


                return response()->json([
                    "success" => "Notification sent successfully"
                ]);
            } else {
                return response()->json([
                    "error" => "Something went wrong"
                ]);
            }
        } catch (ClientException $exception) {
            return response()->json([
                "error" => $exception->getMessage()
            ]);
        } catch (\Exception $exception) {

            return response()->json([
                "error" => $exception->getMessage()
            ]);
        } catch (GuzzleException $e) {

            return response()->json([
                "error" => "Internal error"
            ]);
        }
    }
}
