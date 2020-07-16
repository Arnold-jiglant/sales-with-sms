@extends('layout.app')
@section('title')
    Users
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
        <div class="col-md-11 col-lg-10 col-xl-8 offset-lg-1 offset-xl-1">
            <div id="inventoryInfo" class="p-3" style="font-size: 11pt;">
                <div class="row">
                    <div class="col-sm-6">
                        <p><span>Total Cost:&nbsp;</span><span class="ml-1 value">Text</span></p>
                        <p><span>Expected Amount:&nbsp;</span><span class="ml-1 value">Text</span></p>
                        <p><span>Issuer:&nbsp;</span><span class="ml-1 value">Text</span></p>
                        <p><span>Issue Date:&nbsp;</span><span class="ml-1 value">Text</span></p>
                    </div>
                    <div class="col"><span>Description:&nbsp;</span>
                        <p class="value font-weight-normal">Inventory Description asfkjasj askjhalskj</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-8 col-xl-6 offset-md-2">
                <form id="search-form">
                    <div class="form-group">
                        <div class="input-group input-group-sm"><input class="form-control" type="text" placeholder="search product">
                            <div class="input-group-append"><button class="btn btn-primary custom-btn" type="button">Search</button></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col offset-lg-0 offset-xl-0">
        <p>Total 200 showing 20-30</p>
        <div class="table-responsive table-bordered text-center" id="inventory-products-table">
            <table class="table table-bordered table-hover table-sm">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Remain</th>
                    <th>Cost</th>
                    <th>Buying Price@</th>
                    <th>Selling Price@</th>
                    <th>Time</th>
                    <th>Loss Qty</th>
                    <th>Loss Amount</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>Product 1</td>
                    <td>34</td>
                    <td>13</td>
                    <td>68,000</td>
                    <td>2,000</td>
                    <td>3,500</td>
                    <td>25/03/2020</td>
                    <td>2</td>
                    <td class="text-danger">5,000</td>
                    <td>
                        <div class="options"><a href="#" class="option-link edit" data-toggle="modal" data-target="#add-inventory-modal"><i class="icon ion-plus"></i>&nbsp;<span class="link-text">add</span></a><a href="#" class="option-link edit" data-toggle="modal"
                                                                                                                                                                                                                     data-target="#edit-inventory-modal"><i class="icon ion-edit"></i>&nbsp;<span class="link-text">edit</span></a><a href="#" class="option-link edit" data-toggle="modal" data-target="#product-loss-modal"><i class="icon ion-arrow-graph-down-right"></i>&nbsp;<span class="link-text">Loss</span></a>
                            <a
                                href="#" class="option-link edit" data-toggle="modal" data-target="#delete-inventory-modal"><i class="icon ion-android-delete"></i>&nbsp;<span class="link-text">Delete</span></a>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-10 col-lg-7 offset-md-1 offset-lg-3">
            <nav>
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                    <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                </ul>
            </nav>
        </div>
    </div>
