@extends('layout.app')
@section('title')
    Configure
@stop
@section('configure')
    active
@stop
@section('content')
    <div class="container mt-3">
        <h3 class="mt-1"><i class="fa fa-gears"></i>&nbsp;@lang('language.configure.title')</h3>
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
            <li class="mr-1"><a class="btn btn-sm btn-primary" data-toggle="pill"
                                href="#user-roles">@lang('language.configure.user')</a>
            </li>
            <li class="mr-1">
                <button class="btn btn-sm btn-info" data-toggle="pill"
                        data-target="#expense-categories">@lang('language.configure.expense')
                </button>
            </li>
            <li class="mr-1">
                <button class="btn btn-sm btn-success" data-toggle="pill" data-target="#extra-income-categories">
                    @lang('language.configure.income')
                </button>
            </li>
            <li class="mr-1">
                <button class="btn btn-sm btn-success custom-btn" data-toggle="pill" data-target="#database-backup">
                    @lang('language.configure.database')
                </button>
            </li>
        </ul>
        <div class="col-lg-6">
            <div class="tab-content mt-2">
                <div id="user-roles" class="tab-pane fade in active show">
                    <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="text-primary font-weight-bold m-0">@lang('language.configure.user')</h6>
                            <a href="{{route('addRole')}}"
                               class="btn btn-primary btn-sm custom-btn mb-2">@lang('language.add')</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-bordered text-center" id="products-table">
                                <table class="table table-bordered table-hover table-sm">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('language.name')</th>
                                        <th>@lang('language.users.title')</th>
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
                                                        <span class="link-text">@lang('language.btn_edit')</span>
                                                    </a>
                                                    <a href="#" class="option-link delete" data-toggle="modal"
                                                       data-target="#delete-role-modal" data-id="{{$role->id}}">
                                                        <i class="icon ion-android-delete"></i>&nbsp;
                                                        <span class="link-text">@lang('language.btn_delete')</span>
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
                            <h6 class="text-primary font-weight-bold m-0">@lang('language.configure.expense')</h6>
                            <button class="btn btn-primary btn-sm custom-btn mb-2" type="button" data-toggle="modal"
                                    data-target="#add-expense-category-modal">@lang('language.add')
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
                                            <th>@lang('language.type')</th>
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
                                                                class="link-text">@lang('language.btn_edit')</span>
                                                        </a>
                                                        @if(!$category->hasExpenses)
                                                            <a href="#" class="option-link delete" data-toggle="modal"
                                                               data-target="#delete-expense-category-modal"
                                                               data-id="{{$category->id}}">
                                                                <i class="icon ion-android-delete"></i>&nbsp;
                                                                <span
                                                                    class="link-text">@lang('language.btn_delete')</span>
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
                            <h6 class="text-primary font-weight-bold m-0">@lang('language.configure.income')</h6>
                            <button class="btn btn-primary btn-sm custom-btn mb-2" type="button" data-toggle="modal"
                                    data-target="#add-income-category-modal">@lang('language.add')
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
                                            <th>@lang('source')</th>
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
                                                                class="link-text">@lang('language.btn_edit')</span>
                                                        </a>
                                                        @if(!$category->hasIncomes)
                                                            <a href="#" class="option-link delete" data-toggle="modal"
                                                               data-target="#delete-income-category-modal"
                                                               data-id="{{$category->id}}">
                                                                <i class="icon ion-android-delete"></i>&nbsp;
                                                                <span
                                                                    class="link-text">@lang('language.btn_delete')</span>
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
                <div id="database-backup" class="tab-pane fade in">
                    <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="text-primary font-weight-bold m-0">@lang('language.configure.database')</h6>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#edit-database-backup-details-modal">
                                <span class="fa fa-edit"></span> @lang('language.btn_edit')
                            </button>
                        </div>
                        <div class="card-body">
                            <p>@lang('language.users.email'): <strong>{{$backupEmail->value}}</strong></p>
                            <p>@lang('language.time'): <strong>Every day at {{$backupTime->value}} </strong></p>
                            <p>@lang('language.configure.database'):
                                <strong>{{(bool)$backupDatabase->value?\Illuminate\Support\Facades\Lang::get('language.enable'):\Illuminate\Support\Facades\Lang::get('language.disable')}} </strong>
                            </p>
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
                    <h5 class="modal-title"><i class="icon ion-plus"></i>&nbsp;@lang('language.configure.add_expense')
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('addExpenseType')}}" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="name">@lang('language.configure.expense_type_name'):</label>
                            <input id="name" class="form-control form-control-sm" type="text" name="name"
                                   placeholder="@lang('language.name')">
                        </div>
                        <div class="form-group">
                            <label for="description">@lang('language.configure.expense_type_desc')
                                (@lang('language.optional'))</label>
                            <textarea class="form-control form-control-sm" rows="4" id="description"
                                      name="description"></textarea>
                        </div>
                        <div class="float-right">
                            <button class="btn btn-light btn-sm mr-2" type="button"
                                    data-dismiss="modal">@lang('language.close')</button>
                            <button class="btn btn-primary btn-sm custom-btn"
                                    type="submit">@lang('language.confirm')</button>
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
                    <h5 class="modal-title"><i class="icon ion-edit"></i>&nbsp;@lang('language.configure.edit_expense')
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <input type="hidden" name="_method" value="PUT">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="name">@lang('language.configure.expense_type_name'):</label>
                            <input class="form-control form-control-sm" type="text" placeholder="name" id="name"
                                   name="name">
                        </div>
                        <div class="form-group">
                            <label for="description">@lang('language.description') (@lang('language.optional'))</label>
                            <textarea class="form-control form-control-sm" rows="4" id="description"
                                      name="description"></textarea>
                        </div>
                        <div class="float-right">
                            <button class="btn btn-light btn-sm mr-2" type="button"
                                    data-dismiss="modal">@lang('close')</button>
                            <button class="btn btn-primary btn-sm custom-btn"
                                    type="submit">@lang('language.confirm')</button>
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
                    <h5 class="modal-title"><i
                            class="icon ion-android-delete"></i>&nbsp;@lang('language.configure.delete_expense')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="DELETE">
                        <p>@lang('language.configure.delete_expense_message')</p>
                        <div class="float-right">
                            <button class="btn btn-light btn-sm mr-2" type="button"
                                    data-dismiss="modal">@lang('language.close')</button>
                            <button class="btn btn-primary btn-sm custom-btn"
                                    type="submit">@lang('language.btn_delete')</button>
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
                    <h5 class="modal-title"><i class="icon ion-plus"></i>&nbsp;@lang('language.configure.add_income')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('add.income.type')}}" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="name">@lang('language.configure.income_source_name'):</label>
                            <input id="name" class="form-control form-control-sm" type="text" name="name"
                                   placeholder="@lang('language.name')" required>
                        </div>
                        <div class="form-group">
                            <label for="description">@lang('language.configure.income_source_desc') (@lang('language.optional'))</label>
                            <textarea class="form-control form-control-sm" rows="4" id="description"
                                      name="description"></textarea>
                        </div>
                        <div class="float-right">
                            <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">@lang('language.close')</button>
                            <button class="btn btn-primary btn-sm custom-btn" type="submit">@lang('language.confirm')</button>
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
                    <h5 class="modal-title"><i class="icon ion-edit"></i>&nbsp;@lang('language.configure.edit_income')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <input type="hidden" name="_method" value="PUT">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="name">@lang('language.configure.income_source_name'):</label>
                            <input class="form-control form-control-sm" type="text" placeholder="name" id="name"
                                   name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="description">@lang('language.description') (@lang('language.optional'))</label>
                            <textarea class="form-control form-control-sm" rows="4" id="description"
                                      name="description"></textarea>
                        </div>
                        <div class="float-right">
                            <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">@lang('close')</button>
                            <button class="btn btn-primary btn-sm custom-btn" type="submit">@lang('language.confirm')</button>
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
                    <h5 class="modal-title"><i class="icon ion-android-delete"></i>&nbsp;@lang('language.configure.delete_income')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="DELETE">
                        <p>@lang('language.configure.delete_income_message')</p>
                        <div class="float-right">
                            <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">@lang('language.close')</button>
                            <button class="btn btn-primary btn-sm custom-btn" type="submit">@lang('language.btn_delete')</button>
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
                    <h5 class="modal-title"><i class="icon ion-android-delete"></i>&nbsp;@lang('language.configure.delete_role')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="DELETE">
                        <p>@lang('language.configure.delete_role_message')</p>
                        <div class="float-right">
                            <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">@lang('language.close')</button>
                            <button class="btn btn-primary btn-sm custom-btn" type="submit">@lang('language.btn_delete')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" role="dialog" tabindex="-1" id="edit-database-backup-details-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon ion-edit"></i>&nbsp;@lang('language.configure.database_details')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('database.backup')}}" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <div class="custom-control custom-control-inline custom-switch">
                                <input class="custom-control-input" type="checkbox" id="backup"
                                       name="backup" {{(bool)$backupDatabase->value?'checked':''}}>
                                <label class="custom-control-label" for="backup">@lang('language.configure.database')</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="backup_email">@lang('language.users.email'):</label>
                            <input id="backup_email" class="form-control form-control-sm" type="email" name="email"
                                   placeholder="@lang('language.configure.backup_email')" required value="{{$backupEmail->value}}">
                        </div>
                        <div class="form-group">
                            <label for="backup_time">@lang('language.time'):</label>
                            <div class="d-block">
                                <select id="backup_time" class="form-control form-control-sm" name="time"
                                        required>
                                    @for($i=0;$i<=23;$i++)
                                        @php($hour = str_pad($i,2,'0',STR_PAD_LEFT).':00')
                                        @if($backupTime->value==$hour)
                                            <option selected>{{$hour}}</option>
                                        @else
                                            <option>{{$hour}}</option>
                                        @endif
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="float-right">
                            <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">@lang('language.close')</button>
                            <button class="btn btn-primary btn-sm custom-btn" type="submit">@lang('language.submit')</button>
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
