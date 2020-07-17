@extends('layout.app')
@section('title')
    Customers
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
        <h3 class="mt-1">Purchase History</h3>
    </div>
    <div class="col-lg-11 col-xl-10 offset-lg-1 offset-xl-1">
        <form>
            <p><span>Customer Name:</span><span class="ml-1 value">Text</span></p>
            <p>Total 200 showing 20-30</p>
            <div class="table-responsive table-bordered">
                <table class="table table-bordered table-sm">
                    <thead class="text-danger">
                    <tr>
                        <th>#</th>
                        <th>Receipt No.</th>
                        <th>Products</th>
                        <th>Qty</th>
                        <th>Amount</th>
                        <th>Total Amount</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr title="Some Descriptions">
                        <td rowspan="3" class="align-middle text-center">1</td>
                        <td rowspan="3" class="align-middle text-center">KJHK2352</td>
                        <td>Product 1</td>
                        <td>3</td>
                        <td>3,000</td>
                        <td rowspan="3" class="align-middle text-center font-weight-bold">9,000/=</td>
                        <td rowspan="3" class="align-middle text-center">10/06/2020</td>
                    </tr>
                    <tr title="Some Descriptions">
                        <td>Product 2</td>
                        <td>3</td>
                        <td>3,000</td>
                    </tr>
                    <tr title="Some Descriptions">
                        <td>Product 3</td>
                        <td>3</td>
                        <td>3,000</td>
                    </tr>
                    <tr title="Some Descriptions">
                        <td rowspan="3" class="align-middle text-center">2</td>
                        <td rowspan="3" class="align-middle text-center">JH545789</td>
                        <td>Cell 4</td>
                        <td>3</td>
                        <td>3,000</td>
                        <td rowspan="3" class="align-middle text-center font-weight-bold">9,000/=</td>
                        <td rowspan="3" class="align-middle text-center">10/06/2020</td>
                    </tr>
                    <tr title="Some Descriptions">
                        <td>Cell 4</td>
                        <td>3</td>
                        <td>3,000</td>
                    </tr>
                    <tr title="Some Descriptions">
                        <td>Cell 4</td>
                        <td>3</td>
                        <td>3,000</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    <div class="row mt-2">
        <div class="col-11 col-md-10 col-lg-7 offset-1 offset-md-1 offset-lg-3">
            <nav>
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#" aria-label="Previous"><span
                                aria-hidden="true">«</span></a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                    <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span
                                aria-hidden="true">»</span></a></li>
                </ul>
            </nav>
        </div>
    </div>
@stop
@section('modal')
    <div class="modal fade" role="dialog" tabindex="-1" id="view-customer-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Customer Purchase History</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form>
                        <p><span>Customer Name:</span><span class="ml-1 value">Text</span></p>
                        <p>Total 200 showing 20-30</p>
                        <div class="table-responsive table-bordered">
                            <table class="table table-bordered table-sm">
                                <thead class="text-danger">
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Amount</th>
                                    <th>Receipt No.</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr title="Some Descriptions">
                                    <td>1</td>
                                    <td>Product 1</td>
                                    <td>3</td>
                                    <td>3,000</td>
                                    <td rowspan="3" class="align-middle text-center">JHGJ234K</td>
                                    <td>10/06/2020</td>
                                </tr>
                                <tr title="Some Descriptions">
                                    <td>2</td>
                                    <td>Product 2</td>
                                    <td>3</td>
                                    <td>3,000</td>
                                    <td>10/06/2020</td>
                                </tr>
                                <tr title="Some Descriptions">
                                    <td>3</td>
                                    <td>Product 3</td>
                                    <td>3</td>
                                    <td>3,000</td>
                                    <td>10/06/2020</td>
                                </tr>
                                <tr title="Some Descriptions">
                                    <td>4</td>
                                    <td>Product 4</td>
                                    <td>3</td>
                                    <td>3,000</td>
                                    <td>Cell 5</td>
                                    <td>10/06/2020</td>
                                </tr>
                                <tr title="Some Descriptions">
                                    <td>5</td>
                                    <td>Product 5</td>
                                    <td>3</td>
                                    <td>3,000</td>
                                    <td>Cell 5</td>
                                    <td>10/06/2020</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-auto">
                            <nav>
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="#" aria-label="Previous"><span
                                                aria-hidden="true">«</span></a></li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                                    <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span
                                                aria-hidden="true">»</span></a></li>
                                </ul>
                            </nav>
                        </div>
                    </form>
                    <div class="loading"><span class="spinner-border" role="status"
                                               style="width: 60px;height: 60px;color: #00bacc;"></span><span
                            class="mt-2">Loading..</span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="add-customer-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon ion-plus"></i>&nbsp;Add Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group" data-toggle="popover" data-content="Total amount expended"
                             data-trigger="focus" data-placement="right"><label>Customer Name:</label><input
                                class="form-control form-control-sm" type="text" placeholder="name" id="customerName">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light btn-sm" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary btn-sm custom-btn" type="button">Add</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="edit-customer-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon ion-edit"></i>&nbsp;Edit Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group" data-toggle="popover" data-content="Total amount expended"
                             data-trigger="focus" data-placement="right"><label>Customer Name:</label><input
                                class="form-control form-control-sm" type="text" placeholder="name"
                                id="editCustomerName"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light btn-sm" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary btn-sm custom-btn" type="button">Update</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="delete-customer-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon ion-android-delete"></i>&nbsp;Delete Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form>
                        <p>Are sure you want to delete this customer?</p>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light btn-sm" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary btn-sm custom-btn" type="button">Confirm</button>
                </div>
            </div>
        </div>
    </div>
@stop
