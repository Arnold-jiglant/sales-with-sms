@extends('layout.app')
@section('title')
    Configure
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
    <div class="col-lg-12 col-xl-10 offset-lg-0 offset-xl-1">
        <div class="row">
            <div class="col-6 col-lg-4">
                <form class="text-center p-3" style="border: 1px solid #eee;border-radius: 10px;" method="POST"
                      action="{{route('sellMethod')}}">
                    {{csrf_field()}}
                    <div class="form-group"><label class="font-weight-bold">SELLING METHOD</label>
                        <div>
                            @foreach($sellMethods as $method)
                                <div class="custom-control custom-control-inline custom-radio" data-toggle="popover"
                                     data-content="{{$method->description}}"
                                     data-trigger="hover" data-placement="bottom">
                                    <input class="custom-control-input" type="radio" name="sellMethod"
                                           {{\App\Configuration::sellMethod()==$method->id?'Checked':''}}
                                           id="{{$method->method}}" value="{{$method->id}}">
                                    <label class="custom-control-label"
                                           for="{{$method->method}}">{{$method->method}}  </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <button class="btn btn-primary btn-sm custom-btn mb-2" type="submit">Change</button>
                </form>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-6 col-xl-5 offset-xl-1">
            <form class="p-3" style="border: 1px solid #eee;border-radius: 10px;">
                <h5>User Roles</h5>
                <a href="{{route('addRole')}}" class="btn btn-primary btn-sm custom-btn mb-2 float-right">Add</a>
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
                            @if($role->id==1)
                                @continue
                            @endif
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
            </form>
        </div>
        <div class="col-6 col-xl-5">
            <form class="p-4" style="border: 1px solid #eee;border-radius: 10px;">
                <h5>Expense Categories</h5>
                <div class="text-right">
                    <button class="btn btn-primary btn-sm custom-btn mb-2" type="button" data-toggle="modal"
                            data-target="#add-expense-category-modal">Add
                    </button>
                </div>
                @error('name')
                <small class="text-danger">{{$message}}</small>
                @enderror
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
                                            <a href="#" class="option-link delete" data-toggle="modal"
                                               data-target="#delete-role-modal" data-id="{{$category->id}}">
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
                @endif
            </form>
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
                        <p>Are you sure you want to delete this category?</p>
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
            //edit category
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
            //delete category
            $('#delete-expense-category-modal').on('show.bs.modal', function (e) {
                let id = $(e.relatedTarget).data('id');
                let form = $(this).find('form');
                let action = '{{route('deleteExpenseType','')}}/' + id;
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
