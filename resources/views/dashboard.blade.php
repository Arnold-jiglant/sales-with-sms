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
                            <h6 class="text-primary font-weight-bold m-0">{{$title}} Sales Overview</h6>
                            <div class="dropdown no-arrow">
                                <button class="btn btn-link btn-sm dropdown-toggle" data-toggle="dropdown"
                                        aria-expanded="false" type="button">
                                    <i class="fa fa-ellipsis-v text-gray-400"></i>
                                </button>
                                <div class="dropdown-menu shadow dropdown-menu-right animated--fade-in" role="menu">
                                    <a class="dropdown-item" role="presentation" href="{{route('dashboard')}}">&nbsp;Daily</a>
                                    <a class="dropdown-item" role="presentation"
                                       href="{{route('dashboard',['time'=>\App\Http\Controllers\ReportController::$MONTHLY])}}">&nbsp;Monthly</a>
                                    <a class="dropdown-item" role="presentation"
                                       href="{{route('dashboard',['time'=>\App\Http\Controllers\ReportController::$YEARLY])}}">&nbsp;Yearly</a>
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
                                <canvas id="myChart" style="display: block; width: 611px; height: 320px;" width="611"
                                        height="320" data-bs-chart="" data-labels="{{$salesOverview->keys()}}"
                                        data-data="{{$salesOverview->values()}}"
                                        class="chartjs-render-monitor"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-xl-4">
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
                            <h6 class="text-warning font-weight-bold m-0">Customer Debts</h6>
                        </div>
                        <div class="card-body">
                            @if($customerDebts->count()>0)
                                <h7 class="font-weight-bold">&nbsp;&nbsp;&nbsp;Customer<span
                                        class="float-right text-danger">Debt AMount</span>
                                </h7>
                                <div class="dropdown-divider"></div>
                                @php($num=1)
                                @foreach($customerDebts as $debt)
                                    <p>{{$num}}.&nbsp;&nbsp;&nbsp;{{$debt->customerName}}<span
                                            class="float-right text-danger">{{number_format($debt->debtAmount,2)}}</span>
                                    </p>
                                    <div class="dropdown-divider"></div>
                                    @php($num++)
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
                let labels = $(elem).data('labels');
                let data = $(elem).data('data');
                this.chart = new Chart($(elem), {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: "Amount",
                            data: data,
                            backgroundColor: [
                                'rgba(0,186,204,0.3)',
                            ],
                            borderColor: [
                                'rgba(0,186,204,0.5)',
                            ],
                            pointBackgroundColor: function (context) {
                                return 'rgba(0,186,204,0.5)';
                            },
                            pointBorderColor: function (context) {
                                return 'rgba(0,186,204,0.5)';
                            },
                            borderWidth: 2
                        }]
                    },
                    options: {
                        "scales": {
                            "xAxes": [{
                                "gridLines": {
                                    "color": "rgb(234, 236, 244)",
                                    "zeroLineColor": "rgb(234, 236, 244)",
                                    "drawBorder": false,
                                    "drawTicks": false,
                                    "borderDash": ["2"],
                                    "zeroLineBorderDash": ["2"],
                                    "drawOnChartArea": false
                                },
                                "ticks": {
                                    "fontColor": "#858796",
                                    "padding": 20,
                                }
                            }],
                            "yAxes": [{
                                "gridLines": {
                                    "color": "rgb(234, 236, 244)",
                                    "zeroLineColor": "rgb(234, 236, 244)",
                                    "drawBorder": true,
                                    "drawTicks": false,
                                    "borderDash": ["2"],
                                    "zeroLineBorderDash": ["2"]
                                }, "ticks": {
                                    "fontColor": "#858796",
                                    "padding": 20,
                                    "beginAtZero": true,
                                }
                            }]
                        },
                        "maintainAspectRatio": false,
                        "legend": {"display": false},
                        "title": {},
                    }
                });
            });
        });
    </script>
@stop
