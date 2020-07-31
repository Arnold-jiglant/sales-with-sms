@extends('layout.app')
@section('title')

@stop
@section('sale')
    active
@stop
@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a><span>Dashboard</span></a></li>
                    <li class="breadcrumb-item"><a><span>Sale</span></a></li>
                </ol>
            </div>
        </div>
        <h4 class="mt-1">Sell Product</h4>
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
            <div class="col-md-10 col-lg-5">
                <form class="search-form">
                    <div class="form-group">
                        <div class="input-group input-group-sm"><input class="form-control" type="text"
                                                                       placeholder="search product">
                            <div class="input-group-append">
                                <button class="btn btn-primary custom-btn" type="button">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
                <p>Total {{$products->total()}} showing {{$products->firstItem()}}-{{$products->lastItem()}}</p>
                <div class="table-responsive table-bordered text-center" id="products-table">
                    <table class="table table-bordered table-hover table-sm">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Qty</th>
                            <th>Price@</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($products->count()>0)
                            @php($num=$products->firstItem())
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$num}}</td>
                                    <td class="text-left"
                                        title="{{$product->name}}">{{$product->nameformated}}</td>
                                    <td>{{$product->remainingQty}}</td>
                                    <td>{{number_format($product->sellingPrice)}}</td>
                                    <td>
                                        <div class="options">
                                            @if($product->remainingQty>0)
                                                <a href="#" class="option-link" data-toggle="modal"
                                                   data-target="#add-product-modal"
                                                   data-name="{{$product->name}}" data-id="{{$product->id}}"
                                                   data-discounts="{{json_encode($product->discountRates)}}"
                                                   data-sellingprice="{{$product->sellingPrice}}"
                                                   data-buyingprice="{{$product->buyingPrice}}"
                                                   data-hasSize="{{$product->hasSize}}"
                                                   data-discountType="{{$product->discount_type_id}}"
                                                   data-remaining="{{$product->remainingQty}}">
                                                    <i class="icon ion-ios-cart"></i>&nbsp;
                                                    <span
                                                        class="link-text">Add</span>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @php($num++)
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">No Product left</td>
                            </tr>
                        @endif

                        </tbody>
                    </table>
                </div>
                <nav class="mt-1">
                    {{$products->links()}}
                </nav>
            </div>
            <div class="col-md-11 col-lg-7">
                @if(Session('sales'))
                    <form id="sell-form" method="POST" action="{{route('sale.confirm')}}"
                          style="border: 1px dashed #1c1c1c;border-radius: 10px;">
                        {{csrf_field()}}
                        <div class="form-group mt-2">
                            <label>Selling to customer?</label>
                            <div class="custom-control custom-switch">
                                <input class="custom-control-input" type="checkbox" id="hasCustomer" name="hasCustomer">
                                <label class="custom-control-label" for="hasCustomer"></label>
                            </div>
                        </div>
                        <div id="customer-container" class="form-group" style="display: none">
                            <label for="customerName">Customer:</label>
                            <input id="customerName" class="form-control form-control-sm" type="text" autocomplete="off">
                            <input type="hidden" name="customer_id">
                            <div id="customer-list" class="p-2"></div>
                        </div>
                        <p>Selected Products</p>
                        <div class="table-responsive table-bordered text-center" id="products-table">
                            <table class="table table-bordered table-sm">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Qty</th>
                                    <th>Price@</th>
                                    <th>Discount@</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($num=1)
                                @foreach(Session('sales') as $sale)
                                    <tr>
                                        <td>{{$num}}</td>
                                        <td class="text-center">{{$sale->name}}</td>
                                        <td>{{$sale->quantity}}</td>
                                        <td>{{$sale->sellingPrice}}</td>
                                        <td>{{$sale->discount}}</td>
                                        <td>{{number_format($sale->total,2)}}</td>
                                        <td>
                                            <a href="{{route('sale.delete.item',$sale->inventory_product_id)}}"
                                               class="close" style="cursor: pointer;color: red;" title="remove">
                                                <i class="icon ion-close-round"></i></a>
                                        </td>
                                    </tr>
                                    @php($num++)
                                @endforeach
                                <tr>
                                    <td colspan="3">Payment Type</td>
                                    <td colspan="4">
                                        <div>
                                            <div class="custom-control custom-control-inline custom-radio">
                                                <input class="custom-control-input" type="radio" name="paymentType"
                                                       checked id="cash" value="CSH">
                                                <label class="custom-control-label" for="cash">Cash</label>
                                            </div>
                                            <div class="custom-control custom-control-inline custom-radio"
                                                 data-toggle="popover"
                                                 data-content="Credit Payments, NB. Customer name is required"
                                                 data-trigger="hover">
                                                <input class="custom-control-input" type="radio" name="paymentType"
                                                       id="credit" value="CRD">
                                                <label class="custom-control-label" for="credit">Credit</label>
                                            </div>
                                            <div class="custom-control custom-control-inline custom-radio"
                                                 data-toggle="popover"
                                                 data-content="Debt Payments, NB. Customer name is required"
                                                 data-trigger="hover">
                                                <input class="custom-control-input" type="radio" name="paymentType"
                                                       id="debit" value="DBT">
                                                <label class="custom-control-label" for="debit">Debit</label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">TOTAL AMOUNT</td>
                                    <td colspan="4" class="font-weight-bold value"
                                        style="font-size: 13pt;">{{number_format(Session('sales')->sum('total'),2)}}/=
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="m-3 text-center">
                            <a href="{{route('cancel.sale')}}" class="btn btn-light btn-sm mr-2" type="button"
                               data-dismiss="modal">Cancel</a>
                            <button class="btn btn-primary btn-sm custom-btn" type="button" data-toggle="modal"
                                    data-target="#confirm-sell-modal">Confirm
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@stop
@section('modal')
    <div class="modal fade" role="dialog" tabindex="-1" id="add-product-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon ion-ios-cart"></i>&nbsp;Sell Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('sale.add')}}">
                        {{csrf_field()}}
                        <input id="name" type="hidden" name="name">
                        <input id="price" type="hidden" name="sellingPrice">
                        <input id="buying" type="hidden" name="buyingPrice">
                        <input id="invProdId" type="hidden" name="inventory_product_id">
                        <div class="form-row">
                            <div class="col-sm-6">
                                <p><span>Product Name:</span><span id="productName" class="ml-1 value">Text</span></p>
                                <p><span>Selling Price:</span><span id="sellingPrice" class="ml-1 value">Text</span></p>
                            </div>
                            <div class="col-sm-6">
                                <p><span>Available Quantity:</span>
                                    <span id="remainingQty" class="ml-1 value">Text</span>
                                </p>
                                <p><span>Buying Price:</span>
                                    <span id="buyingPrice" class="ml-1 value">Text</span>
                                </p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-6">
                                <label for="quantity">Quantity</label>
                                <input class="form-control form-control-sm" type="number" value="0" name="quantity"
                                       placeholder="quantity" min="0.25" step="0.25" id="quantity">
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="total">Total</label>
                                    <input class="form-control form-control-sm" type="number" value="0"
                                           readonly="" placeholder="quantity" min="0" id="total">
                                </div>
                            </div>
                        </div>
                        <div class="form-row mt-2">
                            <div class="col-sm-6">
                                <div id="include-discount-container" style="display: none;">
                                    <label>Include discount?</label>
                                    <div class="custom-control custom-switch">
                                        <input class="custom-control-input" type="checkbox" id="includeDiscount">
                                        <label class="custom-control-label" for="includeDiscount"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="discountAmount">Discount Per Item</label>
                                    <input class="form-control form-control-sm" type="number" placeholder="discount"
                                           min="0" id="discountAmount" name="discountAmount">
                                </div>
                            </div>
                        </div>
                        <div class="form-row mt-2">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="totalDiscount">Total&nbsp;Discount</label>
                                    <input class="form-control form-control-sm" type="number" value="0" readonly=""
                                           id="totalDiscount">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="dueAmount"><strong>DUE&nbsp;AMOUNT</strong></label>
                                    <input class="form-control value" type="number" value="0" readonly=""
                                           id="dueAmount" name="total">
                                </div>
                            </div>
                        </div>
                        <div class="float-right mt-2">
                            <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary btn-sm custom-btn" type="submit">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="confirm-sell-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon ion-ios-cart"></i>&nbsp;Confirm sell</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form>
                        <p>Do you want to proceed?</p>
                        <div class="float-right mt-2">
                            <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">Close</button>
                            <button id="confirm-btn" class="btn btn-primary btn-sm custom-btn" type="button">Yes
                            </button>
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
            let quantity = $('#quantity');
            let discounts, isPercent;
            $('#add-product-modal').on('show.bs.modal', function (e) {
                quantity.val(0);
                $('#total').val(0);
                $('#discountAmount').val(0);
                $('#dueAmount').val(0);
                $('#includeDiscount').prop('checked', false);

                let id = $(e.relatedTarget).data('id');
                let name = $(e.relatedTarget).data('name');
                let remaining = $(e.relatedTarget).data('remaining');
                let sellingPrice = $(e.relatedTarget).data('sellingprice');
                let buyingPrice = $(e.relatedTarget).data('buyingprice');
                discounts = $(e.relatedTarget).data('discounts');
                console.log(discounts);
                isPercent = $(e.relatedTarget).data('discounttype') === 2;
                let hasSize = $(e.relatedTarget).data('hassize') === 1;
                $('#invProdId').val(id);
                $('#name').val(name);
                $('#price').val(sellingPrice);
                $('#buying').val(buyingPrice);
                $('#sellingPrice').text(sellingPrice);
                $('#buyingPrice').text(buyingPrice);
                $('#productName').text(name);
                $('#remainingQty').text(remaining);
                if (discounts === null) {
                    $('#include-discount-container').hide();
                } else {
                    $('#include-discount-container').show();
                }
                //limit quantity
                quantity.attr('max', remaining);
                if (hasSize) {
                    quantity.attr('step', '0.25');
                    quantity.attr('min', '0.25');
                } else {
                    quantity.attr('step', '1');
                    quantity.attr('min', '1');
                }
            });

            //calculate total
            quantity.change(calculateTotal).keyup(calculateTotal);

            function calculateTotal() {
                let qty = quantity.val();
                let price = $('#sellingPrice').text();
                let total = qty * price;
                $('#total').val(total);
                findDiscountAmount();
                let totalDiscount = $('#discountAmount').val() * qty;
                $('#totalDiscount').val(totalDiscount);
                $('#dueAmount').val(total - totalDiscount);

            }

            function findDiscountAmount() {
                if ($('#includeDiscount').is(':checked')) {
                    let qty = quantity.val();
                    let price = $('#sellingPrice').text();
                    for (let i = 0; i < discounts.length; i++) {
                        if (qty >= discounts[i].qty) {
                            if (isPercent) {
                                $('#discountAmount').val(price * (discounts[i].amount / 100));
                            } else {
                                $('#discountAmount').val(discounts[i].amount);
                            }
                            break;
                        }
                    }
                } else {
                    $('#discountAmount').val(0);
                }
            }

            //include discount
            $('#includeDiscount').change(calculateTotal);
            $('#discountAmount').change(calculateTotalWithManualDiscount).keyup(calculateTotalWithManualDiscount);

            function calculateTotalWithManualDiscount() {
                let qty = quantity.val();
                let price = $('#sellingPrice').text();
                let total = qty * price;
                $('#total').val(total);
                let totalDiscount = $('#discountAmount').val() * qty;
                $('#totalDiscount').val(totalDiscount);
                $('#dueAmount').val(total - totalDiscount);
            }

            //customer choosing
            let customername = $('#customerName');
            let customerContainer = $('#customer-container');
            $('#hasCustomer').change(function () {
                if ($(this).is(':checked')) {
                    customerContainer.show('fast');
                    customerContainer.find("input[name='customer_id']").attr('disabled', false);

                } else {
                    customerContainer.hide('fast');
                    customerContainer.find("input[name='customer_id']").attr('disabled', true);
                    customername.val('');
                }
            });
            $('#confirm-btn').click(function () {
                $('#sell-form').trigger('submit');
            });
            //submitting form
            $('#sell-form').submit(function () {
                let paymentTypes = $('input[name="paymentType"]');
                let isCash = true;
                paymentTypes.each(function (item) {
                    if ($(this).is(':checked')) {
                        isCash = $(this).val() === 'CSH';
                    }
                });
                if (!isCash && !$('#hasCustomer').is(':checked')) {
                    alert('Choose customer first');
                    return false;
                }
                if ($('#hasCustomer').is(':checked') && customerContainer.find("input[name='customer_id']").val().length === 0) {
                    customername.focus();
                    return false;
                }
            });

            //auto-complete customer
            customername.on('keyup', function () {
                let search = $(this).val();
                if (search.length < 1) {
                    $('#customer-list').html('');
                    return;
                }
                $.ajax({
                    url: "{{ route('customers.get') }}",
                    type: "GET",
                    data: {'search': $(this).val()},
                    success: function (data) {
                        $('#customer-list').html('');
                        $('#customer-list').html(data);
                    }
                });
            });
            $(document).on('click', '#customer-list li', function () {
                let name = $(this).text();
                let id = $(this).data('id');
                customername.val(name);
                customerContainer.find("input[name='customer_id']").val(id);
                $('#customer-list').html('');
            });
        });
    </script>
@stop
