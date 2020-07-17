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
                    <li class="breadcrumb-item"><a><span>New Inventory</span></a></li>
                </ol>
            </div>
        </div>
        <h3 class="mt-3">New Inventory</h3>
        <div class="col-md-11 col-lg-10 col-xl-8 offset-lg-1 offset-xl-1 mb-2">
            <div id="inventoryInfo" class="p-3" style="font-size: 11pt;">
                <div class="row">
                    <div class="col-sm-6">
                        <p><span>Total Cost:&nbsp;</span><span class="ml-1 value">3,750,000</span></p>
                        <p><span>Expected Amount:&nbsp;</span><span class="ml-1 value">4,000,000</span></p>
                    </div>
                    <div class="col">
                        <form>
                            <div class="form-group"><label for="description">Description(optional):</label><textarea class="form-control form-control-sm" rows="3" id="description"></textarea></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col"><button class="btn btn-primary btn-sm custom-btn float-right mb-2" type="button" data-toggle="modal" data-target="#add-product-modal"><i class="icon ion-android-add"></i>Add Product</button></div>
        <div class="table-responsive table-bordered text-center"
             id="products-table">
            <table class="table table-bordered table-hover table-sm">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Prodcut Name</th>
                    <th>Quantity</th>
                    <th>Cost</th>
                    <th>Selling Price</th>
                    <th>Discount Type</th>
                    <th>Discounts</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>Product 1</td>
                    <td>20</td>
                    <td>3,000,000</td>
                    <td>170,000</td>
                    <td>Percent(%)</td>
                    <td>
                        <p class="m-0"><span class="mr-1">&gt;= 10 :</span><span>3%</span></p>
                        <p class="m-0"><span class="mr-1">&gt;= 20 :</span><span>5%</span></p>
                        <p class="m-0"><span class="mr-1">&gt;= 30 :</span><span>7%</span></p>
                    </td>
                    <td><span class="close" style="cursor: pointer;color: red;" title="delete"><i class="icon ion-close-round"></i></span></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Product 2</td>
                    <td>25</td>
                    <td>750,000</td>
                    <td>35,000</td>
                    <td>Amount($)</td>
                    <td>
                        <p class="m-0"><span class="mr-1">&gt;= 10 :</span><span>1,500</span></p>
                        <p class="m-0"><span class="mr-1">&gt;= 20 :</span><span>2,000</span></p>
                        <p class="m-0"><span class="mr-1">&gt;= 30 :</span><span>3,000</span></p>
                    </td>
                    <td><span class="close" style="cursor: pointer;color: red;" title="delete"><i class="icon ion-close-round"></i></span></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Product 2</td>
                    <td>25</td>
                    <td>750,000</td>
                    <td>35,000</td>
                    <td>Amount($)</td>
                    <td>
                        <p class="m-0"><span class="mr-1">&gt;= 10 :</span><span>1,500</span></p>
                        <p class="m-0"><span class="mr-1">&gt;= 20 :</span><span>2,000</span></p>
                        <p class="m-0"><span class="mr-1">&gt;= 30 :</span><span>3,000</span></p>
                    </td>
                    <td><span class="close" style="cursor: pointer;color: red;" title="delete"><i class="icon ion-close-round"></i></span></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Product 2</td>
                    <td>25</td>
                    <td>750,000</td>
                    <td>35,000</td>
                    <td>Amount($)</td>
                    <td>
                        <p class="m-0"><span class="mr-1">&gt;= 10 :</span><span>1,500</span></p>
                        <p class="m-0"><span class="mr-1">&gt;= 20 :</span><span>2,000</span></p>
                        <p class="m-0"><span class="mr-1">&gt;= 30 :</span><span>3,000</span></p>
                    </td>
                    <td><span class="close" style="cursor: pointer;color: red;" title="delete"><i class="icon ion-close-round"></i></span></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Product 2</td>
                    <td>25</td>
                    <td>750,000</td>
                    <td>35,000</td>
                    <td>Amount($)</td>
                    <td>
                        <p class="m-0"><span class="mr-1">&gt;= 10 :</span><span>1,500</span></p>
                        <p class="m-0"><span class="mr-1">&gt;= 20 :</span><span>2,000</span></p>
                        <p class="m-0"><span class="mr-1">&gt;= 30 :</span><span>3,000</span></p>
                    </td>
                    <td><span class="close" style="cursor: pointer;color: red;" title="delete"><i class="icon ion-close-round"></i></span></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Product 2</td>
                    <td>25</td>
                    <td>750,000</td>
                    <td>35,000</td>
                    <td>Amount($)</td>
                    <td>
                        <p class="m-0"><span class="mr-1">&gt;= 10 :</span><span>1,500</span></p>
                        <p class="m-0"><span class="mr-1">&gt;= 20 :</span><span>2,000</span></p>
                        <p class="m-0"><span class="mr-1">&gt;= 30 :</span><span>3,000</span></p>
                    </td>
                    <td><span class="close" style="cursor: pointer;color: red;" title="delete"><i class="icon ion-close-round"></i></span></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Product 2</td>
                    <td>25</td>
                    <td>750,000</td>
                    <td>35,000</td>
                    <td>Amount($)</td>
                    <td>
                        <p class="m-0"><span class="mr-1">&gt;= 10 :</span><span>1,500</span></p>
                        <p class="m-0"><span class="mr-1">&gt;= 20 :</span><span>2,000</span></p>
                        <p class="m-0"><span class="mr-1">&gt;= 30 :</span><span>3,000</span></p>
                    </td>
                    <td><span class="close" style="cursor: pointer;color: red;" title="delete"><i class="icon ion-close-round"></i></span></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col text-center"><button class="btn btn-primary custom-btn m-3" type="button">Confirm New Inventory</button></div>
    </div>
