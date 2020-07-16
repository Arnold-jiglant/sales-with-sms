@extends('layout.app')
@section('title')

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
        <div class="row mt-1">
            <div class="col-md-11 col-lg-5">
                <form id="search-form">
                    <div class="form-group">
                        <div class="input-group"><input class="form-control" type="text" placeholder="search product">
                            <div class="input-group-append"><button class="btn btn-primary custom-btn" type="button">Search</button></div>
                        </div>
                    </div>
                </form>
                <p>Total 200 showing 20-30</p>
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
                        <tr>
                            <td>1</td>
                            <td>Product 1</td>
                            <td>120</td>
                            <td>5,000</td>
                            <td>
                                <div class="options"><a href="#" class="option-link" data-toggle="modal" data-target="#add-product-modal"><i class="icon ion-ios-cart"></i>&nbsp;<span class="link-text">Add</span></a></div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <nav class="mt-1">
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
            <div class="col-md-11 col-lg-7" style="border: 1px dashed #1c1c1c;border-radius: 10px;">
                <form>
                    <div class="form-group"><label>Customer:</label><input class="form-control form-control-sm" type="text" readonly=""></div>
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
                                <th>Amount</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td class="text-center">Product 1 including products</td>
                                <td>10</td>
                                <td>5000</td>
                                <td>500</td>
                                <td>45,000</td>
                                <td><span class="close" style="cursor: pointer;color: red;" title="remove"><i class="icon ion-close-round"></i></span></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td class="text-center">Product 1 including products</td>
                                <td>10</td>
                                <td>5000</td>
                                <td>500</td>
                                <td>45,000</td>
                                <td><span class="close" style="cursor: pointer;color: red;" title="remove"><i class="icon ion-close-round"></i></span></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td class="text-center">Product 1 including products</td>
                                <td>10</td>
                                <td>5000</td>
                                <td>500</td>
                                <td>45,000</td>
                                <td><span class="close" style="cursor: pointer;color: red;" title="remove"><i class="icon ion-close-round"></i></span></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td class="text-center">Product 1 including products</td>
                                <td>10</td>
                                <td>5000</td>
                                <td>500</td>
                                <td>45,000</td>
                                <td><span class="close" style="cursor: pointer;color: red;" title="remove"><i class="icon ion-close-round"></i></span></td>
                            </tr>
                            <tr>
                                <td colspan="3">Payment Type</td>
                                <td colspan="4">
                                    <div>
                                        <div class="custom-control custom-control-inline custom-radio"><input class="custom-control-input" type="radio" name="payment" checked="" id="cash"><label class="custom-control-label" for="cash">Cash</label></div>
                                        <div class="custom-control custom-control-inline custom-radio"><input class="custom-control-input" type="radio" name="payment" id="credit"><label class="custom-control-label" for="credit">Credit</label></div>
                                        <div class="custom-control custom-control-inline custom-radio"><input class="custom-control-input" type="radio" name="payment" id="debit"><label class="custom-control-label" for="debit">Debit</label></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">TOTAL AMOUNT</td>
                                <td colspan="4" class="font-weight-bold value" style="font-size: 13pt;">180,000/=</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="m-3 text-center"><button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">Cancel</button><button class="btn btn-primary btn-sm custom-btn" type="button">Confirm</button></div>
                </form>
            </div>
        </div>
    </div>
