@extends('layout.app')
@section('title')
    Users
@stop
@section('inventory')
    active
@stop
@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a><span>Dashboard</span></a></li>
                    <li class="breadcrumb-item"><a><span>Inventory</span></a></li>
                </ol>
            </div>
        </div>
        <h3 class="mt-1">Inventory</h3>
    </div>
    <div class="col-lg-11 col-xl-10 offset-lg-1 offset-xl-1">
        <div class="row">
            <div class="col-6">
                <p>Total 200 showing 20-30</p>
            </div>
            <div class="col order-sm-1"><a class="btn btn-primary btn-sm custom-btn float-right" role="button" href="#"><i class="icon ion-android-add"></i>Add Inventory</a></div>
        </div>
        <div class="table-responsive table-bordered text-center" id="products-table">
            <table class="table table-bordered table-hover table-sm">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Issued Date</th>
                    <th>Total Cost</th>
                    <th>Expecting Amount</th>
                    <th>Progress</th>
                    <th>Issuer</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>12/4/2018</td>
                    <td>3,000,000</td>
                    <td>61,350,000</td>
                    <td>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">50%</div>
                        </div>
                    </td>
                    <td>User</td>
                    <td>
                        <div class="options"><a href="#" class="option-link edit"><i class="icon ion-eye"></i>&nbsp;<span class="link-text">view</span></a><a href="#" class="option-link delete" data-toggle="modal" data-target="#delete-expense-modal"><i class="icon ion-android-delete"></i>&nbsp;<span class="link-text">delete</span></a></div>
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
    <div class="modal fade" role="dialog" tabindex="-1" id="delete-expense-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon ion-android-delete"></i>&nbsp;Delete Inventory</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                <div class="modal-body">
                    <form>
                        <p>Are you sure&nbsp;want to delete this Inventory?</p>
                    </form>
                </div>
                <div class="modal-footer"><button class="btn btn-light btn-sm" type="button" data-dismiss="modal">Close</button><button class="btn btn-primary btn-sm custom-btn" type="button">Confirm</button></div>
            </div>
        </div>
    </div>
@stop