@stop
@section('modal')
    <div class="modal fade" role="dialog" tabindex="-1" id="add-product-modal" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon ion-plus"></i>&nbsp;Add Product</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                <div class="modal-body">
                    <form id="add-product-form" class="pt-3 pb-3 mb-3">
                        <div class="form-group"><label>Product Name</label>
                            <div class="form-row">
                                <div class="col-10 col-sm-9"><select class="custom-select custom-select-sm" name="product_id"><option value="12" selected="">This is item 1</option><option value="13">This is item 2</option><option value="14">This is item 3</option><option value="">jig</option><option value="">dfd</option><option value="">ewtwe</option></select></div>
                                <div
                                    class="col-2 col-sm-3"><button class="btn btn-primary btn-sm custom-btn" type="button" data-toggle="modal" data-target="#search-product-modal"><span class="mr-1">Search</span><i class="icon ion-search"></i></button></div>
                            </div>
                        </div>
                        <div class="form-group" data-toggle="popover" data-content="whole quantity eg. 200 pieces" data-trigger="focus" data-placement="right"><label>Quantity</label><input class="form-control form-control-sm" type="number" placeholder="Inventory Quantity" min="1"></div>
                        <div class="form-group" data-toggle="popover" data-content="cost of the whole package eg. 200 pc -> 200,000/="
                             data-trigger="focus" data-placement="right"><label>Cost</label><input class="form-control form-control-sm" type="number" placeholder="inventory quantity cost" min="0"></div>
                        <div class="form-group" data-toggle="popover" data-content="Selling Price for single item eg. 12,000/="
                             data-trigger="focus" data-placement="right"><label>Selling Price</label><input class="form-control form-control-sm" type="number" placeholder="Selling Price" min="0"></div>
                        <div class="form-group" data-toggle="popover" data-content="if product has small sizes eg. 1/4(0.25), 1/2(0.5) and 3/4(0.75)"
                             data-trigger="hover" data-placement="right">
                            <div class="custom-control custom-control-inline custom-checkbox"><input class="custom-control-input" type="checkbox" name="hasSize" id="hasSize"><label class="custom-control-label" for="hasSize">Has Small Sizes?</label></div>
                        </div>
                        <div class="form-group" data-toggle="popover" data-content="product discount depending on quantity. eg. if qty >5 discount 1000, for 6,000/= shoes will be sold for 5,000/= OR if qty >5 discount 10%, for 6,000/= shoes will be sold for 5,400/="
                             data-trigger="hover" data-placement="right">
                            <div class="custom-control custom-control-inline custom-checkbox"><input class="custom-control-input" type="checkbox" checked="" id="discount-checkbox"><label class="custom-control-label" for="discount-checkbox">Discount rates?</label></div>
                        </div>
                        <div id="discounts-container">
                            <div class="form-row mb-1">
                                <div class="col"><span class="mr-2">Type:</span>
                                    <div class="custom-control custom-control-inline custom-radio"><input class="custom-control-input" type="radio" name="discountType" checked="" id="amountType"><label class="custom-control-label" for="amountType">Amount($)</label></div>
                                    <div class="custom-control custom-control-inline custom-radio"><input class="custom-control-input" type="radio" name="discountType" id="percentType"><label class="custom-control-label" for="percentType">Percent (%)</label></div>
                                </div>
                            </div>
                            <div class="form-row mb-1">
                                <div class="col"><button class="btn btn-primary btn-sm custom-btn float-right" type="button"><i class="icon ion-plus"></i>Add</button></div>
                            </div>
                            <div class="form-row">
                                <div class="col-4"><input class="form-control form-control-sm" type="number" name="quantity[]" placeholder="quantity >" min="0"></div>
                                <div class="col-6"><input class="form-control form-control-sm" type="number" name="discount[]" placeholder="discount amount" min="1"></div>
                                <div class="col"><span class="close" style="cursor: pointer;color: red;" title="delete"><i class="icon ion-close-round"></i></span></div>
                            </div>
                        </div>
                        <div class="float-right m-4"><button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">Close</button><button class="btn btn-primary btn-sm custom-btn" type="button">Confirm</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="search-product-modal">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon ion-search"></i>&nbsp;Search Product</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                <div class="modal-body">
                    <form id="add-product-form" class="pt-3 pb-3 mb-3">
                        <div class="form-group"><input class="form-control" type="text" placeholder="search product"></div>
                        <div class="loading"><span class="spinner-border" role="status" style="width: 50px;height: 50px;color: #00bacc;"></span><span class="mt-2">Loading..</span></div>
                        <div style="height: 70vh;overflow-y: auto;">
                            <div class="table-responsive table-bordered text-center" id="products-table">
                                <table class="table table-bordered table-hover table-sm">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr style="cursor: pointer;">
                                        <td>1</td>
                                        <td>Product 1</td>
                                    </tr>
                                    <tr style="cursor: pointer;">
                                        <td>1</td>
                                        <td>Product 1</td>
                                    </tr>
                                    <tr style="cursor: pointer;">
                                        <td>1</td>
                                        <td>Product 1</td>
                                    </tr>
                                    <tr style="cursor: pointer;">
                                        <td>1</td>
                                        <td>Product 1</td>
                                    </tr>
                                    <tr style="cursor: pointer;">
                                        <td>1</td>
                                        <td>Product 1</td>
                                    </tr>
                                    <tr style="cursor: pointer;">
                                        <td>1</td>
                                        <td>Product 1</td>
                                    </tr>
                                    <tr style="cursor: pointer;">
                                        <td>1</td>
                                        <td>Product 1</td>
                                    </tr>
                                    <tr style="cursor: pointer;">
                                        <td>1</td>
                                        <td>Product 1</td>
                                    </tr>
                                    <tr style="cursor: pointer;">
                                        <td>1</td>
                                        <td>Product 1</td>
                                    </tr>
                                    <tr style="cursor: pointer;">
                                        <td>1</td>
                                        <td>Product 1</td>
                                    </tr>
                                    <tr style="cursor: pointer;">
                                        <td>1</td>
                                        <td>Product 1</td>
                                    </tr>
                                    <tr style="cursor: pointer;">
                                        <td>1</td>
                                        <td>Product 1</td>
                                    </tr>
                                    <tr style="cursor: pointer;">
                                        <td>1</td>
                                        <td>Product 1</td>
                                    </tr>
                                    <tr style="cursor: pointer;">
                                        <td>1</td>
                                        <td>Product 1</td>
                                    </tr>
                                    <tr style="cursor: pointer;">
                                        <td>1</td>
                                        <td>Product 1</td>
                                    </tr>
                                    <tr style="cursor: pointer;">
                                        <td>1</td>
                                        <td>Product 1</td>
                                    </tr>
                                    <tr style="cursor: pointer;">
                                        <td>1</td>
                                        <td>Product 1</td>
                                    </tr>
                                    <tr style="cursor: pointer;">
                                        <td>1</td>
                                        <td>Product 1</td>
                                    </tr>
                                    <tr style="cursor: pointer;">
                                        <td>1</td>
                                        <td>Product 1</td>
                                    </tr>
                                    <tr style="cursor: pointer;">
                                        <td>1</td>
                                        <td>Product 1</td>
                                    </tr>
                                    <tr style="cursor: pointer;">
                                        <td>1</td>
                                        <td>Product 1</td>
                                    </tr>
                                    <tr style="cursor: pointer;">
                                        <td>1</td>
                                        <td>Product 1</td>
                                    </tr>
                                    <tr style="cursor: pointer;">
                                        <td>1</td>
                                        <td>Product 1</td>
                                    </tr>
                                    <tr style="cursor: pointer;">
                                        <td>1</td>
                                        <td>Product 1</td>
                                    </tr>
                                    <tr style="cursor: pointer;">
                                        <td>1</td>
                                        <td>Product 1</td>
                                    </tr>
                                    <tr style="cursor: pointer;">
                                        <td>1</td>
                                        <td>Product 1</td>
                                    </tr>
                                    <tr style="cursor: pointer;">
                                        <td>1</td>
                                        <td>Product 1</td>
                                    </tr>
                                    <tr style="cursor: pointer;">
                                        <td>1</td>
                                        <td>Product 1</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
