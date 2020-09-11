@extends('layout.app')
@section('title')
    Users
@stop
@section('income')
    active
@stop
@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a><span>@lang('language.dashboard')</span></a></li>
                    <li class="breadcrumb-item"><a><span>@lang('language.extra_income.title')</span></a></li>
                </ol>
            </div>
        </div>
        <h3 class="mt-1">@lang('language.extra_income.title')
            @if(strlen($title)>0)
                / <small class="text-muted">{{$title}}</small>
            @endif
        </h3>
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
                <p>@lang('language.total') {{$incomes->total()}} @lang('language.showing') {{$incomes->firstItem()}}
                    -{{$incomes->lastItem()}}</p>
            </div>
            <div class="col order-sm-1">
                <div class="text-right">
                    <div class="btn-group" role="group">
                        <div class="dropdown btn-group d-inline-block" role="group">
                            <button class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"
                                    aria-expanded="false" type="button">@lang('language.sales.btn_filter')
                            </button>
                            <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item" role="presentation"
                                   href="{{route('incomes')}}">@lang('language.all')</a>
                                @foreach($incomeTypes as $type)
                                    <a class="dropdown-item" role="presentation"
                                       href="{{route('incomes',['type'=>$type])}}">{{$type->name}}</a>
                                @endforeach
                            </div>
                        </div>
                        @can('add-income')
                            <button class="btn btn-primary btn-sm custom-btn ml-1" type="button" data-toggle="modal"
                                    data-target="#add-income-modal"><i
                                    class="icon ion-android-add"></i>@lang('language.extra_income.add')
                            </button>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive table-bordered text-center" id="products-table">
            <table class="table table-bordered table-hover table-sm">
                <thead>
                <tr>
                    <th>#</th>
                    <th>@lang('language.type')</th>
                    <th>@lang('language.amount')</th>
                    <th>@lang('language.description')</th>
                    <th>@lang('language.date')</th>
                    <th>@lang('language.issuer')</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if($incomes->count()>0)
                    @php($num=$incomes->firstItem())
                    @foreach($incomes as $income)
                        <tr>
                            <td>{{$num}}</td>
                            <td>{{$income->type->name}}</td>
                            <td>{{number_format($income->amount)}}/=</td>
                            <td>{{$income->description}}</td>
                            <td>{{$income->created_at->format('D d M Y')}}</td>
                            <td>{{$income->user->name}}</td>
                            <td>
                                <div class="options">
                                    @can('edit-income')
                                        <a href="#" class="option-link edit" data-toggle="modal"
                                           data-target="#edit-income-modal" data-id="{{$income->id}}"
                                           data-type="{{$income->income_type_id}}"
                                           data-amount="{{$income->amount}}" data-desc="{{$income->description}}">
                                            <i class="icon ion-edit"></i>&nbsp;
                                            <span class="link-text">@lang('language.btn_edit')</span>
                                        </a>
                                    @endcan
                                    @can('delete-income')
                                        <a href="#" class="option-link delete" data-toggle="modal"
                                           data-target="#delete-income-modal" data-id="{{$income->id}}">
                                            <i class="icon ion-android-delete"></i>&nbsp;
                                            <span class="link-text">@lang('language.btn_delete')</span>
                                        </a>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @php($num++)
                    @endforeach
                @else
                    <tr>
                        <td colspan="7">@lang('language.extra_income.no_income')</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-11 col-md-10 col-lg-7 offset-1 offset-md-1 offset-lg-3">
            <nav>
                {{$incomes->links()}}
            </nav>
        </div>
    </div>
