@extends('layout.app')
@section('title')
    Inventory Products
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
                    <li class="breadcrumb-item"><a><span>Products</span></a></li>
                </ol>
            </div>
        </div>
        <h4>Inventory Products</h4>
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
        <div class="col-md-11 col-lg-10 col-xl-8 offset-lg-1 offset-xl-1">
            <div id="inventoryInfo" class="card card-body" style="font-size: 11pt;">
                <div class="row">
                    <div class="col-sm-6">
                        <p><span>Total Cost:&nbsp;</span><span
                                class="ml-1 value">{{number_format($inventory->totalCost,2)}}</span>
                        </p>
                        <p><span>Expected Amount:&nbsp;</span><span
                                class="ml-1 value">{{number_format($inventory->expectedAmount,2)}}</span>
                        </p>
                        <p><span>Curent Sales:&nbsp;</span><span
                                class="ml-1 value">{{number_format($inventory->totalSales,2)}}</span>
                        </p>
                        <p><span>Loss Amount:&nbsp;</span><span
                                class="ml-1 text-danger">{{number_format($inventory->totalLossAMount,2)}}</span>
                        </p>
                        <p><span>Issuer:&nbsp;</span><span class="ml-1 value">{{$inventory->user->name}}</span></p>
                        <p><span>Issue Date:&nbsp;</span><span
                                class="ml-1 value">{{$inventory->created_at->format('D d M Y')}}</span></p>
                    </div>
                    <div class="col">
                        <span>Description:&nbsp;</span>
                        <div class="description p-3">
                            <p class="value font-weight-normal">{{$inventory->description}}</p>
                        </div>
                        <div class="text-right">
                            <button class="btn btn-primary btn-sm custom-btn mt-2" data-toggle="modal"
                                    data-target="#edit-description-modal">Edit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-8 col-xl-6 offset-md-2">
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
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6 order-md-1">
            @can('add-inventory')
                <div class="text-right">
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
        <div class="col-5 order-md-0">
            <p class="pl-3">Total {{$invProducts->total()}} products</p>
        </div>
    </div>
    <div class="col offset-lg-0 offset-xl-0">
        <div class="table-responsive table-bordered text-center" id="inventory-products-table">
            <table class="table table-bordered table-hover table-sm">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Remain</th>
                    <th>Stock Level</th>
                    <th>Cost</th>
                    <th>Buying Price@</th>
                    <th>Selling Price@</th>
                    <th>Time</th>
                    <th title="Loss Amount">L/Amount</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @php($num=$invProducts->firstItem())
                @foreach($invProducts as $invProduct)
                    <tr class="{{(Session('existingProduct')&&Session('existingProduct')==$invProduct->product_id)?'bg-warning':''}}">
                        <td>{{$num}}.</td>
                        <td class="text-left">{{$invProduct->name}}</td>
                        <td>{{$invProduct->quantity}}</td>
                        <td>{{$invProduct->remainingQty}}</td>
                        <td>
                            {{$invProduct->stockLevel}}%
                            <div class="progress" style="height: 10px;">
                                <div
                                    class="progress-bar progress-bar-striped progress-bar-animated {{$invProduct->stockLevelClass}}"
                                    aria-valuenow="{{$invProduct->stockLevel}}"
                                    aria-valuemin="0" aria-valuemax="100"
                                    style="width: {{$invProduct->stockLevel}}%;">
                                </div>
                            </div>
                        </td>
                        <td>{{number_format($invProduct->cost)}}</td>
                        <td>{{number_format($invProduct->buyingPrice,2)}}</td>
                        <td>{{number_format($invProduct->sellingPrice,2)}}</td>
                        <td>{{$invProduct->created_at->format('d/m/Y')}}</td>
                        <td class="text-danger">{{number_format($invProduct->LossAmount)}}</td>
                        <td>
                            <div class="options">
                                <a href="#" class="option-link edit" data-toggle="modal"
                                   data-target="#add-to-stock-modal" data-id="{{$invProduct->id}}"
                                   data-name="{{$invProduct->name}}" data-remainingQty="{{$invProduct->remainingQty}}"
                                   data-quantity="{{$invProduct->quantity}}"
                                   data-cost="{{$invProduct->cost}}"
                                   data-sellingPrice="{{$invProduct->sellingPrice}}"
                                   data-hasDiscount="{{$invProduct->hasDiscount}}"
                                   data-discountType="{{$invProduct->discount_type_id}}">
                                    <i class="icon ion-plus"></i>&nbsp;
                                    <span class="link-text">Stock</span>
                                </a>
                                <a href="#" class="option-link edit" data-toggle="modal"
                                   data-target="#edit-inventory-modal" data-id="{{$invProduct->id}}"
                                   data-name="{{$invProduct->name}}" data-remainingQty="{{$invProduct->remainingQty}}"
                                   data-quantity="{{$invProduct->quantity}}"
                                   data-cost="{{$invProduct->cost}}"
                                   data-sellingPrice="{{$invProduct->sellingPrice}}"
                                   data-hasDiscount="{{$invProduct->hasDiscount}}"
                                   data-discountType="{{$invProduct->discount_type_id}}">
                                    <i class="icon ion-edit"></i>&nbsp;
                                    <span class="link-text">edit</span>
                                </a>
                                <a href="#" class="option-link" data-toggle="modal"
                                   data-target="#product-loss-modal" data-id="{{$invProduct->id}}"
                                   data-name="{{$invProduct->name}}" data-remainingQty="{{$invProduct->remainingQty}}"
                                   data-sellingPrice="{{$invProduct->sellingPrice}}"
                                   data-buyingPrice="{{$invProduct->buyingPrice}}"
                                   data-hassize="{{$invProduct->hasSize}}">
                                    <i class="icon ion-arrow-graph-down-right"></i>&nbsp;
                                    <span class="link-text">Loss</span>
                                </a>
                                <a href="#" class="option-link edit" data-toggle="modal"
                                   data-target="#delete-inventory-modal">
                                    <i class="icon ion-android-delete"></i>&nbsp;
                                    <span class="link-text">Delete</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @php($num++)
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-10 col-lg-7 offset-md-1 offset-lg-3">
            <nav>
                {{$invProducts->links()}}
            </nav>
        </div>
    </div>
