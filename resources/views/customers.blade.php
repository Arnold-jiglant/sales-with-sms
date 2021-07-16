@extends('layout.app')
@section('title')
    @lang('language.customers.title')
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
                    <li class="breadcrumb-item"><a><span>@lang('language.customers.title')</span></a></li>
                </ol>
            </div>
        </div>
        <h3 class="mt-1">@lang('language.customers.title')</h3>
    </div>
    <div class="col-lg-11 col-xl-10 offset-lg-1 offset-xl-1">
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
            <div class="row mt-1">
                <div class="col-md-8 col-xl-6 offset-md-2">
                    <form class="search-form" action="{{route('customers')}}">
                        <div class="form-group">
                            <div class="input-group input-group-sm">
                                <input name="search" class="form-control" type="text" placeholder="@lang('language.search') @lang('language.customers.customer')" required>
                                <div class="input-group-append">
                                    <button class="btn btn-primary custom-btn" type="submit">@lang('language.search')</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <div class="row">
            <div class="col-6">
                <p>
                    @if(strlen($title)>0)
                        {{$title}}, Found {{$customers->total()}}
                    @else
                        @lang('language.total') {{$customers->total()}} @lang('language.showing') {{$customers->firstItem()}}
                        -{{$customers->lastItem()}}
                    @endif
                </p>
            </div>
            <div class="col order-sm-1">
                <div class="text-right">
                    <div class="btn-group">
                        <button class="btn btn-primary btn-sm mr-1" type="button" data-toggle="modal"
                                data-target="#view-receipt-modal">
                            <i class="icon ion-ios-eye"></i>&nbsp;&nbsp;@lang('language.customers.view_receipt')
                        </button>
                        @can('add-customer')
                            <button class="btn btn-primary btn-sm custom-btn" type="button" data-toggle="modal"
                                    data-target="#add-customer-modal">
                                <i class="icon ion-android-add"></i>&nbsp;&nbsp;@lang('language.add') @lang('language.customers.customer')
                            </button>
                        @endcan
                    </div>
                </div>
                @if ($errors->any())
                    <ul>
                        @foreach($errors->all() as $error)
                            <li class="text-danger">{{$error}}</li>
                        @endforeach
                    </ul>
                @endif
            </div>

        </div>
        <div class="table-responsive table-bordered text-center" id="products-table">
            <table class="table table-bordered table-hover table-sm">
                <thead>
                <tr>
                    <th>#</th>
                    <th>@lang('language.name')</th>
                    <th>@lang('language.amount') @lang('language.spent')</th>
                    <th>@lang('language.customers.visit_count')</th>
                    <th>@lang('language.debt')</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if($customers->count()>0)
                    @php($num=$customers->firstItem())
                    @foreach($customers as $customer)
                        <tr>
                            <td>{{$num}}</td>
                            <td>
                                {{$customer->name}}
                                <div><small><a  class="text-muted font-italic" href="tel:{{$customer->phone_number}}">{{$customer->phone_number}}</a></small></div>
                            </td>
                            <td>{{number_format($customer->totalSpent,2)}}</td>
                            <td>{{$customer->visitCount}}</td>
                            <td class="text-danger">{{number_format($customer->totalDebt,2)}}</td>
                            <td>
                                <div class="options">
                                    @can('add-customer')
                                        <a href="{{route('customer.view',$customer->id)}}" class="option-link">
                                            <i class="icon ion-eye"></i>&nbsp;
                                            <span class="link-text">@lang('language.btn_view')</span>
                                        </a>
                                    @endcan
                                    @can('edit-customer')
                                        <a href="#" class="option-link edit" data-toggle="modal"
                                           data-target="#edit-customer-modal" data-id="{{$customer->id}}"
                                           data-name="{{$customer->name}}" data-phone-number="{{$customer->phone_number}}">
                                            <i class="icon ion-edit"></i>&nbsp;
                                            <span class="link-text">@lang('language.btn_edit')</span>
                                        </a>
                                    @endcan
                                    @can('delete-customer')
                                        <a href="#" class="option-link delete" data-toggle="modal"
                                           data-target="#delete-customer-modal" data-id="{{$customer->id}}">
                                            <i class="icon ion-android-delete"></i>&nbsp;
                                            <span class="link-text">@lang('language.btn_delete')</span>
                                        </a>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @php($num++)
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-muted">No Customer added yet</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-11 col-md-10 col-lg-7 offset-1 offset-md-1 offset-lg-3">
            <nav>
                {{$customers->appends(request()->query())->links()}}
            </nav>
        </div>
    </div>
