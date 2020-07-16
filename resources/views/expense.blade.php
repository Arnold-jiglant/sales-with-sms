@extends('layout.app')
@section('title')
    Users
@stop
@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a><span>Dashboard</span></a></li>
                    <li class="breadcrumb-item"><a><span>Expense</span></a></li>
                </ol>
            </div>
        </div>
        <h3 class="mt-1">Expenses</h3>
    </div>
    <div class="col-lg-11 col-xl-10 offset-lg-1 offset-xl-1">
        <div class="row">
            <div class="col-6">
                <p>Total 200 showing 20-30</p>
            </div>
            <div class="col order-sm-1">
                <div class="btn-group float-right" role="group">
                    <div class="dropdown btn-group d-inline-block" role="group"><button class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false" type="button">Filter</button>
                        <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="#">First Item</a><a class="dropdown-item" role="presentation" href="#">Second Item</a><a class="dropdown-item" role="presentation" href="#">Third Item</a></div>
                    </div><button class="btn btn-primary btn-sm custom-btn ml-1" type="button" data-toggle="modal" data-target="#add-expense-modal"><i class="icon ion-android-add"></i>Add Expense</button></div>
            </div>
        </div>
        <div class="table-responsive table-bordered text-center" id="products-table">
            <table class="table table-bordered table-hover table-sm">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Issuer</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>Transportation</td>
                    <td>3,000</td>
                    <td>Expense description</td>
                    <td>12/01/2019</td>
                    <td>User</td>
                    <td>
                        <div class="options"><a href="#" class="option-link edit" data-toggle="modal" data-target="#edit-expense-modal"><i class="icon ion-edit"></i>&nbsp;<span class="link-text">edit</span></a><a href="#" class="option-link delete" data-toggle="modal"
                                                                                                                                                                                                                     data-target="#delete-expense-modal"><i class="icon ion-android-delete"></i>&nbsp;<span class="link-text">delete</span></a></div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-11 col-md-10 col-lg-7 offset-1 offset-md-1 offset-lg-3">
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
    <div class="modal fade" role="dialog" tabindex="-1" id="add-expense-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon ion-plus"></i>&nbsp;Add Expense</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                <div class="modal-body">
                    <form>
                        <div class="form-group"><label>Expense Type:</label><select class="custom-select custom-select-sm" id="expenseType"><option value="12" selected="">This is item 1</option><option value="13">This is item 2</option><option value="14">This is item 3</option></select></div>
                        <div
                            class="form-group" data-toggle="popover" data-content="Total amount expended" data-trigger="focus" data-placement="right"><label>Amount</label><input class="form-control form-control-sm" type="number" placeholder="Amount spent" min="1" id="editQuantity"></div>
                        <div class="form-group" data-toggle="popover" data-content="Expense description" data-trigger="focus"
                             data-placement="right"><label>Description(optional)</label><textarea class="form-control form-control-sm" rows="3" placeholder="Description" id="expenseDesc"></textarea></div>
                        <div class="float-right"><button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">Close</button><button class="btn btn-primary btn-sm custom-btn" type="button">Add</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="edit-expense-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon ion-edit"></i>&nbsp;Edit Expense</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                <div class="modal-body">
                    <form>
                        <div class="form-group"><label>Expense Type:</label><select class="custom-select custom-select-sm" id="expenseType"><option value="12" selected="">This is item 1</option><option value="13">This is item 2</option><option value="14">This is item 3</option></select></div>
                        <div
                            class="form-group" data-toggle="popover" data-content="Total amount expended" data-trigger="focus" data-placement="right"><label>Amount</label><input class="form-control form-control-sm" type="number" placeholder="Amount spent" min="1" id="editQuantity"></div>
                        <div class="form-group" data-toggle="popover" data-content="Expense description" data-trigger="focus"
                             data-placement="right"><label>Description(optional)</label><textarea class="form-control form-control-sm" rows="3" placeholder="Description" id="expenseDesc"></textarea></div>
                        <div class="float-right"><button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">Close</button><button class="btn btn-primary btn-sm custom-btn" type="button">Update</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="delete-expense-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon ion-android-delete"></i>&nbsp;Delete Expense</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                <div class="modal-body">
                    <form>
                        <p>Are sure you want to delete this expense?</p>
                        <div class="float-right"><button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">Close</button><button class="btn btn-primary btn-sm custom-btn" type="button">Delete</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
