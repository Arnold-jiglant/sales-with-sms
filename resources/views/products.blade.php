@extends('layout.app')
@section('title')

@stop
@section('product')
    active
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
                <form class="search-form">
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <input class="form-control" type="text" placeholder="search product" name="search" required>
                            <div class="input-group-append">
                                <button class="btn btn-primary custom-btn" type="submit">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-11 col-xl-10 offset-lg-1 offset-xl-1">
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
        <div class="row">
            <div class="col-6">
                <p>
                    @if(strlen($title)>0)
                        {{$title}}, Found {{$products->total()}}
                    @else
                        Total {{$products->total()}} showing {{$products->firstItem()}}
                        -{{$products->lastItem()}}
                    @endif
                </p>
            </div>
            <div class="col order-sm-1">
                @can('add-inventory')
                    <div class="text-right">
                        <button class="btn btn-primary btn-sm custom-btn" type="button" data-toggle="modal"
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
        </div>
        <div class="table-responsive table-bordered" id="products-table">
            <table class="table table-bordered table-hover table-sm">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th class="text-center">Has Small Sizes</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if($products->count()>0)
                    @php($num=$products->firstItem())
                    @foreach($products as $product)
                        <tr>
                            <td>{{$num}}.</td>
                            <td>{{$product->name}}</td>
                            <td class="text-center">
                                <div class="custom-control custom-control-inline custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" {{$product->hasSize?'checked':''}}>
                                    <label class="custom-control-label" for="formCheck-1">{{$product->hasSize?'Yes':'No'}}</label>
                                </div>
                            </td>
                            <td>
                                <div class="options">
                                    <a href="#" class="option-link edit" data-toggle="modal"
                                       data-target="#edit-product-modal"
                                       data-id="{{$product->id}}" data-name="{{$product->name}}"
                                       data-size="{{$product->hasSize}}">
                                        <i class="icon ion-edit"></i>&nbsp;
                                        <span class="link-text">edit</span>
                                    </a>
                                    <a href="#" class="option-link delete" data-toggle="modal"
                                       data-target="#delete-product-modal" data-id="{{$product->id}}">
                                        <i class="icon ion-android-delete"></i>&nbsp;
                                        <span class="link-text">delete</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @php($num++)
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="text-center">No product added yet</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-11 col-md-10 col-lg-7 offset-1 offset-md-1 offset-lg-3">
            <nav>
                {{$products->links()}}
            </nav>
        </div>
    </div>
@stop
@section('modal')
    @can('add-inventory')
        <div class="modal fade" role="dialog" tabindex="-1" id="add-product-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="icon ion-plus"></i>&nbsp;Add Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{route('product.add')}}">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="productName">Product Name</label>
                                <input class="form-control form-control-sm" type="text" placeholder="Product name"
                                       id="productName" name="product_name" required>
                            </div>
                            <div class="form-group" data-toggle="popover"
                                 data-content="if product has small sizes eg. 1/4(0.25), 1/2(0.5) and 3/4(0.75)"
                                 data-trigger="hover" data-placement="right">
                                <div class="custom-control custom-control-inline custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="formCheck-1" name="hasSize">
                                    <label class="custom-control-label" for="formCheck-1">Has Small Sizes?</label>
                                </div>
                            </div>
                            <div class="float-right">
                                <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">Close
                                </button>
                                <button class="btn btn-primary btn-sm custom-btn" type="submit">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endcan
    @can('edit-inventory')
        <div class="modal fade" role="dialog" tabindex="-1" id="edit-product-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="icon ion-edit"></i>&nbsp;Edit Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                <label for="editProductName">Product Name</label>
                                <input class="form-control form-control-sm" type="text" placeholder="Product name"
                                       id="editProductName" name="product_name">
                            </div>
                            <div class="form-group" data-toggle="popover"
                                 data-content="if product has small sizes eg. 1/4(0.25), 1/2(0.5) and 3/4(0.75)"
                                 data-trigger="hover" data-placement="right">
                                <div class="custom-control custom-control-inline custom-checkbox"><input
                                        class="custom-control-input" type="checkbox" id="editHasSize"
                                        name="hasSize"><label
                                        class="custom-control-label" for="editHasSize">Has Small Sizes?</label></div>
                            </div>
                            <div class="float-right">
                                <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">Close
                                </button>
                                <button class="btn btn-primary btn-sm custom-btn" type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endcan
    @can('delete-inventory')
        <div class="modal fade" role="dialog" tabindex="-1" id="delete-product-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="icon ion-android-delete"></i>&nbsp;Delete Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <p>Are sure you want to delete this product?</p>
                            <div class="float-right">
                                <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">Close
                                </button>
                                <button class="btn btn-primary btn-sm custom-btn" type="submit">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@stop

@section('script')
    <script>
        $(document).ready(function () {
            @can('edit-inventory')
            //edit product
            $('#edit-product-modal').on('show.bs.modal', function (e) {
                let id = $(e.relatedTarget).data('id');
                let name = $(e.relatedTarget).data('name');
                let hasSize = $(e.relatedTarget).data('size') === 1;
                let form = $(this).find('form');
                let action = '{{route('product.update','')}}/' + id;
                form.attr('action', action);
                form.find("input[name='product_name']").val(name);
                form.find("input[name='hasSize']").attr('checked', hasSize);
            });
            @endcan
            @can('delete-inventory')
            //delete product
            $('#delete-product-modal').on('show.bs.modal', function (e) {
                let id = $(e.relatedTarget).data('id');
                let form = $(this).find('form');
                let action = '{{route('product.delete','')}}/' + id;
                form.attr('action', action);
            });
            @endcan
        });
    </script>
@stop
