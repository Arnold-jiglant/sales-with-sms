@extends('layout.app')
@section('title')
    Inventory
@stop
@section('inventory')
    active
@stop
@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="col">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a><span>Dashboard</span></a></li>
                    <li class="breadcrumb-item"><a><span>Inventory</span></a></li>
                    <li class="breadcrumb-item"><a><span>Add</span></a></li>
                </ol>
            </div>
        </div>
        <h3 class="mt-3">Add Inventory</h3>
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
        <div class="col-md-11 col-lg-10 col-xl-8 offset-lg-1 offset-xl-1 mb-2">
            <div id="inventoryInfo" class="p-3" style="font-size: 11pt;">
                <div class="row">
                    <div class="col-sm-6">
                        <p><span>Total Cost:&nbsp;</span>
                            <span
                                class="ml-1 value">{{Session('inventory')?number_format(Session('inventory')->totalCost):0}}</span>
                        </p>
                        <p><span>Expected Amount After Sale:&nbsp;</span><span
                                class="ml-1 value">{{Session('inventory')?number_format(Session('inventory')->expectedAmount):0}}</span>
                        </p>
                    </div>
                    <div class="col">

                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            @can('add-inventory')
                <div class="text-right">
                    @if(Session('products'))
                        <button class="btn btn-primary btn-sm mb-2" type="button" data-toggle="modal"
                                data-target="#cancel-modal"><i class="icon ion-close"></i> Cancel
                        </button>
                    @endif
                    <button class="btn btn-primary btn-sm custom-btn mb-2" type="button" data-toggle="modal"
                            data-target="#add-product-modal"><i class="icon ion-android-add"></i>Add Product
                    </button>
                </div>
            @endcan
            @if ($errors->any())
                <ul>
                    @foreach($errors->all() as $error)
                        <li class="text-danger">{{$error}}</li>
                    @endforeach
                </ul>
            @endif
        </div>
        <div class="table-responsive table-bordered text-center"
             id="products-table">
            <table class="table table-bordered table-hover table-sm">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Cost</th>
                    <th>Selling Price</th>
                    <th>Discount Type</th>
                    <th>Discounts</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if(Session('products'))
                    @php($num=1)
                    @foreach(Session('products') as $inv)
                        <tr class="{{(Session('duplicateProductId')!=null && $inv->product_id==Session('duplicateProductId'))?'bg-warning':''}}">
                            <td>{{$num}}</td>
                            <td>{{$inv->product->name}}</td>
                            <td>{{$inv->quantity}}</td>
                            <td>{{number_format($inv->cost)}}/=</td>
                            <td>{{number_format($inv->sellingPrice)}}/=</td>
                            <td>{{$inv->discountType->type??''}}</td>
                            <td class="text-left">
                                @if($inv->discountRates!=null)
                                    @foreach($inv->discountRates as $discount)
                                        <p class="m-0 pl-2"><span
                                                class="mr-1">&gt;= {{$discount['qty']}} :</span><span>{{number_format($discount['amount'])}}{{$inv->discount_type_id==2?'(%)':''}}</span>
                                        </p>
                                    @endforeach
                                @endif
                            </td>
                            <td><a href="{{route('delete.collection.product',$inv->product_id)}}" class="close"
                                   style="cursor: pointer;color: red;" title="delete"><i
                                        class="icon ion-close-round"></i></a></td>
                        </tr>
                        @php($num++)
                    @endforeach
                @else
                    <tr>
                        <td colspan="8" class="p-2"><h5>Add Product</h5></td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        @if(Session('products'))
            <div class="col text-center">
                <button data-toggle="modal" data-target="#confirm-modal" class="btn btn-primary custom-btn m-3"
                        type="button">Confirm
                </button>
            </div>
        @endif
    </div>