@stop
@section('modal')
    <div class="modal fade" role="dialog" tabindex="-1" id="add-product-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon ion-ios-cart"></i>&nbsp;Sell Product</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                <div class="modal-body">
                    <form>
                        <div class="form-row">
                            <div class="col-sm-6">
                                <p><span>Product Name:</span><span class="ml-1 value">Text</span></p>
                                <p><span>Selling Price:</span><span class="ml-1 value">Text</span></p>
                            </div>
                            <div class="col-sm-6">
                                <p><span>Available Quantity:</span><span class="ml-1 value">Text</span></p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-6"><label>Quantity</label><input class="form-control form-control-sm" type="number" value="0" placeholder="quantity" min="0" id="quantity"></div>
                            <div class="col-sm-6">
                                <div class="form-group"><label>Total</label><input class="form-control form-control-sm value" type="number" value="0" readonly="" placeholder="quantity" min="0" id="total"></div>
                            </div>
                        </div>
                        <div class="form-row mt-2">
                            <div class="col-sm-6"><label>Include discount?</label>
                                <div class="custom-control custom-switch"><input class="custom-control-input" type="checkbox" id="includeDiscount"><label class="custom-control-label" for="includeDiscount">Yes</label></div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group"><label>Discount Per Item</label><input class="form-control form-control-sm" type="number" placeholder="discount" min="0" id="discountAmount"></div>
                            </div>
                        </div>
                        <div class="form-row mt-2">
                            <div class="col-sm-6 offset-lg-6">
                                <div class="form-group"><label><strong>DUE&nbsp;AMOUNT</strong></label><input class="form-control form-control-sm" type="number" value="0" readonly="" id="dueAmount"></div>
                            </div>
                        </div>
                        <div class="float-right mt-2"><button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">Close</button><button class="btn btn-primary btn-sm custom-btn" type="button">Add</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="delete-product-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form>
                        <p>Are you selling to a saved Customer?</p>
                        <div class="float-right"><button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">No</button><button class="btn btn-primary btn-sm custom-btn" type="button">Yes</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="search-customer-modal">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon ion-search"></i>&nbsp;Search Customer</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                <div class="modal-body">
                    <form id="add-product-form" class="pt-3 pb-3 mb-3">
                        <div class="form-group">
                            <div class="input-group input-group-sm"><input class="form-control" type="text" placeholder="search customer">
                                <div class="input-group-append"><button class="btn btn-link" type="button"><i class="fa fa-search"></i></button></div>
                            </div>
                        </div>
                        <div class="loading"><span class="spinner-border" role="status" style="width: 50px;height: 50px;color: #00bacc;"></span><span class="mt-2">Loading..</span></div>
                        <div style="max-height: 70vh;overflow-y: auto;">
                            <div class="table-responsive table-bordered" id="customers-table">
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
                                        <td>COMPANY LIMITED</td>
                                    </tr>
                                    <tr style="cursor: pointer;">
                                        <td>2</td>
                                        <td>JUMA HASHIMU</td>
                                    </tr>
                                    <tr style="cursor: pointer;">
                                        <td>2</td>
                                        <td>JUMA HASHIMU</td>
                                    </tr>
                                    <tr style="cursor: pointer;">
                                        <td>2</td>
                                        <td>JUMA HASHIMU</td>
                                    </tr>
                                    <tr style="cursor: pointer;">
                                        <td>2</td>
                                        <td>JUMA HASHIMU</td>
                                    </tr>
                                    <tr style="cursor: pointer;">
                                        <td>2</td>
                                        <td>JUMA HASHIMU</td>
                                    </tr>
                                    <tr style="cursor: pointer;">
                                        <td>2</td>
                                        <td>JUMA HASHIMU</td>
                                    </tr>
                                    <tr style="cursor: pointer;">
                                        <td>2</td>
                                        <td>JUMA HASHIMU</td>
                                    </tr>
                                    <tr style="cursor: pointer;">
                                        <td>2</td>
                                        <td>JUMA HASHIMU</td>
                                    </tr>
                                    <tr style="cursor: pointer;">
                                        <td>2</td>
                                        <td>JUMA HASHIMU</td>
                                    </tr>
                                    <tr style="cursor: pointer;">
                                        <td>2</td>
                                        <td>JUMA HASHIMU</td>
                                    </tr>
                                    <tr style="cursor: pointer;">
                                        <td>2</td>
                                        <td>JUMA HASHIMU</td>
                                    </tr>
                                    <tr style="cursor: pointer;">
                                        <td>2</td>
                                        <td>JUMA HASHIMU</td>
                                    </tr>
                                    <tr style="cursor: pointer;">
                                        <td>2</td>
                                        <td>JUMA HASHIMU</td>
                                    </tr>
                                    <tr style="cursor: pointer;">
                                        <td>2</td>
                                        <td>JUMA HASHIMU</td>
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
