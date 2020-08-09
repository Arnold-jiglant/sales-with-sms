@extends('layout.app')
@section('title')
    Inventories
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
                <p>Total {{$inventories->total()}} showing {{$inventories->firstItem()}}
                    -{{$inventories->lastItem()}}</p>
            </div>
            <div class="col order-sm-1">
                @can('ad-inventory')
                    <div class="text-right">
                        <a class="btn btn-primary btn-sm custom-btn" role="button" href="{{route('inventory.add')}}">
                            <i class="icon ion-android-add"></i>Add Inventory</a>
                    </div>
                @endcan
            </div>
        </div>
        <div class="table-responsive table-bordered text-center" id="products-table">
            <table class="table table-bordered table-hover table-sm">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Issued Date</th>
                    <th>Total Cost</th>
                    <th>Expecting Amount</th>
                    <th>Current Sales</th>
                    <th>Sales Progress</th>
                    <th>Issuer</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if($inventories->count()>0)
                    @php($num=$inventories->firstItem())
                    @foreach($inventories as $inventory)
                        <tr>
                            <td>{{$num}}</td>
                            <td>{{$inventory->created_at->format('D d M Y')}}</td>
                            <td>{{number_format($inventory->totalCost,2)}}  </td>
                            <td>{{number_format($inventory->expectedAmount,2)}}</td>
                            <td>{{number_format($inventory->totalSales,2)}}</td>
                            <td>
                                @if($inventory->finished)
                                    <span class="text-success font-weight-bold">complete</span>
                                @else
                                    {{$inventory->progress}}%
                                @endif
                                <div class="progress" style="height: 10px">
                                    <div
                                        class="progress-bar progress-bar-striped progress-bar-animated {{$inventory->finished?'bg-success':''}}"
                                        aria-valuenow="{{$inventory->progress}}"
                                        aria-valuemin="0" aria-valuemax="100"
                                        style="width: {{$inventory->progress}}%;">
                                    </div>
                                </div>
                            </td>
                            <td>{{$inventory->user->name}}</td>
                            <td>
                                <div class="options">
                                    <a href="{{route('inventory.view',$inventory->id)}}" class="option-link edit">
                                        <i class="icon ion-eye"></i>&nbsp;
                                        <span class="link-text">view</span>
                                    </a>
                                    <a href="#" class="option-link delete" data-toggle="modal"
                                       data-target="#delete-expense-modal">
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
                        <td colspan="7">No Inventory added Yet</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-11 col-md-10 col-lg-7 offset-1 offset-md-1 offset-lg-3">
            <nav>
                {{$inventories->links()}}
            </nav>
        </div>
    </div>
@stop
@section('modal')
    @can('delete-inventory')
        <div class="modal fade" role="dialog" tabindex="-1" id="delete-expense-modal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="icon ion-android-delete"></i>&nbsp;Delete Inventory</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <p>Are you sure&nbsp;want to delete this Inventory?</p>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-light btn-sm" type="button" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-sm custom-btn" type="button">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@stop
