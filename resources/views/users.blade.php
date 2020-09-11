@extends('layout.app')
@section('title')
    Users
@stop
@section('user')
    active
@stop
@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a><span>@lang('language.dashboard')</span></a></li>
                    <li class="breadcrumb-item"><a><span>@lang('language.users.title')</span></a></li>
                </ol>
            </div>
        </div>
        <h3 class="mt-1">@lang('language.users.title')</h3>
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
                <p>@lang('language.total') {{$users->total()}} @lang('language.showing') {{$users->firstItem()}}-{{$users->lastItem()}}</p>
            </div>
            <div class="col-6">
                <div class="text-right d-block">
                    @can('add-user')
                        <button class="btn btn-primary btn-sm custom-btn" type="button" data-toggle="modal"
                                data-target="#add-user-modal"><i class="icon ion-android-add"></i>@lang('language.users.add')
                        </button>
                    @endcan
                </div>
                @if ($errors->any())
                    <ul>
                        @foreach($errors->all() as $error)
                            <li class="text-danger">{{$error}}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
        <div class="table-responsive table-bordered text-center" id="products-table">
            <table class="table table-bordered table-hover table-sm">
                <thead>
                <tr>
                    <th>#</th>
                    <th>@lang('language.name')</th>
                    <th>@lang('language.users.email')</th>
                    <th>@lang('language.users.role')</th>
                    <th>@lang('language.users.language')</th>
                    <th>@lang('language.users.status')</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @php($num=$users->firstItem())
                @foreach($users as $user)
                    <tr>
                        <td>{{$num}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->role->name}}</td>
                        <td>{{$user->language->name}}</td>
                        <td>{{$user->active?'Active':'Not Active'}}</td>
                        <td>
                            <div class="options">
                                @can('edit-user')
                                    <a class="option-link edit" data-toggle="modal" href="#edit-user-modal"
                                       data-id="{{$user->id}}" data-fname="{{$user->fname}}"
                                       data-lname="{{$user->lname}}" data-lang="{{$user->language_id}}"
                                       data-email="{{$user->email}}" data-role="{{$user->role_id}}"
                                       data-active="{{$user->active}}">
                                        <i class="icon ion-edit"></i>&nbsp;
                                        <span class="link-text">@lang('language.btn_edit')</span>
                                    </a>
                                    <a class="option-link delete" data-toggle="modal"
                                       href="#reset-user-modal" data-id="{{$user->id}}">
                                        <i class="icon ion-ios-refresh-empty"></i>&nbsp;
                                        <span class="link-text">@lang('language.btn_reset')</span>
                                    </a>
                                @endcan
                                @can('delete-user')
                                    <a href="#" class="option-link delete" data-toggle="modal"
                                       data-target="#delete-user-modal" data-id="{{$user->id}}">
                                        <i class="icon ion-android-delete"></i>&nbsp;
                                        <span class="link-text">@lang('language.btn_delete')</span>
                                    </a>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @php($num++)
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-11 col-md-10 col-lg-7 offset-1 offset-md-1 offset-lg-3">
            <nav>
                {{$users->links()}}
            </nav>
        </div>
    </div>