@stop
@section('modal')
    <div class="modal fade" role="dialog" tabindex="-1" id="view-receipt-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon ion-ios-cart-outline"></i>&nbsp;@lang('language.receipt')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('customer.add')}}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="number">@lang('language.receipt_no'):</label>
                            <input class="form-control form-control-sm" type="text" placeholder="@lang('language.receipt_no')"
                                   id="number">
                        </div>
                        <div class="form-group text-right">
                            <button id="search-receipt-btn" class="btn btn-primary btn-sm custom-btn" type="button">
                                @lang('language.search')
                            </button>
                        </div>
                        <div id="loading" class="loading" style="display: none">
                                <span class="spinner-border" role="status"
                                      style="width: 40px;height: 40px;color: #00bacc;"></span>
                            <span class="mt-2">Loading..</span>
                        </div>
                        <div id="receipt-info"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @can('add-customer')
        <div class="modal fade" role="dialog" tabindex="-1" id="add-customer-modal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="icon ion-plus"></i>&nbsp;@lang('language.customers.add_customer')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{route('customer.add')}}">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="customerName">@lang('language.customers.customer_name'):</label>
                                <input class="form-control form-control-sm" type="text" placeholder="name"
                                       id="customerName" name="customer_name" required>
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Phone No:</label>
                                <input class="form-control form-control-sm" type="tel" placeholder="eg +25585..."
                                       id="phone_number" name="phone_number" required>
                            </div>
                            <div class="float-right">
                                <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">@lang('language.close')
                                </button>
                                <button class="btn btn-primary btn-sm custom-btn" type="submit">@lang('language.confirm')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endcan
    @can('edit-customer')
        <div class="modal fade" role="dialog" tabindex="-1" id="edit-customer-modal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="icon ion-edit"></i>&nbsp;@lang('language.customers.edit_customer')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                <label for="editCustomerName">@lang('language.customers.customer_name'):</label>
                                <input class="form-control form-control-sm" type="text" placeholder="name"
                                       id="editCustomerName" name="customer_name" required>
                            </div>
                            <div class="form-group">
                                <label for="editCustomerPhoneNumber">Phone No:</label>
                                <input class="form-control form-control-sm" type="tel" placeholder="eg +25585...."
                                       id="editCustomerPhoneNumber" name="phone_number" required>
                            </div>
                            <div class="float-right">
                                <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">@lang('close')
                                </button>
                                <button class="btn btn-primary btn-sm custom-btn" type="submit">@lang('language.confirm')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endcan
    @can('delete-customer')
        <div class="modal fade" role="dialog" tabindex="-1" id="delete-customer-modal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="icon ion-android-delete"></i>&nbsp;@lang('language.customers.delete_customer')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <p>@lang('language.customers.delete_customer_message')</p>
                            <div class="float-right">
                                <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">@lang('language.close')
                                </button>
                                <button class="btn btn-primary btn-sm custom-btn" type="submit">@lang('language.btn_delete')</button>
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
            @can('edit-customer')
            //edit customer
            $('#edit-customer-modal').on('show.bs.modal', function (e) {
                let id = $(e.relatedTarget).data('id');
                let name = $(e.relatedTarget).data('name');
                let phone = $(e.relatedTarget).data('phone-number');
                let form = $(this).find('form');
                let action = '{{route('customer.update','')}}/' + id;
                form.attr('action', action);
                form.find("input[name='customer_name']").val(name);
                form.find("input[name='phone_number']").val(phone);
            });
            @endcan()
            @can('delete-customer')
            //delete customer
            $('#delete-customer-modal').on('show.bs.modal', function (e) {
                let id = $(e.relatedTarget).data('id');
                let form = $(this).find('form');
                let action = '{{route('customer.delete','')}}/' + id;
                form.attr('action', action);
            });
            @endcan()

            //search receipt
            let loading = $('#loading');
            let receiptInfo = $('#receipt-info');
            let receiptNumber = $('#number');

            $('#view-receipt-modal').on('show.bs.modal', function () {
                receiptNumber.val('');
                receiptInfo.html('');
            });
            $('#search-receipt-btn').click(function () {
                receiptNumber.val(receiptNumber.val().trim());
                if (receiptNumber.val().length === 0) {
                    receiptNumber.focus();
                    return;
                }
                loading.toggle();
                receiptInfo.html('');
                $.ajax({
                    type: 'GET',
                    url: '{{route('customers.get.receipt','')}}/' + receiptNumber.val(),
                    success: function (data) {
                        console.log(data);
                        loading.toggle();
                        receiptInfo.html(data);
                    }
                });
            });
        });
    </script>
@stop