@stop
@section('modal')
    @can('add-income')
        <div class="modal fade" role="dialog" tabindex="-1" id="add-income-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="icon ion-plus"></i>&nbsp;@lang('language.extra_income.add')
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('income.add')}}" method="POST">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="incomeType">@lang('language.extra_income.type'):</label>
                                <select class="custom-select custom-select-sm" id="incomeType" name="incomeType"
                                        required>
                                    @foreach($incomeTypes as $type)
                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select></div>
                            <div
                                class="form-group" data-toggle="popover"
                                data-content="@lang('language.extra_income.amount_message')"
                                data-trigger="focus" data-placement="right">
                                <label for="editAmount">@lang('language.amount')</label>
                                <input class="form-control form-control-sm" type="number"
                                       placeholder="@lang('language.amount')"
                                       min="1"
                                       id="editAmount" name="amount" required>
                            </div>
                            <div class="form-group" data-toggle="popover"
                                 data-content="@lang('language.extra_income.description')"
                                 data-trigger="focus"
                                 data-placement="right">
                                <label for="incomeDesc">@lang('language.description') (@lang('language.optional')
                                    )</label>
                                <textarea class="form-control form-control-sm" rows="3" placeholder="@lang('language.description')"
                                          id="incomeDesc" maxlength="170" name="description"></textarea>
                            </div>
                            <div class="float-right">
                                <button class="btn btn-light btn-sm mr-2" type="button"
                                        data-dismiss="modal">@lang('language.close')
                                </button>
                                <button class="btn btn-primary btn-sm custom-btn"
                                        type="submit">@lang('language.confirm')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endcan
    @can('edit-income')
        <div class="modal fade" role="dialog" tabindex="-1" id="edit-income-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="icon ion-edit"></i>&nbsp;@lang('language.extra_income.edit')
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                <label for="incomeType">@lang('language.extra_income.type'):</label>
                                <select class="custom-select custom-select-sm" id="incomeType" name="incomeType">
                                    @foreach($incomeTypes as $type)
                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select></div>
                            <div
                                class="form-group" data-toggle="popover"
                                data-content="@lang('language.extra_income.amount_message')"
                                data-trigger="focus" data-placement="right">
                                <label for="editAmount">@lang('language.amount')</label>
                                <input class="form-control form-control-sm" type="number"
                                       placeholder="@lang('language.amount')"
                                       min="1"
                                       id="editAmount" name="amount" required>
                            </div>
                            <div class="form-group" data-toggle="popover"
                                 data-content="@lang('language.extra_income.description')"
                                 data-trigger="focus"
                                 data-placement="right">
                                <label for="incomeDesc">@lang('language.description') (@lang('language.optional')
                                    )</label>
                                <textarea class="form-control form-control-sm" rows="3" placeholder="@lang('language.description')"
                                          id="incomeDesc" maxlength="170" name="description"></textarea>
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
    @endcan
    @can('delete-income')
        <div class="modal fade" role="dialog" tabindex="-1" id="delete-income-modal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="icon ion-android-delete"></i>&nbsp;@lang('language.extra_income.delete')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <p>@lang('language.extra_income.delete_message')</p>
                            <div class="float-right">
                                <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">@lang('language.close')
                                </button>
                                <button class="btn btn-primary btn-sm custom-btn" type="submit">@lang('language.btn_delete')</button>
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
            @can('edit-income')
            //edit income
            $('#edit-income-modal').on('show.bs.modal', function (e) {
                let id = $(e.relatedTarget).data('id');
                let type = $(e.relatedTarget).data('type');
                let amount = $(e.relatedTarget).data('amount');
                let desc = $(e.relatedTarget).data('desc');
                let form = $(this).find('form');
                let action = '{{route('income.update','')}}/' + id;
                form.attr('action', action);
                form.find("select[name='incomeType']").val(type);
                form.find("input[name='amount']").val(amount);
                form.find("textarea[name='description']").val(desc);
            });
            @endcan

            @can('delete-income')
            //delete income
            $('#delete-income-modal').on('show.bs.modal', function (e) {
                let id = $(e.relatedTarget).data('id');
                let form = $(this).find('form');
                let action = '{{route('income.delete','')}}/' + id;
                form.attr('action', action);
            });
            @endcan
        });
    </script>
@stop
