@extends('layout.app')
@section('title')
    Dashboard
@stop
@section('dashboard')
    active
@stop
@section('content')
    <div class="container mt-3">
        <div class="container-fluid">
            <div class="d-sm-flex justify-content-between align-items-center mb-4">
                <h3 class="text-dark mb-0">Dashboard</h3>
                <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="#">
                    <i class="fa fa-download fa-sm text-white-50"></i>&nbsp;Generate Report</a>
            </div>
            <div class="row">
                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="card shadow border-left-primary py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col mr-2">
                                    <div class="text-uppercase text-primary font-weight-bold text-xs mb-1">
                                        <span>Today Sales</span>
                                    </div>
                                    <div class="text-dark font-weight-bold h5 mb-0">
                                        <span>{{number_format($todaySales,2)}}</span></div>
                                </div>
                                <div class="col-auto"><i class="fa fa-calendar fa-2x text-gray-300"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="card shadow border-left-success py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col mr-2">
                                    <div class="text-uppercase text-success font-weight-bold text-xs mb-1">
                                        <span>Last Month</span>
                                    </div>
                                    <div class="text-dark font-weight-bold h5 mb-0">
                                        <span>{{number_format($lastMonthSales,2)}}</span></div>
                                </div>
                                <div class="col-auto"><i class="fa fa-dollar fa-2x text-gray-300"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="card shadow border-left-info py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col mr-2">
                                    <div class="text-uppercase text-info font-weight-bold text-xs mb-1">
                                        <span>Sales Progress</span></div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="text-dark font-weight-bold h5 mb-0 mr-3"><span>{{$salesProgress}}%</span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-info" aria-valuenow="50" aria-valuemin="0"
                                                     aria-valuemax="100" style="width: {{$salesProgress}}%;"><span
                                                        class="sr-only">{{$salesProgress}}%</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto"><i class="fa fa-list fa-2x text-gray-300"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="card shadow border-left-danger py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col mr-2">
                                    <div class="text-uppercase text-danger font-weight-bold text-xs mb-1">
                                        <span>Pending Debts</span>
                                    </div>
                                    <div class="text-dark font-weight-bold h5 mb-0">
                                        <span>{{number_format($pendingDebts,2)}}</span></div>
                                </div>
                                <div class="col-auto"><i class="fa fa-money fa-2x text-gray-300"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7 col-xl-8">
                    <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="text-primary font-weight-bold m-0">Daily Sales Overview</h6>
                            <div class="dropdown no-arrow">
                                <button class="btn btn-link btn-sm dropdown-toggle" data-toggle="dropdown"
                                        aria-expanded="false" type="button">
                                    <i class="fa fa-ellipsis-v text-gray-400"></i>
                                </button>
                                <div class="dropdown-menu shadow dropdown-menu-right animated--fade-in" role="menu">
                                    <a class="dropdown-item" role="presentation" href="#">&nbsp;Daily</a>
                                    <a class="dropdown-item" role="presentation" href="#">&nbsp;Weekly</a>
                                    <a class="dropdown-item" role="presentation" href="#">&nbsp;Monthly</a>
                                    <a class="dropdown-item" role="presentation" href="#">&nbsp;Yearly</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-area">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <canvas
                                    data-bs-chart="{&quot;type&quot;:&quot;line&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Jan&quot;,&quot;Feb&quot;,&quot;Mar&quot;,&quot;Apr&quot;,&quot;May&quot;,&quot;Jun&quot;,&quot;Jul&quot;,&quot;Aug&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;Earnings&quot;,&quot;fill&quot;:true,&quot;data&quot;:[&quot;0&quot;,&quot;10000&quot;,&quot;5000&quot;,&quot;15000&quot;,&quot;10000&quot;,&quot;20000&quot;,&quot;15000&quot;,&quot;25000&quot;],&quot;backgroundColor&quot;:&quot;rgba(78, 115, 223, 0.05)&quot;,&quot;borderColor&quot;:&quot;rgba(78, 115, 223, 1)&quot;}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:false},&quot;title&quot;:{},&quot;scales&quot;:{&quot;xAxes&quot;:[{&quot;gridLines&quot;:{&quot;color&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;zeroLineColor&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;drawBorder&quot;:false,&quot;drawTicks&quot;:false,&quot;borderDash&quot;:[&quot;2&quot;],&quot;zeroLineBorderDash&quot;:[&quot;2&quot;],&quot;drawOnChartArea&quot;:false},&quot;ticks&quot;:{&quot;fontColor&quot;:&quot;#858796&quot;,&quot;padding&quot;:20}}],&quot;yAxes&quot;:[{&quot;gridLines&quot;:{&quot;color&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;zeroLineColor&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;drawBorder&quot;:false,&quot;drawTicks&quot;:false,&quot;borderDash&quot;:[&quot;2&quot;],&quot;zeroLineBorderDash&quot;:[&quot;2&quot;]},&quot;ticks&quot;:{&quot;fontColor&quot;:&quot;#858796&quot;,&quot;padding&quot;:20}}]}}}"
                                    style="display: block; width: 611px; height: 320px;" width="611" height="320"
                                    class="chartjs-render-monitor"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-xl-4">
                    <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="text-primary font-weight-bold m-0">Revenue Sources</h6>
                            <div class="dropdown no-arrow">
                                <button class="btn btn-link btn-sm dropdown-toggle" data-toggle="dropdown"
                                        aria-expanded="false" type="button">
                                    <i class="fa fa-ellipsis-v text-gray-400"></i>
                                </button>
                                <div class="dropdown-menu shadow dropdown-menu-right animated--fade-in" role="menu">
                                    <p class="text-center dropdown-header">dropdown header:</p>
                                    <a class="dropdown-item" role="presentation" href="#">&nbsp;Action</a>
                                    <a class="dropdown-item" role="presentation" href="#">&nbsp;Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" role="presentation" href="#">&nbsp;Something else here</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-area">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <canvas
                                    data-bs-chart="{&quot;type&quot;:&quot;doughnut&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Direct&quot;,&quot;Social&quot;,&quot;Referral&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;&quot;,&quot;backgroundColor&quot;:[&quot;#4e73df&quot;,&quot;#1cc88a&quot;,&quot;#36b9cc&quot;],&quot;borderColor&quot;:[&quot;#ffffff&quot;,&quot;#ffffff&quot;,&quot;#ffffff&quot;],&quot;data&quot;:[&quot;50&quot;,&quot;30&quot;,&quot;15&quot;]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:false},&quot;title&quot;:{}}}"
                                    width="272" height="320" class="chartjs-render-monitor"
                                    style="display: block; width: 272px; height: 320px;"></canvas>
                            </div>
                            <div class="text-center small mt-4"><span class="mr-2"><i
                                        class="fa fa-circle text-primary"></i>&nbsp;Direct</span><span class="mr-2"><i
                                        class="fa fa-circle text-success"></i>&nbsp;Social</span><span class="mr-2"><i
                                        class="fa fa-circle text-info"></i>&nbsp;Refferal</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="text-primary font-weight-bold m-0">Latest Sales</h6>
                        </div>
                        <div class="card-body">
                            @if($latestSales->count()>0)
                                <h7 class="font-weight-bold">&nbsp;&nbsp;&nbsp;Product<span
                                        class="float-right text-info">Amount</span>
                                </h7>
                                <div class="dropdown-divider"></div>
                                @php($num=1)
                                @foreach($latestSales as $sale)
                                    <p>{{$num}}.&nbsp;&nbsp;&nbsp;{{$sale->productName}}<span
                                            class="float-right text-info">{{number_format($sale->payedAmount,2)}}</span>
                                    </p>
                                    <div class="dropdown-divider"></div>
                                    @php($num++)
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="text-primary font-weight-bold m-0">Stock Level</h6>
                        </div>
                        <div class="card-body">
                            @if($productStatus->count()>0)
                                @foreach($productStatus as $product)
                                    <p class="mb-1">{{$product->name}}<span class="float-right">{{$product->stockLevel}}%</span>
                                    </p>
                                    <div class="progress mb-2" style="height: 8px">
                                        <div class="progress-bar {{$product->stockLevelClass}}" aria-valuenow="20"
                                             aria-valuemin="0"
                                             aria-valuemax="100" style="width: {{$product->stockLevel}}%;"><span
                                                class="sr-only">{{$product->stockLevel}}%</span>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('modal')
@stop

@section('script')
    <script src="{{asset('assets/js/Chart.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('[data-bs-chart]').each(function (index, elem) {
                this.chart = new Chart($(elem), $(elem).data('bs-chart'));
            });
        });
    </script>
@stop
