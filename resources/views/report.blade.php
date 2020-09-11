@extends('layout.app')
@section('title')
    Report
@stop
@section('report')
    active
@stop
@section('content')
    <div class="container mt-3">
        <h3 class="mt-1"><i class="fa fa-pie-chart value"></i>&nbsp;@lang('language.report.title')</h3>
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
    <div class="row mt-3">
        <div class="col-6 col-xl-5 offset-xl-1">
            <ul class="nav nav-pills">
                <li class="mr-1"><a class="btn btn-primary btn-sm custom-btn" data-toggle="modal" href="#income-statement-modal">@lang('language.report.income_statement')</a>
                </li>
                <li class="mr-1"><a class="btn btn-primary btn-sm custom-btn" data-toggle="pill" href="#user-roles">@lang('language.report.cash_flow')</a>
                </li>
            </ul>

            <div class="tab-content mt-2">
                <div id="user-roles" class="tab-pane fade in">
                </div>
            </div>
        </div>
    </div>
@stop
@section('modal')
    <div class="modal fade" role="dialog" tabindex="-1" id="income-statement-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-filter"></i>&nbsp;@lang('language.report.period')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form method="GET" action="{{route('report.income.statement')}}">
                        @csrf
                        <div class="form-group">
                            <label for="from">@lang('language.from')</label>
                            <input id="from" class="form-control form-control-sm" type="date" name="from" max="{{\Carbon\Carbon::now()->format('Y-m-d')}}" required>
                        </div>
                        <div class="form-group">
                            <label for="to">@lang('language.to')</label>
                            <input id="to" class="form-control form-control-sm" type="date" name="to" min="{{\Carbon\Carbon::now()->format('Y-m-d')}}" required>
                        </div>
                        <div class="text-right mt-2">
                            <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">@lang('language.close')
                            </button>
                            <button class="btn btn-primary btn-sm custom-btn" type="submit" formtarget="_blank">@lang('language.submit')</button>
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

        });
    </script>
@stop