@stop
@section('modal')
    @can('add-inventory')
        <div class="modal fade" role="dialog" tabindex="-1" id="add-product-modal" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="icon ion-plus"></i>&nbsp;Add Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="add-product-form" class="pt-3 pb-3 mb-3"
                              action="{{route('inventory.add.product',$inventory->id)}}"
                              method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="PUT">
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
                                       min="1" step="0.25" id="quantity" name="quantity" required>
                            </div>
                            <div class="form-group" data-toggle="popover"
                                 data-content="cost of the whole package eg. 200 pc -> 200,000/="
                                 data-trigger="focus" data-placement="right">
                                <label for="cost">Cost</label>
                                <input id="cost" class="form-control form-control-sm" type="number"
                                       placeholder="inventory quantity cost" min="0" name="cost" required>
                            </div>
                            <div class="form-group" data-toggle="popover"
                                 data-content="Selling Price for single item eg. 12,000/="
                                 data-trigger="focus" data-placement="right">
                                <label for="sellingPrice">Selling Price</label>
                                <div class="form-row">
                                    <div class="col-9">
                                        <input class="form-control form-control-sm" type="number"
                                               placeholder="Selling Price" min="0" name="sellingPrice" id="sellingPrice"
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
                            <div id="discounts-container" style="display: none">
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
        <div class="modal fade" role="dialog" tabindex="-1" id="add-to-stock-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="icon ion-plus"></i>&nbsp;Add To Stock</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="PUT">
                            <input id="totalStockQuantity" type="hidden">
                            <input id="totalStockCost" type="hidden">
                            <p><span>Product Name:</span><span id="productStockNameLabel" class="ml-1 value">Text</span>
                            </p>
                            <p><span>Remaining Quantity:</span><span id="remainingStockQtyLabel"
                                                                     class="ml-1 value">Text</span>
                            </p>
                            <div class="form-group" data-toggle="popover" data-content="whole quantity eg. 200 pieces"
                                 data-trigger="focus" data-placement="right">
                                <label for="newStockQuantity">New Quantity</label>
                                <input class="form-control form-control-sm" type="number"
                                       placeholder="New Quantity" step="0.25"
                                       min="1" id="newStockQuantity" name="newQuantity" required>
                            </div>
                            <div class="form-group" data-toggle="popover"
                                 data-content="cost of the whole package eg. 200 pc -> 200,000/=" data-trigger="focus"
                                 data-placement="right">
                                <label for="newStockCost">New Cost</label>
                                <input class="form-control form-control-sm" type="number"
                                       placeholder="quantity cost"
                                       min="0" step="0.01" id="newStockCost" name="newCost" required>
                            </div>
                            <div class="form-group" data-toggle="popover"
                                 data-content="Selling Price for single item eg. 12,000/ NB. This price will affect current selling price"
                                 data-trigger="focus" data-placement="right">
                                <label for="newStockSellingPrice">New Selling Price</label>
                                <div class="form-row">
                                    <div class="col-7">
                                        <input class="form-control form-control-sm" type="number"
                                               placeholder="Selling Price"
                                               min="0" step="0.01" id="newStockSellingPrice" name="newSellingPrice"
                                               required>
                                    </div>
                                    <div class="col-5 text-center">
                                        <p class="d">Profit: <span id="newStockProfitLabel"
                                                                   class="font-weight-bold"></span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right mt-2">
                                <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">Close
                                </button>
                                <button class="btn btn-primary btn-sm custom-btn" type="submit">Add Stock</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endcan
    @can('edit-inventory')
        <div class="modal fade" role="dialog" tabindex="-1" id="edit-description-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="icon ion-edit"></i>&nbsp;Description</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('inventory.update.desc',$inventory->id)}}" method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                <label for="description">Description(optional):</label>
                                <textarea class="form-control form-control-sm" rows="3" id="description"
                                          name="description">{{$inventory->description}}</textarea>
                            </div>
                            <div class="float-right m-4">
                                <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">Close
                                </button>
                                <button class="btn btn-primary btn-sm custom-btn" type="submit">Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" role="dialog" tabindex="-1" id="edit-inventory-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="icon ion-edit"></i>&nbsp;Edit Inventory</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="PUT">
                            <p><span>Product Name:</span><span id="productNameLabel" class="ml-1 value">Text</span></p>
                            <p><span>Remaining Quantity:</span><span id="remainingQtyLabel"
                                                                     class="ml-1 value">Text</span>
                            </p>
                            <p><span>Entered Quantity:</span><span id="quantityLabel" class="ml-1 value">Text</span></p>
                            <div class="form-group" data-toggle="popover" data-content="whole quantity eg. 200 pieces"
                                 data-trigger="focus" data-placement="right">
                                <label for="newQuantity">New Quantity</label>
                                <input class="form-control form-control-sm" type="number"
                                       placeholder="Inventory Quantity" step="0.25"
                                       min="1" id="newQuantity" name="newQuantity" required>
                            </div>
                            <p class="mt-2"><span>Entered Cost:</span><span id="costLabel"
                                                                            class="ml-1 value">Text</span></p>
                            <div class="form-group" data-toggle="popover"
                                 data-content="cost of the whole package eg. 200 pc -> 200,000/=" data-trigger="focus"
                                 data-placement="right">
                                <label for="newCost">New Cost</label>
                                <input class="form-control form-control-sm" type="number"
                                       placeholder="inventory quantity cost"
                                       min="0" step="0.01" id="newCost" name="newCost" required>
                            </div>
                            <p class="mt-2"><span>Entered Selling Price:</span><span id="sellingPriceLabel"
                                                                                     class="ml-1 value">Text</span></p>
                            <div class="form-group" data-toggle="popover"
                                 data-content="Selling Price for single item eg. 12,000/ NB. This price will affect current selling price"
                                 data-trigger="focus" data-placement="right">
                                <label for="newSellingPrice">New Selling Price</label>
                                <div class="form-row">
                                    <div class="col-7">
                                        <input class="form-control form-control-sm" type="number"
                                               placeholder="Selling Price"
                                               min="0" step="0.01" id="newSellingPrice" name="newSellingPrice" required>
                                    </div>
                                    <div class="col-5 text-center">
                                        <p class="d">Profit: <span id="profitLabel" class="font-weight-bold"></span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" data-toggle="popover"
                                 data-content="product discount depending on quantity. eg. if qty >5 discount 1000, for 6,000/= shoes will be sold for 5,000/="
                                 data-trigger="hover" data-placement="right">
                                <div class="custom-control custom-control-inline custom-checkbox">
                                    <input class="custom-control-input" type="checkbox"
                                           id="edit-discount-checkbox" name="hasDiscount">
                                    <label class="custom-control-label" for="edit-discount-checkbox">Discount
                                        rates?</label>
                                </div>
                            </div>
                            <div id="edit-discounts-container" class="discounts-container" style="display: none">
                                <div class="form-row mb-1">
                                    <div class="col"><span class="mr-2">Type:</span>
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input class="custom-control-input" type="radio" name="discountType"
                                                   checked="" id="edit-amount" value="1">
                                            <label class="custom-control-label" for="edit-amount">Amount($)</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input class="custom-control-input" type="radio" name="discountType"
                                                   id="edit-percent" value="2">
                                            <label class="custom-control-label" for="edit-percent">Percent (%)</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row mb-1">
                                    <div class="col">
                                        <button id="add-discount-btn"
                                                class="btn btn-primary btn-sm custom-btn float-right" type="button">
                                            <i class="icon ion-plus"></i>Add
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div id="loading" class="loading" style="display: none">
                                <span class="spinner-border" role="status"
                                      style="width: 40px;height: 40px; color:#00bacc;"></span>
                                <span class="mt-2">Loading Discount Rates...</span>
                            </div>
                            <div class="text-right mt-2">
                                <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">Close
                                </button>
                                <button class="btn btn-primary btn-sm custom-btn" type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" role="dialog" tabindex="-1" id="product-loss-modal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="icon ion-arrow-graph-down-right"></i>&nbsp;Product Loss</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <input id="invProductId" type="hidden">
                            <div class="form-row mb-2">
                                <div class="col-sm-6">
                                    <p><span>Product Name:</span><span id="productNameLabelLoss"
                                                                       class="ml-1 value">Text</span></p>
                                    <p><span>Remaining Quantity:</span><span id="remainingQtyLabelLoss"
                                                                             class="ml-1 value">Text</span></p>
                                </div>
                                <div class="col-sm-6">
                                    <p><span>Buying Price:</span><span id="buyingPriceLabelLoss"
                                                                       class="ml-1 value">Text</span></p>
                                    <p><span>SellingPrice:</span><span id="sellingPriceLabelLoss" class="ml-1 value">Text</span>
                                    </p>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-6">
                                    <h6 class="mb-0 mt-3">Last Losses</h6>
                                </div>
                                <div class="col-6">
                                    <button id="show-add-loss-btn" class="btn btn-primary btn-sm custom-btn float-right"
                                            type="button"><i
                                            class="icon ion-android-add"></i>Add
                                    </button>
                                </div>
                            </div>
                            <div id="add-loss-container" class="mt-1 p-2 mb-2"
                                 style="border: 1px dashed #1c1c1c;border-radius: 10px;display: none;">
                                <div class="form-row">
                                    <div class="col-4">
                                        <input class="form-control form-control-sm" type="number" name="quantity"
                                               placeholder="quantity" min="0" step="0.25" id="lossQuantity">
                                    </div>
                                    <div class="col-6">
                                        <input class="form-control form-control-sm" type="number"
                                               placeholder="Total loss amount" min="0" step="0.01" id="lossAmount">
                                    </div>
                                    <div class="col">
                                        <span class="float-right close" style="cursor: pointer;" title="Close">
                                            <i class="icon ion-close-round"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-row mt-2">
                                    <textarea id="lossDescription" class="form-control form-control-sm col-10 offset-1"
                                              cols="30" rows="4" placeholder="description (optinal)"></textarea>
                                </div>
                                <div class="form-row">
                                    <div class="col mt-2">
                                        <button id="add-loss-btn"
                                                class="btn btn-primary btn-sm custom-btn float-right mr-2"
                                                type="button">
                                            Confirm
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div id="loss-table" class="table-responsive table-bordered">
                                <table class="table table-bordered table-sm">
                                    <thead class="text-danger">
                                    <tr>
                                        <th>#</th>
                                        <th>Qty</th>
                                        <th>Loss</th>
                                        <th>Date</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr title="Some Descriptions">
                                        <td>1</td>
                                        <td>3</td>
                                        <td>3,000</td>
                                        <td>10/06/2020</td>
                                        <td>
                                            <div class="options">
                                                <a href="#" class="option-link edit" data-toggle="modal"
                                                   data-target="#edit-loss-modal">
                                                    <i class="icon ion-edit"></i>&nbsp;
                                                    <span class="link-text">edit</span>
                                                </a>
                                                <a href="#" class="option-link delete" data-toggle="modal"
                                                   data-target="#delete-loss-modal">
                                                    <i class="icon ion-android-delete"></i>&nbsp;
                                                    <span class="link-text">delete</span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr title="Some Descriptions">
                                        <td>2</td>
                                        <td>3</td>
                                        <td>3,000</td>
                                        <td>10/06/2020</td>
                                        <td>Cell 5</td>
                                    </tr>
                                    <tr title="Some Descriptions">
                                        <td>3</td>
                                        <td>3</td>
                                        <td>3,000</td>
                                        <td>10/06/2020</td>
                                        <td>Cell 5</td>
                                    </tr>
                                    <tr title="Some Descriptions">
                                        <td>4</td>
                                        <td>3</td>
                                        <td>3,000</td>
                                        <td>10/06/2020</td>
                                        <td>Cell 5</td>
                                    </tr>
                                    <tr title="Some Descriptions">
                                        <td>5</td>
                                        <td>3</td>
                                        <td>3,000</td>
                                        <td>10/06/2020</td>
                                        <td>Cell 5</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div id="loadingLoss" class="loading">
                                <span class="spinner-border" role="status"
                                      style="width: 40px;height: 40px;color: #00bacc;"></span>
                                <span class="mt-2">Loading..</span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" role="dialog" tabindex="-1" id="edit-loss-modal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="icon ion-edit"></i>&nbsp;Edit Loss</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <input id="lossInvProductId" type="hidden">
                            <input id="editLossId" type="hidden">
                            <input id="editLossRemaining" type="hidden">
                            <div class="form-group">
                                <label>Loss Quantity</label>
                                <input class="form-control form-control-sm" type="number"
                                       placeholder="quantity" min="0" step="0.01" id="editLossQuantity">
                            </div>
                            <div class="form-group">
                                <label>Loss Amount</label>
                                <input class="form-control form-control-sm" type="number"
                                       placeholder="Total loss amount" min="0" step="0.01" id="editLossAmount">
                            </div>
                            <div class="form-group">
                                <label>Description(optional)</label>
                                <textarea class="form-control form-control-sm"
                                          placeholder="description" rows="4" id="editLossDescription"></textarea>
                            </div>
                            <div class="float-right">
                                <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">Close
                                </button>
                                <button id="update-loss-btn" class="btn btn-primary btn-sm custom-btn" type="button">
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" role="dialog" tabindex="-1" id="delete-inventory-modal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="icon ion-android-delete"></i>&nbsp;Delete Inventory</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <p>Are you sure you want to delete this inventory product?</p>
                            <div class="float-right">
                                <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">Close
                                </button>
                                <button class="btn btn-primary btn-sm custom-btn" type="button">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" role="dialog" tabindex="-1" id="delete-loss-modal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="icon ion-android-delete"></i>&nbsp;Delete Loss</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <input id="deleteLossID" type="hidden">
                            <input id="deleteLossInvProdID" type="hidden">
                            <p>Are you sure you want to delete this loss?</p>
                            <div class="float-right">
                                <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">Close
                                </button>
                                <button id="delete-loss-btn" class="btn btn-primary btn-sm custom-btn" type="button">
                                    Delete
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
    <script>
        $(document).ready(function () {
            let editDiscountContainer = $('#edit-discounts-container');
            let discountTypes = $('#edit-discounts-container input[name="discountType"]');
            let loading = $('#loading');
            $('#edit-discount-checkbox').change(function () {
                if ($(this).is(':checked')) {
                    loadDiscountRates($(this).is(':checked'));
                } else {
                    editDiscountContainer.hide('slow');
                    loading.hide('slow');
                    editDiscountContainer.find('.form-row.discount').each(function (i, item) {
                        $(this).html('');
                    });
                }
            });

            //limit discount amount
            discountTypes.change(function () {
                let discountRates = $('#edit-discounts-container input[name="discountAmount[]"]');
                if ($(this).is(':checked') && $(this).attr('id') === "edit-amount") {
                    discountRates.each(function (i, item) {
                        $(this).attr('max', '');
                    });
                } else {
                    discountRates.each(function (i, item) {
                        $(this).attr('max', 100);
                    });
                }
            });

            //add discounts
            $('#add-discount-btn').click(function () {
                editDiscountContainer.append(discountItem());
            });

            function discountItem(qty = '', amount = '') {
                let max = "";
                discountTypes.each(function () {
                    if ($(this).is(':checked') && $(this).attr('id') === "percent") {
                        max = 'max="100"';
                    }
                });
                return '<div class="form-row discount mb-2">\n' +
                    '       <div class="col-4">\n' +
                    '           <input class="form-control form-control-sm" type="number" name="discountQuantity[]"\n' +
                    '           placeholder="quantity >" min="0" step="0.25" value="' + qty + '" required>\n' +
                    '           </div>\n' +
                    '           <div class="col-6">\n' +
                    '              <input class="form-control form-control-sm" type="number" name="discountAmount[]"\n' +
                    '                 placeholder="discount amount" value="' + amount + '" min="1" step="0.01" ' + max + ' required>\n' +
                    '           </div>\n' +
                    '           <div class="col">\n' +
                    '               <span class="close" style="cursor: pointer;color: red;" title="delete">\n' +
                    '               <i class="icon ion-close-round"></i>\n' +
                    '               </span>\n' +
                    '           </div>\n' +
                    '  </div>';
            }

            //delete discount
            $(document).on('click', '#edit-discounts-container .form-row .close', function () {
                $(this).parents('.form-row').html('');
            });

            //check profit
            $('#newSellingPrice').keyup(stockProfit).change(stockProfit);

            function stockProfit() {
                let price = $(this).val();
                let qty = $('#newQuantity').val();
                let cost = $('#newCost').val();
                let profit = (price - (cost / qty)).toFixed(2);
                if (isNaN(qty) || isNaN(cost)) return;
                if (profit >= 0) {
                    $('#profitLabel').text(profit + '/=').removeClass('text-danger').addClass('value');
                } else {
                    $('#profitLabel').text(profit + '/=').removeClass('value').addClass('text-danger');
                }
            }

            //check new Stock profit
            $('#newStockSellingPrice').keyup(newStockProfit).change(newStockProfit);

            function newStockProfit() {
                let price = $(this).val();
                let qty = parseFloat($('#newStockQuantity').val()) + parseFloat($('#totalStockQuantity').val());
                let cost = parseFloat($('#newStockCost').val()) + parseFloat($('#totalStockCost').val());
                let profit = (price - (cost / qty)).toFixed(2);

                console.log('qty: ' + qty)
                console.log('cost: ' + cost)
                console.log('profit: ' + profit)
                if (isNaN(qty) || isNaN(cost)) return;
                if (profit >= 0) {
                    $('#newStockProfitLabel').text(profit + '/=').removeClass('text-danger').addClass('value');
                } else {
                    $('#newStockProfitLabel').text(profit + '/=').removeClass('value').addClass('text-danger');
                }
            }

            //Add to Stock
            $('#add-to-stock-modal').on('show.bs.modal', function (e) {
                let id = $(e.relatedTarget).data('id');
                let name = $(e.relatedTarget).data('name');
                let remainQty = $(e.relatedTarget).data('remainingqty');
                let cost = $(e.relatedTarget).data('cost');
                let quantity = $(e.relatedTarget).data('quantity');
                let sellingPrice = $(e.relatedTarget).data('sellingprice');
                let form = $(this).find('form');
                let action = '{{route('inventory.add.stock','')}}/' + id;
                form.attr('action', action);
                $('#totalStockCost').val(cost);
                $('#totalStockQuantity').val(quantity);
                $('#productStockNameLabel').text(name);
                $('#remainingStockQtyLabel').text(remainQty);
                $('#newStockSellingPrice').val(sellingPrice);
            });

            //edit inventory
            $('#edit-inventory-modal').on('show.bs.modal', function (e) {
                let id = $(e.relatedTarget).data('id');
                let name = $(e.relatedTarget).data('name');
                let quantity = $(e.relatedTarget).data('quantity');
                let remainQty = $(e.relatedTarget).data('remainingqty');
                let cost = $(e.relatedTarget).data('cost');
                let sellingPrice = $(e.relatedTarget).data('sellingprice');
                let hasDiscount = $(e.relatedTarget).data('hasdiscount') === 1;
                let discountType = $(e.relatedTarget).data('discounttype');
                let form = $(this).find('form');
                let action = '{{route('inventory.update','')}}/' + id;
                form.attr('action', action);
                $('#productNameLabel').text(name);
                $('#quantityLabel').text(quantity);
                $('#newQuantity').val(quantity);
                $('#remainingQtyLabel').text(remainQty);
                $('#costLabel').text(cost);
                $('#newCost').val(cost);
                $('#sellingPriceLabel').text(sellingPrice);
                $('#newSellingPrice').val(sellingPrice);
                if (discountType != 2) {
                    $('#edit-amount').prop('checked', true);
                } else {
                    $('#edit-percent').prop('checked', true);
                }
                if (hasDiscount) {
                    $('#edit-discount-checkbox').attr('checked', true);
                    loadDiscountRates(id, true);
                } else {
                    $('#edit-discount-checkbox').attr('checked', false);
                    editDiscountContainer.hide();
                }
            });

            function loadDiscountRates(id, hasDiscounts = false) {
                //clear previous discounts
                $('#edit-discounts-container .form-row.discount').each(function (item, index) {
                    $(this).html('');
                });
                if (!hasDiscounts) {
                    editDiscountContainer.show();
                    return;
                } else {
                    loading.show();
                    $.ajax({
                        type: 'GET',
                        url: '{{route('inventory.get.discounts','')}}/' + id,
                        success: function (data) {
                            for (let i = 0; i < data.discounts.length; i++) {
                                editDiscountContainer.append(discountItem(data.discounts[i].qty, data.discounts[i].amount));
                            }
                            loading.hide();
                            editDiscountContainer.show('slow');
                        }
                    });
                }
            }

            //close edit modal
            $('#edit-inventory-modal').on('hidden.bs.modal', function (e) {
                loading.hide();
            });

            //show loss modal
            let lossQuantity = $('#lossQuantity');
            $('#product-loss-modal').on('show.bs.modal', function (e) {
                let id = $(e.relatedTarget).data('id');
                let name = $(e.relatedTarget).data('name');
                let buyingPrice = $(e.relatedTarget).data('buyingprice');
                let sellingPrice = $(e.relatedTarget).data('sellingprice');
                let remaining = $(e.relatedTarget).data('remainingqty');
                let hasSize = $(e.relatedTarget).data('hassize')===1;
                $('#invProductId').val(id);
                $('#productNameLabelLoss').text(name);
                $('#buyingPriceLabelLoss').text(buyingPrice);
                $('#sellingPriceLabelLoss').text(sellingPrice);
                $('#remainingQtyLabelLoss').text(remaining);
                $('#lossQuantity').attr('max', remaining);
                if(hasSize){
                    lossQuantity.attr('step','0.25');
                }else{
                    lossQuantity.attr('step','1');
                }
                loadLosses(id);
            });

            //load losses AJAX
            let loadingLoss = $('#loadingLoss');
            let lossTable = $('#loss-table');
            let token = $('meta[name="csrf-token"]').attr('content');

            function loadLosses(id) {
                lossTable.hide();
                loadingLoss.show();
                $.ajax({
                    type: 'GET',
                    url: '{{route('loss.get','')}}/' + id,
                    success: function (data) {
                        let lossTableBody = lossTable.find('tbody');
                        lossTableBody.html('');
                        for (let i = 0; i < data.length; i++) {
                            // console.log(data[i]);
                            lossTableBody.append(lossRow(i + 1, data[i]));
                        }
                        loadingLoss.hide();
                        lossTable.show();
                    }
                });
            }

            //loss table row
            function lossRow(index, loss) {
                return '<tr title="' + loss.description + '">\n' +
                    '    <td>' + index + '</td>\n' +
                    '    <td>' + loss.qty + '</td>\n' +
                    '    <td>' + loss.amount + '</td>\n' +
                    '    <td>' + loss.date + '</td>\n' +
                    '    <td>\n' +
                    '        <div class="options">\n' +
                    '            <a href="#" class="option-link edit" data-toggle="modal"\n' +
                    '               data-target="#edit-loss-modal" data-id="' + loss.id + '" data-remaining="' + loss.remaining + '" data-qty="' + loss.qty + '"' +
                    '               data-amount="' + loss.amount + '" data-hassize="' + loss.hasSize + '" data-description="' + loss.description + '" data-invprodid="' + loss.invProdId + '">\n' +
                    '                <i class="icon ion-edit"></i>&nbsp;\n' +
                    '                <span class="link-text">edit</span>\n' +
                    '            </a>\n' +
                    '            <a href="#" class="option-link delete" data-toggle="modal"\n' +
                    '               data-target="#delete-loss-modal" data-id="' + loss.id + '" data-invprodid="' + loss.invProdId + '">\n' +
                    '                <i class="icon ion-android-delete"></i>&nbsp;\n' +
                    '                <span class="link-text">delete</span>\n' +
                    '            </a>\n' +
                    '        </div>\n' +
                    '    </td>\n' +
                    '</tr>';
            }

            //calculate loss amount
            lossQuantity.keyup(calculateLossAmount).change(calculateLossAmount);

            function calculateLossAmount() {
                let buyingPrice = $('#buyingPriceLabelLoss').text();
                let qty = $('#lossQuantity').val();
                let lossAmount = (qty * buyingPrice).toFixed(2);
                if (isNaN(lossAmount)) {
                    $('#lossAmount').val('');
                } else {
                    $('#lossAmount').val(lossAmount);
                }
            }

            //add loss
            $('#add-loss-btn').click(function () {
                let id = $('#invProductId').val();
                let qty = $('#lossQuantity').val();
                let amount = $('#lossAmount').val();
                let desc = $('#lossDescription').val();
                if (qty.length === 0 || qty <= 0) {
                    $('#lossQuantity').focus();
                    return;
                }
                if (amount.length === 0) {
                    $('#lossAmount').focus();
                    return;
                }
                $.ajax({
                    type: 'POST',
                    url: '{{route('loss.add','')}}/' + id,
                    data: {
                        _token: token,
                        quantity: qty,
                        amount: amount,
                        description: desc,
                    },
                    success: function (data) {
                        if (data == 'success') {
                            window.location.reload();
                        }
                    }
                });
            });

            //hide loss modal
            $('#product-loss-modal').on('hidden.bs.modal', function (e) {
                addLossContainer.hide();
                clearInputs();
            });

            function clearInputs() {
                $('#lossQuantity').val('');
                $('#lossAmount').val('');
                $('#lossDescription').val('');
                $('#editLossId').val('');
                $('#editLossQuantity').val('');
                $('#editLossAmount').val('');
                $('#editLossDescription').val('');
            }

            //show add loss container
            let addLossContainer = $('#add-loss-container');
            $('#show-add-loss-btn').click(function () {
                addLossContainer.show('slow');
            });
            addLossContainer.find('span.close').click(function () {
                addLossContainer.hide('slow');
            });

            //edit loss
            let editLossQty = $('#editLossQuantity');
            $('#edit-loss-modal').on('show.bs.modal', function (e) {
                let id = $(e.relatedTarget).data('id');
                let invProdId = $(e.relatedTarget).data('invprodid');
                let qty = $(e.relatedTarget).data('qty');
                let remaining = $(e.relatedTarget).data('remaining');
                let hasSize = $(e.relatedTarget).data('hassize');
                let amount = $(e.relatedTarget).data('amount');
                let desc = $(e.relatedTarget).data('description');
                $('#editLossId').val(id);
                $('#lossInvProductId').val(invProdId);
                editLossQty.val(qty);
                editLossQty.attr('max',remaining);
                if(hasSize){
                    editLossQty.attr('step','0.25')
                    editLossQty.attr('min','0.25')
                }else{
                    editLossQty.attr('step','1')
                    editLossQty.attr('min','1')
                }
                $('#editLossAmount').val(amount);
                $('#editLossDescription').val(desc);
            });

            //update loss
            $('#update-loss-btn').click(function () {
                let id = $('#editLossId').val();
                let invProdId = $('#lossInvProductId').val();
                let qty = editLossQty.val();
                let amount = $('#editLossAmount').val();
                let desc = $('#editLossDescription').val();
                if (qty.length === 0) {
                    $('#editLossQuantity').focus();
                    return;
                }
                if (amount.length === 0) {
                    $('#editLossAmount').focus();
                    return;
                }
                $.ajax({
                    type: 'POST',
                    url: '{{route('loss.update','')}}/' + id,
                    data: {
                        _token: token,
                        quantity: qty,
                        amount: amount,
                        description: desc,
                    },
                    success: function (data) {
                        if (data == 'success') {
                            loadLosses(invProdId);
                            $('#edit-loss-modal').modal('hide');
                            clearInputs();
                        }
                    }
                });

            });

            //delete loss
            $('#delete-loss-modal').on('show.bs.modal', function (e) {
                $('#deleteLossID').val($(e.relatedTarget).data('id'));
                $('#deleteLossInvProdID').val($(e.relatedTarget).data('invprodid'));
            });

            $('#delete-loss-btn').click(function () {
                let id = $('#deleteLossID').val();
                let invProdId = $('#deleteLossInvProdID').val();
                $.ajax({
                    type: 'POST',
                    url: '{{route('loss.delete','')}}/' + id,
                    data: {
                        _token: token,
                        id: id,
                    },
                    success: function (data) {
                        if (data == 'success') {
                            loadLosses(invProdId);
                            $('#delete-loss-modal').modal('hide');
                        } else {
                            alert('Oops...Something went Wrong!');
                        }
                    }
                });
            });

        });
    </script>
@stop