@stop
@section('modal')
    <div class="modal fade" role="dialog" tabindex="-1" id="add-inventory-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="icon ion-plus"></i>Add Inventory</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form>
                        <p><span>Product Name:</span><span class="ml-1 value">Text</span></p>
                        <p><span>Available Quantity:</span><span class="ml-1 value">Text</span></p>
                        <div class="form-group" data-toggle="popover" data-content="whole quantity eg. 200 pieces"
                             data-trigger="focus" data-placement="right"><label>New Quantity</label><input
                                class="form-control form-control-sm" type="number" placeholder="Inventory Quantity"
                                min="1" id="quantity"></div>
                        <div class="form-group" data-toggle="popover"
                             data-content="cost of the whole package eg. 200 pc -> 200,000/="
                             data-trigger="focus" data-placement="right"><label>Cost</label><input
                                class="form-control form-control-sm" type="number" placeholder="inventory quantity cost"
                                min="0" id="cost"></div>
                        <div class="form-group" data-toggle="popover"
                             data-content="Selling Price for single item eg. 12,000/= NB. This price will affect previous selling price"
                             data-trigger="focus" data-placement="right"><label>Selling Price</label><input
                                class="form-control form-control-sm" type="number" placeholder="Selling Price" min="0"
                                id="sellingPrice"></div>
                        <div class="float-right">
                            <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary btn-sm custom-btn" type="button">Add</button>
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
                    <form>
                        <p><span>Product Name:</span><span class="ml-1 value">Text</span></p>
                        <p><span>Available Quantity:</span><span class="ml-1 value">Text</span></p>
                        <p><span>Entered Quantity:</span><span class="ml-1 value">Text</span></p>
                        <div class="form-group" data-toggle="popover" data-content="whole quantity eg. 200 pieces"
                             data-trigger="focus" data-placement="right"><label>New Quantity</label><input
                                class="form-control form-control-sm" type="number" placeholder="Inventory Quantity"
                                min="1" id="editQuantity"></div>
                        <p class="mt-2"><span>Entered Cost:</span><span class="ml-1 value">Text</span></p>
                        <div class="form-group" data-toggle="popover"
                             data-content="cost of the whole package eg. 200 pc -> 200,000/=" data-trigger="focus"
                             data-placement="right"><label>New Cost</label><input class="form-control form-control-sm"
                                                                                  type="number"
                                                                                  placeholder="inventory quantity cost"
                                                                                  min="0" id="editCost"></div>
                        <p class="mt-2"><span>Entered Selling Price:</span><span class="ml-1 value">Text</span></p>
                        <div class="form-group" data-toggle="popover"
                             data-content="Selling Price for single item eg. 12,000/ NB. This price will affect current selling price"
                             data-trigger="focus" data-placement="right"><label>New Selling Price</label><input
                                class="form-control form-control-sm" type="number" placeholder="Selling Price" min="0"
                                id="editSellingPrice"></div>
                        <div class="form-group" data-toggle="popover"
                             data-content="product discount depending on quantity. eg. if qty >5 discount 1000, for 6,000/= shoes will be sold for 5,000/="
                             data-trigger="hover" data-placement="right">
                            <div class="custom-control custom-control-inline custom-checkbox"><input
                                    class="custom-control-input" type="checkbox" checked=""
                                    id="discount-checkbox"><label class="custom-control-label" for="discount-checkbox">Discount
                                    rates?</label></div>
                        </div>
                        <div id="discounts-container">
                            <div class="form-row mb-1">
                                <div class="col"><span class="mr-2">Type:</span>
                                    <div class="custom-control custom-control-inline custom-radio"><input
                                            class="custom-control-input" type="radio" name="discountType" checked=""
                                            id="formCheck-1"><label class="custom-control-label" for="formCheck-1">Amount($)</label>
                                    </div>
                                    <div class="custom-control custom-control-inline custom-radio"><input
                                            class="custom-control-input" type="radio" name="discountType"
                                            id="formCheck-1"><label class="custom-control-label" for="formCheck-1">Percent
                                            (%)</label></div>
                                </div>
                            </div>
                            <div class="form-row mb-1">
                                <div class="col">
                                    <button class="btn btn-primary btn-sm custom-btn float-right" type="button"><i
                                            class="icon ion-plus"></i>Add
                                    </button>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-4"><input class="form-control form-control-sm" type="number"
                                                          name="quantity[]" placeholder="quantity >" min="0"></div>
                                <div class="col-6"><input class="form-control form-control-sm" type="number"
                                                          name="discount[]" placeholder="discount amount" min="1"></div>
                                <div class="col"><span class="close" style="cursor: pointer;color: red;" title="delete"><i
                                            class="icon ion-close-round"></i></span></div>
                            </div>
                        </div>
                        <div class="loading"><span class="spinner-border" role="status"
                                                   style="width: 60px;height: 60px;color: #00bacc;"></span><span
                                class="mt-2">Loading..</span></div>
                        <div class="float-right">
                            <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary btn-sm custom-btn" type="button">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="product-loss-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon ion-arrow-graph-down-right"></i>&nbsp;Product Loss</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-row mb-2">
                            <div class="col-sm-6">
                                <p><span>Product Name:</span><span class="ml-1 value">Text</span></p>
                                <p><span>Available Quantity:</span><span class="ml-1 value">Text</span></p>
                            </div>
                            <div class="col-sm-6">
                                <p><span>Buying Price:</span><span class="ml-1 value">Text</span></p>
                                <p><span>SellingPrice:</span><span class="ml-1 value">Text</span></p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-6">
                                <h6 class="mb-0 mt-3">Last Losses</h6>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-primary btn-sm custom-btn float-right" type="button"><i
                                        class="icon ion-android-add"></i>Add
                                </button>
                            </div>
                        </div>
                        <div id="add-loss-container" class="mt-1 p-2 mb-2"
                             style="border: 1px dashed #1c1c1c;border-radius: 10px;">
                            <div class="form-row">
                                <div class="col-4"><input class="form-control form-control-sm" type="number"
                                                          name="quantity" placeholder="quantity" min="0"
                                                          id="lossQuantity"></div>
                                <div class="col-6"><input class="form-control form-control-sm" type="number"
                                                          placeholder="Total loss amount" min="1" id="lossAmount"></div>
                                <div class="col"><span class="float-right close" style="cursor: pointer;" title="Close"><i
                                            class="icon ion-close-round"></i></span></div>
                            </div>
                            <div class="form-row">
                                <div class="col mt-1">
                                    <button class="btn btn-primary btn-sm custom-btn float-right mr-2" type="button">
                                        Confirm
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive table-bordered">
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
                                        <div class="options"><a href="#" class="option-link edit" data-toggle="modal"
                                                                data-target="#edit-loss-modal"><i
                                                    class="icon ion-edit"></i>&nbsp;<span class="link-text">edit</span></a><a
                                                href="#" class="option-link delete" data-toggle="modal"
                                                data-target="#delete-loss-modal"><i class="icon ion-android-delete"></i>&nbsp;<span
                                                    class="link-text">delete</span></a></div>
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
                        <div class="loading"><span class="spinner-border" role="status"
                                                   style="width: 60px;height: 60px;color: #00bacc;"></span><span
                                class="mt-2">Loading..</span></div>
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
                        <p>Are sure you want to delete this inventory?</p>
                        <div class="float-right">
                            <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary btn-sm custom-btn" type="button">Delete</button>
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
                        <div class="form-group"><label>Loss Quantity</label><input class="form-control form-control-sm"
                                                                                   type="number" name="quantity"
                                                                                   placeholder="quantity" min="0"
                                                                                   id="editLossQuantity"></div>
                        <div class="form-group"><label>Loss Amount</label><input class="form-control form-control-sm"
                                                                                 type="number"
                                                                                 placeholder="Total loss amount" min="1"
                                                                                 id="editLossAmount"></div>
                        <div class="float-right">
                            <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary btn-sm custom-btn" type="button">Update</button>
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
                        <p>Are sure you want to delete this loss?</p>
                        <div class="float-right">
                            <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary btn-sm custom-btn" type="button">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
