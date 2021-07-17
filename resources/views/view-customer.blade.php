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
                    <li class="breadcrumb-item"><a><span>@lang('language.dashboard')</span></a></li>
                    <li class="breadcrumb-item"><a><span>@lang('language.customers.customer')</span></a></li>
                    <li class="breadcrumb-item"><a><span>@lang('language.customers.view_title')</span></a></li>
                </ol>
            </div>
        </div>
        <h3 class="mt-1">@lang('language.customers.view_title')</h3>
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
            <p><span>@lang('language.customers.customer_name'):</span><span
                    class="ml-1 value">{{$customer->name}}</span></p>
            <p><span>Phone No:</span><a href="tel:{{$customer->phone_number}}"
                                        class="ml-1 value">{{$customer->phone_number}}</a></p>
            @if($customer->totalDebt>0)
                <p>
                    <span>@lang('language.customers.total_debt'):</span><span
                        class="ml-1 text-danger">{{number_format($customer->totalDebt,2)}}</span>
                </p>
                <p>
                    <span>Last Notification:</span><span
                        class="ml-1 text-info">{{$customer->lastDebtNotificationTime}}</span>

                    <a href="#debt-reminder-modal" data-toggle="modal"
                       class="option-link"
                       data-id="{{$customer->id}}"
                       data-name="{{$customer->name}}"
                       data-phone-number="{{$customer->phone_number}}"
                       data-debt-message="{{$customer->debtMessage}}"
                    >
                        <i class="icon ion-android-notifications"></i>&nbsp;
                        <span class="link-text">Notify Customer</span>
                    </a>
                </p>
            @endif

            <div class="row">
                <div class="col">
                    <p>@lang('language.total') {{$receipts->total()}} @lang('language.showing') {{$receipts->firstItem()}}
                        -{{$receipts->lastItem()}}</p>
                </div>
                <div class="col order-sm-1">
                </div>
            </div>
            <div class="table-responsive table-bordered">
                <table class="table table-bordered table-sm">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('language.receipt')</th>
                        <th>@lang('language.products.title')</th>
                        <th>@lang('language.short_quantity')</th>
                        <th>@lang('language.amount')</th>
                        <th>@lang('total_amount')</th>
                        <th>@lang('language.date')</th>
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
                                            <p class="p-0 m-0">@lang('language.required'): <span class="value">{{number_format($receipt->requiredPaymentAmount,2)}}
                                                </span></p>
                                            <p class="p-0 m-0">@lang('language.payed'): <span
                                                    class=" text-success p-0 m-0">{{number_format($receipt->payedAMount,2)}}
                                                </span></p>
                                            <p class="p-0 m-0">@lang('language.debt'): <span
                                                    class=" text-danger p-0">{{number_format($receipt->debtAMount,2)}}                                                </span>
                                            </p>

                                        @else
                                            <p class="value m-0">{{number_format($receipt->payedAMount,2)}}</p>
                                            <span class="text-success">@lang('language.payed')</span>
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
                                                        <span class="link-text">@lang('language.pay')</span>
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
                        <h5 class="modal-title"><i
                                class="icon ion-cash"></i>&nbsp;@lang('language.customers.receive_debt')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="PUT">
                            <p><span>@lang('language.customers.customer_name'):</span><span id="customerName"
                                                                                            class="ml-1 value">Text</span>
                            </p>
                            <p><span>@lang('language.required_amount'):</span><span id="requiredAmount" class="ml-1">Text</span>
                            </p>
                            <p><span>@lang('language.debt_amount'):</span><span id="debtAmount"
                                                                                class="ml-1 text-danger">Text</span></p>
                            <div class="form-group" data-toggle="popover"
                                 data-content="The amount the customer is paying"
                                 data-trigger="focus" data-placement="right">
                                <label for="amount">@lang('language.amount')</label>
                                <input class="form-control form-control-sm" type="number"
                                       placeholder="@lang('language.amount')" id="amount" name="amount" required>
                            </div>
                            <div class="text-right mt-2">
                                <button class="btn btn-light btn-sm mr-2" type="button"
                                        data-dismiss="modal">@lang('language.close')
                                </button>
                                <button class="btn btn-primary btn-sm custom-btn"
                                        type="submit">@lang('language.confirm')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" role="dialog" tabindex="-1" id="debt-reminder-modal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i
                                class="icon ion-android-notifications"></i>&nbsp;Notify Customer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form onsubmit="event.preventDefault()">
                            <div class="form-group">
                                <p><span>@lang('language.customers.customer_name'):</span><span
                                        class="ml-1 value">{{$customer->name}}</span></p>
                                <p><span>Phone No:</span><a href="tel:{{$customer->phone_number}}"
                                                            class="ml-1 value">{{$customer->phone_number}}</a></p>
                            </div>
                            <div class="form-group">
                                <label for="message">Message:</label>
                                <textarea class="form-control form-control-sm" type="number" rows="10"
                                          placeholder="@lang('language.amount')" id="message" name="message"
                                          required style="white-space: pre;"></textarea>
                                <p id="notify-error" class="text-danger text-center mt-1"
                                   style="display: none;font-size: 11pt;"></p>
                            </div>

                            <div class="text-right mt-2">
                                <button class="btn btn-light btn-sm mr-2" type="button"
                                        data-dismiss="modal">@lang('language.close')
                                </button>
                                <button class="btn btn-primary btn-sm custom-btn"
                                        type="submit">
                                    <div id="statusSpinner" class="spinner-border text-light" role="status"
                                         style="height: 15px;width: 15px; display: none">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <span id="statusSpan">Send</span>
                                </button>
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

            //notify customer modal
            $('#debt-reminder-modal').on('show.bs.modal', function (e) {
                let id = $(e.relatedTarget).data('id');
                let message = $(e.relatedTarget).data('debt-message');

                let form = $(this).find('form');
                let action = '{{route('customer.notify.debt','')}}/' + id;
                form.attr('action', action);
                $('#message').val(message);
            });

            $("#debt-reminder-modal form").submit(function (e) {
                let spinner = $("#statusSpinner");
                let statusLabel = $("#statusSpan");
                let url = $(this).attr('action');
                let message = $('#message').val();


                spinner.css('display', 'inline-block');
                statusLabel.text('Sending');

                if (message.length < 1) {
                    alert("Message cant be empty");
                    return;
                }

                $.ajax({
                    url,
                    type: "POST",
                    data: {message, "_token": "{{@csrf_token()}}"},
                    success: function (data) {
                        console.log(data);
                        if (data['success']) {
                            alert(data["success"]);
                            $("#debt-reminder-modal").modal('hide');

                        } else {
                            let notifyLabel = $("#notify-error");
                            notifyLabel.text(data['error']);
                            notifyLabel.css('display', 'block');


                            //hide spinner
                            spinner.css('display', 'none');
                            statusLabel.text('Send');
                        }
                    }
                });
            });
            @endcan
        });
    </script>
@stop
