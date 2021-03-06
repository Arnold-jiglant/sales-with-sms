@extends('layout.app')
@section('title')
    view
@stop
@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a><span>@lang('language.dashboard')</span></a></li>
                    <li class="breadcrumb-item"><a><span>@lang('language.sales.view')</span></a></li>
                </ol>
            </div>
        </div>
        <h3 class="mt-1">@lang('language.sales.title') <small>{{$title}}</small></h3>
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
        <div class="row">
            <div class="col">
                <p>@lang('language.total') {{$receipts->total()}} @lang('language.showing') {{$receipts->firstItem()}}-{{$receipts->lastItem()}}</p>
            </div>
            <div class="col order-sm-1">
                <div class="text-right">
                    <button type="button" class="custom-btn btn-sm btn" data-toggle="modal" data-target="#filter-modal">
                        <span class="fa fa-filter"></span> @lang('language.sales.btn_filter')
                    </button>
                </div>
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
                    <th>@lang('language.total_amount')</th>
                    <th>@lang('language.date')</th>
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
                                        <p class="p-0 m-0">@lang('language.payed'): <span class=" text-success p-0 m-0">{{number_format($receipt->payedAMount,2)}}
                                                </span></p>
                                        <p class="p-0 m-0">@lang('language.debt'): <span
                                                class=" text-danger p-0">{{number_format($receipt->debtAMount,2)}}                                                </span>
                                        </p>
                                        <p class="p-0 m-0">@lang('language.customers.customer'): <span
                                                class=" text-info p-0">{{$receipt->customerName}}                                                </span>
                                        </p>
                                    @elseif($receipt->payment_type_code == \App\PaymentType::$CRD)
                                        <p class="value m-0">{{number_format($receipt->payedAMount,2)}}</p>
                                        <span class="text-success">@lang('language.payed')</span>
                                        <p class="p-0 m-0">@lang('language.customers.customer'): <span
                                                class=" text-info p-0">{{$receipt->customerName}}                                                </span>
                                        </p>
                                    @else
                                        <p class="value m-0">{{number_format($receipt->payedAMount,2)}}</p>
                                        <span class="text-success">@lang('language.payed')</span>
                                    @endif
                                    <p class="m-2 text-center">{{strtoupper($receipt->paymentType->name)}}</p>
                                </td>
                                <td rowspan="{{$sales->count()}}"
                                    class="align-middle text-center">{{$receipt->created_at->format('d/m/Y H:i')}}</td>
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
    <div class="modal fade" role="dialog" tabindex="-1" id="filter-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-filter"></i>&nbsp;@lang('language.sales.btn_filter')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">??</span></button>
                </div>
                <div class="modal-body">
                    <form method="GET" action="{{route('sale.view')}}">
                        @csrf
                        <div class="form-group">
                            <label for="from">@lang('language.from')</label>
                            <input id="from" class="form-control form-control-sm" type="date" name="from" required>
                        </div>
                        <div class="form-group">
                            <label for="to">@lang('language.to')</label>
                            <input id="to" class="form-control form-control-sm" type="date" name="to" required>
                        </div>
                        <div class="text-right mt-2">
                            <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">@lang('language.close')
                            </button>
                            <button class="btn btn-primary btn-sm custom-btn" type="submit">@lang('submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
