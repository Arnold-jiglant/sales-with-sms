@extends('layout.app')
@section('title')
    Configure
@stop
@section('configure')
    active
@stop
@section('content')
    <div class="container mt-3">
        <h3 class="mt-1"><i class="fa fa-gears"></i>&nbsp;System Configuration</h3>
    </div>
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
    <div class="container">
        <ul class="nav nav-pills">
            <li class="mr-1"><a class="btn btn-sm btn-primary" data-toggle="pill" href="#user-roles">User Role</a>
            </li>
            <li class="mr-1">
                <button class="btn btn-sm btn-info" data-toggle="pill" data-target="#expense-categories">Expense
                    Categories
                </button>
            </li>
            <li class="mr-1">
                <button class="btn btn-sm btn-success" data-toggle="pill" data-target="#extra-income-categories">
                    Extra Income Sources
                </button>
            </li>
        </ul>
        <div class="col-lg-6">
            <div class="tab-content mt-2">
                <div id="user-roles" class="tab-pane fade in">
                    <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="text-primary font-weight-bold m-0">User Roles</h6>
                            <a href="{{route('addRole')}}"
                               class="btn btn-primary btn-sm custom-btn mb-2">Add</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-bordered text-center" id="products-table">
                                <table class="table table-bordered table-hover table-sm">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Users</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php($num=1)
                                    @foreach($roles as $role)
                                        <tr>
                                            <td>{{$num}}</td>
                                            <td>{{$role->name}}</td>
                                            <td>{{$role->users()->count()}}</td>
                                            <td>
                                                <div class="options">
                                                    <a href="{{route('editRole',$role->id)}}" class="option-link edit">
                                                        <i class="icon ion-edit"></i>&nbsp;
                                                        <span class="link-text">edit</span>
                                                    </a>
                                                    <a href="#" class="option-link delete" data-toggle="modal"
                                                       data-target="#delete-role-modal" data-id="{{$role->id}}">
                                                        <i class="icon ion-android-delete"></i>&nbsp;
                                                        <span class="link-text">delete</span>
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
                    </div>
                </div>
                <div id="expense-categories" class="tab-pane fade in">
                    <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="text-primary font-weight-bold m-0">Expense Categories</h6>
                            <button class="btn btn-primary btn-sm custom-btn mb-2" type="button" data-toggle="modal"
                                    data-target="#add-expense-category-modal">Add
                            </button>
                        </div>
                        <div class="card-body">
                            @if($expenseCategories->count()>0)
                                <div class="table-responsive table-bordered text-center"
                                     id="products-table">
                                    <table class="table table-bordered table-hover table-sm">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Category</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php($num=1)
                                        @foreach($expenseCategories as $category)
                                            <tr>
                                                <td>{{$num}}</td>
                                                <td>{{$category->name}}</td>
                                                <td>
                                                    <div class="options">
                                                        <a href="#edit-expense-category-modal" class="option-link edit"
                                                           data-toggle="modal" data-id="{{$category->id}}"
                                                           data-name="{{$category->name}}"
                                                           data-description="{{$category->description}}">
                                                            <i class="icon ion-edit"></i>&nbsp;<span
                                                                class="link-text">edit</span>
                                                        </a>
                                                        @if(!$category->hasExpenses)
                                                            <a href="#" class="option-link delete" data-toggle="modal"
                                                               data-target="#delete-expense-category-modal"
                                                               data-id="{{$category->id}}">
                                                                <i class="icon ion-android-delete"></i>&nbsp;
                                                                <span class="link-text">delete</span>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            @php($num++)
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div id="extra-income-categories" class="tab-pane fade in">
                    <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="text-primary font-weight-bold m-0">Extra Income Sources</h6>
                            <button class="btn btn-primary btn-sm custom-btn mb-2" type="button" data-toggle="modal"
                                    data-target="#add-income-category-modal">Add
                            </button>
                        </div>
                        <div class="card-body">
                            @if($incomeCategories->count()>0)
                                <div class="table-responsive table-bordered text-center"
                                     id="products-table">
                                    <table class="table table-bordered table-hover table-sm">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Source</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php($num=1)
                                        @foreach($incomeCategories as $category)
                                            <tr>
                                                <td>{{$num}}</td>
                                                <td>{{$category->name}}</td>
                                                <td>
                                                    <div class="options">
                                                        <a href="#edit-income-category-modal" class="option-link edit"
                                                           data-toggle="modal" data-id="{{$category->id}}"
                                                           data-name="{{$category->name}}"
                                                           data-description="{{$category->description}}">
                                                            <i class="icon ion-edit"></i>&nbsp;<span
                                                                class="link-text">edit</span>
                                                        </a>
                                                        @if(!$category->hasIncomes)
                                                            <a href="#" class="option-link delete" data-toggle="modal"
                                                               data-target="#delete-income-category-modal"
                                                               data-id="{{$category->id}}">
                                                                <i class="icon ion-android-delete"></i>&nbsp;
                                                                <span class="link-text">delete</span>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            @php($num++)
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('modal')
    <div class="modal fade" role="dialog" tabindex="-1" id="add-expense-category-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon ion-plus"></i>&nbsp;Add Expense Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('addExpenseType')}}" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="name">Category Name:</label>
                            <input id="name" class="form-control form-control-sm" type="text" name="name"
                                   placeholder="name">
                        </div>
                        <div class="form-group">
                            <label for="description">Category Description (optinal)</label>
                            <textarea class="form-control form-control-sm" rows="4" id="description"
                                      name="description"></textarea>
                        </div>
                        <div class="float-right">
                            <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary btn-sm custom-btn" type="submit">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="edit-expense-category-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon ion-edit"></i>&nbsp;Edit Expense Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <input type="hidden" name="_method" value="PUT">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="name">Category Name:</label>
                            <input class="form-control form-control-sm" type="text" placeholder="name" id="name"
                                   name="name">
                        </div>
                        <div class="form-group">
                            <label for="description">Category Description (optional)</label>
                            <textarea class="form-control form-control-sm" rows="4" id="description"
                                      name="description"></textarea>
                        </div>
                        <div class="float-right">
                            <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary btn-sm custom-btn" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="delete-expense-category-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon ion-android-delete"></i>&nbsp;Delete Expense Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="DELETE">
                        <p>Are you sure you want to delete this expense category?</p>
                        <div class="float-right">
                            <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary btn-sm custom-btn" type="submit">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" role="dialog" tabindex="-1" id="add-income-category-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon ion-plus"></i>&nbsp;Add Income Source</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('add.income.type')}}" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="name">Source Name:</label>
                            <input id="name" class="form-control form-control-sm" type="text" name="name"
                                   placeholder="name" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Source Description (optional)</label>
                            <textarea class="form-control form-control-sm" rows="4" id="description"
                                      name="description"></textarea>
                        </div>
                        <div class="float-right">
                            <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary btn-sm custom-btn" type="submit">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="edit-income-category-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon ion-edit"></i>&nbsp;Edit Income Source</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <input type="hidden" name="_method" value="PUT">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="name">Source Name:</label>
                            <input class="form-control form-control-sm" type="text" placeholder="name" id="name"
                                   name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Source Description (optional)</label>
                            <textarea class="form-control form-control-sm" rows="4" id="description"
                                      name="description"></textarea>
                        </div>
                        <div class="float-right">
                            <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary btn-sm custom-btn" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="delete-income-category-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon ion-android-delete"></i>&nbsp;Delete Income Source</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="DELETE">
                        <p>Are you sure you want to delete this income source?</p>
                        <div class="float-right">
                            <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary btn-sm custom-btn" type="submit">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" role="dialog" tabindex="-1" id="delete-role-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon ion-android-delete"></i>&nbsp;Delete Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="DELETE">
                        <p>Are you sure you want to delete this role?</p>
                        <div class="float-right">
                            <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary btn-sm custom-btn" type="submit">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script>
        $(document).ready(function () {
            //edit expense category
            $('#edit-expense-category-modal').on('show.bs.modal', function (e) {
                let id = $(e.relatedTarget).data('id');
                let name = $(e.relatedTarget).data('name');
                let desc = $(e.relatedTarget).data('description');
                let form = $(this).find('form');
                let action = '{{route('updateExpenseType','')}}/' + id;
                form.attr('action', action);
                form.find("input[name='name']").val(name);
                form.find("textarea").val(desc);
            });
            //delete expense category
            $('#delete-expense-category-modal').on('show.bs.modal', function (e) {
                let id = $(e.relatedTarget).data('id');
                let form = $(this).find('form');
                let action = '{{route('deleteExpenseType','')}}/' + id;
                form.attr('action', action);
            });

            //edit icnome category
            $('#edit-income-category-modal').on('show.bs.modal', function (e) {
                let id = $(e.relatedTarget).data('id');
                let name = $(e.relatedTarget).data('name');
                let desc = $(e.relatedTarget).data('description');
                let form = $(this).find('form');
                let action = '{{route('update.income.type','')}}/' + id;
                form.attr('action', action);
                form.find("input[name='name']").val(name);
                form.find("textarea").val(desc);
            });
            //delete category
            $('#delete-income-category-modal').on('show.bs.modal', function (e) {
                let id = $(e.relatedTarget).data('id');
                let form = $(this).find('form');
                let action = '{{route('delete.income.type','')}}/' + id;
                form.attr('action', action);
            });
            //delete role
            $('#delete-role-modal').on('show.bs.modal', function (e) {
                let id = $(e.relatedTarget).data('id');
                let form = $(this).find('form');
                let action = '{{route('deleteRole','')}}/' + id;
                form.attr('action', action);
            });
        });
    </script>
@stop
