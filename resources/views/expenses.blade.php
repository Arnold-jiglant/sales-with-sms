@extends('layout.app')
@section('title')
    Users
@stop
@section('expense')
    active
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
        <h3 class="mt-1">Expenses
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
                <p>Total {{$expenses->total()}} showing {{$expenses->firstItem()}}-{{$expenses->lastItem()}}</p>
            </div>
            <div class="col order-sm-1">
                <div class="text-right">
                    <div class="btn-group" role="group">
                        <div class="dropdown btn-group d-inline-block" role="group">
                            <button class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"
                                    aria-expanded="false" type="button">Filter
                            </button>
                            <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item" role="presentation" href="{{route('expenses')}}">All</a>
                                @foreach($expenseTypes as $type)
                                    <a class="dropdown-item" role="presentation"
                                       href="{{route('expenses',['type'=>$type])}}">{{$type->name}}</a>
                                @endforeach
                            </div>
                        </div>
                        @can('add-expense')
                            <button class="btn btn-primary btn-sm custom-btn ml-1" type="button" data-toggle="modal"
                                    data-target="#add-expense-modal"><i class="icon ion-android-add"></i>Add Expense
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
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Issuer</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if($expenses->count()>0)
                    @php($num=$expenses->firstItem())
                    @foreach($expenses as $expense)
                        <tr>
                            <td>{{$num}}</td>
                            <td>{{$expense->type->name}}</td>
                            <td>{{$expense->amount}}</td>
                            <td>{{$expense->description}}</td>
                            <td>{{$expense->created_at->format('D d M Y')}}</td>
                            <td>{{$expense->user->name}}</td>
                            <td>
                                <div class="options">
                                    <a href="#" class="option-link edit" data-toggle="modal"
                                       data-target="#edit-expense-modal" data-id="{{$expense->id}}"
                                       data-type="{{$expense->expense_type_id}}"
                                       data-amount="{{$expense->amount}}" data-desc="{{$expense->description}}">
                                        <i class="icon ion-edit"></i>&nbsp;
                                        <span class="link-text">edit</span>
                                    </a>
                                    <a href="#" class="option-link delete" data-toggle="modal"
                                       data-target="#delete-expense-modal" data-id="{{$expense->id}}">
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
                        <td colspan="7">No Expenses made yet</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-11 col-md-10 col-lg-7 offset-1 offset-md-1 offset-lg-3">
            <nav>
                {{$expenses->links()}}
            </nav>
        </div>
    </div>
@stop
@section('modal')
    @can('add-expense')
        <div class="modal fade" role="dialog" tabindex="-1" id="add-expense-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="icon ion-plus"></i>&nbsp;Add Expense</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('expense.add')}}" method="POST">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="expenseType">Expense Type:</label>
                                <select class="custom-select custom-select-sm" id="expenseType" name="expenseType">
                                    @foreach($expenseTypes as $type)
                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select></div>
                            <div
                                class="form-group" data-toggle="popover" data-content="Total amount expended"
                                data-trigger="focus" data-placement="right">
                                <label for="editAmount">Amount</label>
                                <input class="form-control form-control-sm" type="number" placeholder="Amount spent"
                                       min="1"
                                       id="editAmount" name="amount" required>
                            </div>
                            <div class="form-group" data-toggle="popover" data-content="Expense description"
                                 data-trigger="focus"
                                 data-placement="right">
                                <label for="expenseDesc">Description(optional)</label>
                                <textarea class="form-control form-control-sm" rows="3" placeholder="Description"
                                          id="expenseDesc" maxlength="170" name="description"></textarea>
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
    @can('edit-expense')
        <div class="modal fade" role="dialog" tabindex="-1" id="edit-expense-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="icon ion-edit"></i>&nbsp;Edit Expense</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                <label for="expenseType">Expense Type:</label>
                                <select class="custom-select custom-select-sm" id="expenseType" name="expenseType">
                                    @foreach($expenseTypes as $type)
                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select></div>
                            <div
                                class="form-group" data-toggle="popover" data-content="Total amount expended"
                                data-trigger="focus" data-placement="right">
                                <label for="editAmount">Amount</label>
                                <input class="form-control form-control-sm" type="number" placeholder="Amount spent"
                                       min="1"
                                       id="editAmount" name="amount" required>
                            </div>
                            <div class="form-group" data-toggle="popover" data-content="Expense description"
                                 data-trigger="focus"
                                 data-placement="right">
                                <label for="expenseDesc">Description(optional)</label>
                                <textarea class="form-control form-control-sm" rows="3" placeholder="Description"
                                          id="expenseDesc" maxlength="170" name="description"></textarea>
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
    @can('delete-expense')
        <div class="modal fade" role="dialog" tabindex="-1" id="delete-expense-modal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="icon ion-android-delete"></i>&nbsp;Delete Expense</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <p>Are sure you want to delete this expense?</p>
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
            //edit expense
            $('#edit-expense-modal').on('show.bs.modal', function (e) {
                let id = $(e.relatedTarget).data('id');
                let type = $(e.relatedTarget).data('type');
                let amount = $(e.relatedTarget).data('amount');
                let desc = $(e.relatedTarget).data('desc');
                let form = $(this).find('form');
                let action = '{{route('expense.update','')}}/' + id;
                form.attr('action',action);
                form.find("select[name='expenseType']").val(type);
                form.find("input[name='amount']").val(amount);
                form.find("textarea[name='description']").val(desc);
            });
            //delete expense
            $('#delete-expense-modal').on('show.bs.modal', function (e) {
                let id = $(e.relatedTarget).data('id');
                let form = $(this).find('form');
                let action = '{{route('expense.delete','')}}/' + id;
                form.attr('action',action);
            });
        });
    </script>
@stop
