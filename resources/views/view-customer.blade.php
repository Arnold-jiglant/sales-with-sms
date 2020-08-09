@extends('layout.app')
@section('title')
    Customer
@stop
@section('customer')
    active
@stop
@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a><span>Dashboard</span></a></li>
                    <li class="breadcrumb-item"><a><span>Customer</span></a></li>
                    <li class="breadcrumb-item"><a><span>Purchase History</span></a></li>
                </ol>
            </div>
        </div>
        <h3 class="mt-1">Customer Purchase History</h3>
        @if(Session('success'))
            <div class="row" style="margin-top: 10px;">
                <div class="col-lg-6 offset-3">
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        {{session('success')}}
                    </div>
                </div>
            </div>
        @endif
        @if(Session('error'))
            <div class="row" style="margin-top: 10px;">
                <div class="col-lg-6 offset-3">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        {{session('error')}}
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="col-lg-11 col-xl-10 offset-lg-1 offset-xl-1">
        <form>
            <p><span>Customer Name:</span><span class="ml-1 value">{{$customer->name}}</span></p>
            <p><span>Total Debt:</span><span class="ml-1 text-danger">{{number_format($customer->totalDebt,2)}}</span>
            </p>
            <div class="row">
                <div class="col">
                    <p>Total {{$receipts->total()}} showing {{$receipts->firstItem()}}-{{$receipts->lastItem()}}</p>
                </div>
                <div class="col order-sm-1">
                </div>
            </div>
            <div class="table-responsive table-bordered">
                <table class="table table-bordered table-sm">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Receipt</th>
                        <th>Products</th>
                        <th>Qty</th>
                        <th>Amount</th>
                        <th>Total Amount</th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($num=$receipts->firstItem())
                    @foreach($receipts as $receipt)
                        @foreach($sales=$receipt->sales()->get() as $key=>$sale)
                            @if($key==0)
                                <tr title="Some Descriptions">
                                    <td rowspan="{{$sales->count()}}" class="align-middle text-center">{{$num}}</td>
                                    <td rowspan="{{$sales->count()}}" class="align-middle text-center">
                                        <p>{{$receipt->number}}</p>
                                        <p class="text-muted small font-italic">({{$receipt->user->name}})</p>
                                    </td>
                                    <td>{{$sale->productName}}</td>
                                    <td>{{$sale->quantity}}</td>
                                    <td>{{number_format($sale->payedAmount,2)}}</td>
                                    <td rowspan="{{$sales->count()}}" class="align-middle text-center">
                                        @if($receipt->incompletePayment)
                                            <p class="p-0 m-0">Required: <span class="value">{{number_format($receipt->requiredPaymentAmount,2)}}
                                                </span></p>
                                            <p class="p-0 m-0">Payed: <span class=" text-success p-0 m-0">{{number_format($receipt->payedAMount,2)}}
                                                </span></p>
                                            <p class="p-0 m-0">Debt: <span
                                                    class=" text-danger p-0">{{number_format($receipt->debtAMount,2)}}                                                </span>
                                            </p>
                                        @else
                                            <p class="value m-0">{{number_format($receipt->payedAMount,2)}}</p>
                                            <span class="text-success">PAYED</span>
                                        @endif
                                        <p class="m-2 text-center">{{strtoupper($receipt->paymentType->name)}}</p>
                                    </td>
                                    <td rowspan="{{$sales->count()}}"
                                        class="align-middle text-center">{{$receipt->created_at->format('d/m/Y H:i')}}</td>
                                    <td rowspan="{{$sales->count()}}" class="align-middle text-center">
                                        <div class="options">
                                            @if($receipt->incompletePayment)
                                                @can('receive-debt-payment')
                                                    <a href="#pay-debt-modal" data-toggle="modal"
                                                       class="option-link" data-name="{{$customer->name}}"
                                                       data-amount="{{number_format($receipt->requiredPaymentAmount,2)}}"
                                                       data-debt="{{number_format($receipt->debtAmount,2)}}"
                                                       data-max="{{$receipt->debtAmount}}"
                                                       data-receipt="{{$receipt->id}}">
                                                        <i class="icon ion-cash"></i>&nbsp;
                                                        <span class="link-text">Pay</span>
                                                    </a>
                                                @endcan
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @else
                                <tr title="Some Descriptions">
                                    <td>{{$sale->productName}}</td>
                                    <td>{{$sale->quantity}}</td>
                                    <td>{{number_format($sale->payedAmount,2)}}</td>
                                </tr>
                            @endif
                        @endforeach
                        <tr>
                            <td colspan="7"></td>
                        </tr>
                        @php($num++)
                    @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    <div class="row mt-2">
        <div class="col-11 col-md-10 col-lg-7 offset-1 offset-md-1 offset-lg-3">
            <nav>
                {{$receipts->links()}}
            </nav>
        </div>
    </div>
@stop
@section('modal')
    @can('receive-debt-payment')
        <div class="modal fade" role="dialog" tabindex="-1" id="pay-debt-modal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="icon ion-cash"></i>&nbsp;Pay Customer Debt</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="PUT">
                            <p><span>Customer Name:</span><span id="customerName" class="ml-1 value">Text</span></p>
                            <p><span>Required Amount:</span><span id="requiredAmount" class="ml-1">Text</span></p>
                            <p><span>Debt Amount:</span><span id="debtAmount" class="ml-1 text-danger">Text</span></p>
                            <div class="form-group" data-toggle="popover"
                                 data-content="The amount the customer is paying"
                                 data-trigger="focus" data-placement="right">
                                <label for="amount">Amount</label>
                                <input class="form-control form-control-sm" type="number"
                                       placeholder="Amount to be payed" id="amount" name="amount" required>
                            </div>
                            <div class="text-right mt-2">
                                <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">Close
                                </button>
                                <button class="btn btn-primary btn-sm custom-btn" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@stop

@section('script')
    <script>
        $(document).ready(function () {
            @can('receive-debt-payment')
            //pay debt modal
            $('#pay-debt-modal').on('show.bs.modal', function (e) {
                let receipt = $(e.relatedTarget).data('receipt');
                let name = $(e.relatedTarget).data('name');
                let debt = $(e.relatedTarget).data('debt');
                let amount = $(e.relatedTarget).data('amount');
                let max = $(e.relatedTarget).data('max');

                let form = $(this).find('form');
                let action = '{{route('customer.pay.debt','')}}/' + receipt;
                form.attr('action', action);

                $('#customerName').text(name);
                $('#debtAmount').text(debt);
                $('#requiredAmount').text(amount);
                $('#amount').attr('max', max);
            });
            @endcan
        });
    </script>
@stop