@stop
@section('modal')
    @can('add-inventory')
        <div class="modal fade" role="dialog" tabindex="-1" id="add-product-modal" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="icon ion-plus"></i>&nbsp;Add Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form id="add-product-form" class="pt-3 pb-3 mb-3" action="{{route('inventory.add')}}"
                              method="POST">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="product">Product Name</label>
                                <select class="custom-select custom-select-sm" name="product" id="product">
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" data-toggle="popover" data-content="whole quantity eg. 200 pieces"
                                 data-trigger="focus" data-placement="right">
                                <label for="quantity">Quantity</label>
                                <input class="form-control form-control-sm" type="number"
                                       placeholder="Inventory Quantity"
                                       min="0.25" step="0.25" id="quantity" name="quantity" required>
                            </div>
                            <div class="form-group" data-toggle="popover"
                                 data-content="cost of the whole package eg. 200 pc -> 200,000/="
                                 data-trigger="focus" data-placement="right">
                                <label for="cost">Cost</label>
                                <input id="cost" class="form-control form-control-sm" type="number"
                                       placeholder="inventory quantity cost" min="0" step="0.01" name="cost" required>
                            </div>
                            <div class="form-group" data-toggle="popover"
                                 data-content="Selling Price for single item eg. 12,000/="
                                 data-trigger="focus" data-placement="right">
                                <label for="sellingPrice">Selling Price</label>
                                <div class="form-row">
                                    <div class="col-9">
                                        <input class="form-control form-control-sm" type="number"
                                               placeholder="Selling Price" min="0" step="0.01" name="sellingPrice" id="sellingPrice"
                                               required>
                                    </div>
                                    <div class="col-3 text-center">
                                        <p>Profit: <span id="profit" class="font-weight-bold"></span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" data-toggle="popover"
                                 data-content="product discount depending on quantity. eg. if qty >5 discount 1000, for 6,000/= shoes will be sold for 5,000/= OR if qty >5 discount 10%, for 6,000/= shoes will be sold for 5,400/="
                                 data-trigger="hover" data-placement="right">
                                <div class="custom-control custom-control-inline custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="discount-checkbox"
                                           name="discount">
                                    <label class="custom-control-label" for="discount-checkbox">Discount rates?</label>
                                </div>
                            </div>
                            <div id="discounts-container" class="discount-container" style="display: none">
                                <div class="form-row mb-1">
                                    <div class="col">
                                        <span class="mr-2">Type:</span>
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input class="custom-control-input" type="radio" name="discountType"
                                                   id="amount" value="1" checked>
                                            <label class="custom-control-label"
                                                   for="amount">Amount ($)</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input class="custom-control-input" type="radio" name="discountType"
                                                   id="percent" value="2">
                                            <label class="custom-control-label"
                                                   for="percent">Percent (%)</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row mb-2">
                                    <div class="col text-right">
                                        <button id="addDiscountBtn" class="btn btn-primary btn-sm custom-btn"
                                                type="button">
                                            <i
                                                class="icon ion-plus"></i>Add
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="float-right m-4">
                                <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">Close
                                </button>
                                <button class="btn btn-primary btn-sm custom-btn" type="submit">Confirm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" role="dialog" tabindex="-1" id="confirm-modal" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="icon ion-edit"></i>&nbsp;Description</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('inventory.confirm')}}" method="POST">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="description">Description(optional):</label>
                                <textarea class="form-control form-control-sm" rows="3" id="description"
                                          name="description"></textarea>
                            </div>
                            <div class="float-right m-4">
                                <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">Close
                                </button>
                                <button class="btn btn-primary btn-sm custom-btn" type="submit">Confirm New Inventory
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" role="dialog" tabindex="-1" id="cancel-modal" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="icon ion-alert"></i>&nbsp;Cancel</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('inventory.cancel')}}" method="POST">
                            {{csrf_field()}}
                            <p>Are you sure you want to cancel?</p>
                            <div class="float-right m-4">
                                <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">Close
                                </button>
                                <button class="btn btn-primary btn-sm" type="submit">Confirm
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
    <script src="{{asset('assets/js/add-inventory.js')}}"></script>
@stop