@stop
@section('modal')
    @can('add-user')
        <div class="modal fade" role="dialog" tabindex="-1" id="add-user-modal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="icon ion-plus"></i>&nbsp;@lang('language.users.add')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{route('user.add')}}">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="firstName">@lang('language.users.first_name'):</label>
                                <input class="form-control form-control-sm" type="text" placeholder="@lang('language.users.first_name')"
                                       id="firstName" name="first_name" required>
                            </div>
                            <div class="form-group">
                                <label for="lastName">@lang('language.users.last_name'):</label>
                                <input class="form-control form-control-sm" type="text" placeholder="@lang('language.users.last_name')"
                                       id="lastName" name="last_name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">@lang('language.users.email'):</label>
                                <input class="form-control form-control-sm" type="email" placeholder="@lang('language.users.email_holder')"
                                       id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="language">@lang('language.users.prefer_language'):</label>
                                <select class="custom-select custom-select-sm" name="language" id="language">
                                    @foreach($languages as $lang)
                                        <option value="{{$lang->id}}">{{$lang->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="role">@lang('language.users.role'):</label>
                                <select class="custom-select custom-select-sm" name="role" id="role">
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>@lang('language.users.status'):</label>
                                <div class="custom-control custom-switch">
                                    <input class="custom-control-input" type="checkbox" id="active" name="active">
                                    <label class="custom-control-label" for="active">@lang('active')</label>
                                </div>
                            </div>
                            <div class="float-right">
                                <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">@lang('language.close')
                                </button>
                                <button class="btn btn-primary btn-sm custom-btn" type="submit">@lang('language.users.add')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endcan
    @can('edit-user')
        <div class="modal fade" role="dialog" tabindex="-1" id="edit-user-modal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="icon ion-edit"></i>&nbsp;@lang('language.users.edit')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                <label for="editFirstName">@lang('language.users.first_name'):</label>
                                <input class="form-control form-control-sm" type="text" placeholder="@lang('language.users.first_name')"
                                       id="editFirstName" name="first_name" required>
                            </div>
                            <div class="form-group">
                                <label for="editLastName">@lang('language.users.last_name'):</label>
                                <input class="form-control form-control-sm" type="text" placeholder="@lang('language.users.last_name')"
                                       id="editLastName" name="last_name" required>
                            </div>
                            <div class="form-group">
                                <label for="editEmail">@lang('language.users.email'):</label>
                                <input class="form-control form-control-sm" type="email" placeholder="@lang('language.users.email_holder')"
                                       id="editEmail" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="language">@lang('language.users.language'):</label>
                                <select class="custom-select custom-select-sm" name="language" id="language">
                                    @foreach($languages as $lang)
                                        <option value="{{$lang->id}}">{{$lang->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="editRole">@lang('language.users.role'):</label>
                                <select class="custom-select custom-select-sm" name="role" id="editRole">
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>@lang('language.users.status'):</label>
                                <div class="custom-control custom-switch">
                                    <input class="custom-control-input" type="checkbox" id="editActive" name="active">
                                    <label class="custom-control-label" for="editActive">@lang('language.users.active')</label>
                                </div>
                            </div>
                            <div class="float-right">
                                <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">@lang('language.close')
                                </button>
                                <button class="btn btn-primary btn-sm custom-btn" type="submit">@lang('language.confirm')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" role="dialog" tabindex="-1" id="reset-user-modal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="icon ion-ios-refresh-empty"></i>&nbsp;@lang('language.users.reset_password')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="PUT">
                            <p>@lang('language.users.reset_password_message')</p>
                            <div class="float-right">
                                <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">@lang('close')
                                </button>
                                <button class="btn btn-primary btn-sm custom-btn" type="submit">@lang('language.btn_reset')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endcan
    @can('delete-user')
        <div class="modal fade" role="dialog" tabindex="-1" id="delete-user-modal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="icon ion-android-delete"></i>&nbsp;@lang('language.users.delete')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <p>@lang('language.users.delete_message')</p>
                            <div class="float-right">
                                <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">@lang('close')
                                </button>
                                <button class="btn btn-primary btn-sm custom-btn" type="submit">@lang('language.confirm')</button>
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
            @can('edit-user')
            //edit user
            $('#edit-user-modal').on('show.bs.modal', function (e) {
                let id = $(e.relatedTarget).data('id');
                let fname = $(e.relatedTarget).data('fname');
                let lname = $(e.relatedTarget).data('lname');
                let email = $(e.relatedTarget).data('email');
                let role = $(e.relatedTarget).data('role');
                let lang = $(e.relatedTarget).data('lang');
                let active = $(e.relatedTarget).data('active') == 1;
                let form = $(this).find('form');
                let action = '{{route('user.update','')}}/' + id;
                form.attr('action', action);
                form.find("input[name='first_name']").val(fname);
                form.find("input[name='last_name']").val(lname);
                form.find("input[name='email']").val(email);
                form.find("select[name='role']").val(role);
                form.find("select[name='language']").val(lang);
                form.find("input[name='active']").attr('checked', active);
            });
            //reset user
            $('#reset-user-modal').on('show.bs.modal', function (e) {
                let id = $(e.relatedTarget).data('id');
                let form = $(this).find('form');
                let action = '{{route('user.reset','')}}/' + id;
                form.attr('action', action);
            });
            @endcan
            @can('delete-user')
            //delete user
            $('#delete-user-modal').on('show.bs.modal', function (e) {
                let id = $(e.relatedTarget).data('id');
                let form = $(this).find('form');
                let action = '{{route('user.delete','')}}/' + id;
                form.attr('action', action);
            });
            @endcan
        });
    </script>
@stop
