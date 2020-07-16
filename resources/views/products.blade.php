@extends('layout.app')
@section('title')

@stop
@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a><span>Dashboard</span></a></li>
                    <li class="breadcrumb-item"><a><span>Product</span></a></li>
                </ol>
            </div>
        </div>
        <h3 class="mt-1">Products</h3>
        <div class="row mt-1">
            <div class="col-md-8 col-xl-6 offset-md-2">
                <form id="search-form">
                    <div class="form-group">
                        <div class="input-group"><input class="form-control" type="text" placeholder="search product">
                            <div class="input-group-append"><button class="btn btn-primary custom-btn" type="button">Search</button></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-11 col-xl-10 offset-lg-1 offset-xl-1">
        <div class="row">
            <div class="col-6">
                <p>Total 200 showing 20-30</p>
            </div>
            <div class="col order-sm-1"><button class="btn btn-primary btn-sm custom-btn float-right" type="button" data-toggle="modal" data-target="#add-product-modal"><i class="icon ion-android-add"></i>Add Product</button></div>
        </div>
        <div class="table-responsive table-bordered text-center" id="products-table">
            <table class="table table-bordered table-hover table-sm">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Has Small Sizes</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>Product 1</td>
                    <td>Yes</td>
                    <td>
                        <div class="options"><a href="#" class="option-link edit" data-toggle="modal" data-target="#edit-product-modal"><i class="icon ion-edit"></i>&nbsp;<span class="link-text">edit</span></a><a href="#" class="option-link delete" data-toggle="modal"
                                                                                                                                                                                                                     data-target="#delete-product-modal"><i class="icon ion-android-delete"></i>&nbsp;<span class="link-text">delete</span></a></div>
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
    <div class="modal fade" role="dialog" tabindex="-1" id="add-product-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon ion-plus"></i>&nbsp;Add Product</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                <div class="modal-body">
                    <form>
                        <div class="form-group"><label>Product Name</label><input class="form-control form-control-sm" type="text" placeholder="Product name" id="editProductName"></div>
                        <div class="form-group" data-toggle="popover" data-content="if product has small sizes eg. 1/4(0.25), 1/2(0.5) and 3/4(0.75)"
                             data-trigger="hover" data-placement="right">
                            <div class="custom-control custom-control-inline custom-checkbox"><input class="custom-control-input" type="checkbox" id="formCheck-1"><label class="custom-control-label" for="formCheck-1">Has Small Sizes?</label></div>
                        </div>
                        <div class="float-right"><button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">Close</button><button class="btn btn-primary btn-sm custom-btn" type="button">Update</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="edit-product-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon ion-edit"></i>&nbsp;Edit Product</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                <div class="modal-body">
                    <form>
                        <div class="form-group"><label>Product Name</label><input class="form-control form-control-sm" type="text" placeholder="Product name" id="productName"></div>
                        <div class="form-group" data-toggle="popover" data-content="if product has small sizes eg. 1/4(0.25), 1/2(0.5) and 3/4(0.75)"
                             data-trigger="hover" data-placement="right">
                            <div class="custom-control custom-control-inline custom-checkbox"><input class="custom-control-input" type="checkbox" id="formCheck-1"><label class="custom-control-label" for="formCheck-1">Has Small Sizes?</label></div>
                        </div>
                        <div class="float-right"><button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">Close</button><button class="btn btn-primary btn-sm custom-btn" type="button">Update</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="delete-product-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon ion-android-delete"></i>&nbsp;Delete Product</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                <div class="modal-body">
                    <form>
                        <p>Are sure you want to delete this product?</p>
                        <div class="float-right"><button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">Close</button><button class="btn btn-primary btn-sm custom-btn" type="button">Delete</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
