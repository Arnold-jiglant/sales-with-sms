<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{env('APP_NAME')}} | Income Statement</title>
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/fonts/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/Navigation-with-Button.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
    <style>

        @media print {
            #print-btn {
                display: none;
            }

            #container div.card {
                box-shadow: none !important;
            }

            html, body {
                height: 100%;
                margin: 0 !important;
                padding: 0 !important;
                overflow: hidden;
            }
        }
    </style>
</head>
<body>
<div id="container" class="container mt-3">
    <div class="row">
        <div class="col">
            <div class="text-right">
                <button id="print-btn" type="button" class="btn btn-primary custom-btn m-3"
                        onclick="window.print()"><span
                        class="fa fa-print"></span> Print
                </button>
            </div>
        </div>
    </div>
    <div class="card shadow mt-3 mb-3">
        <div class="card-header py-3">
            <h5 class="value font-weight-bold m-0">Income Statement <small class="text-dark">{{$title}}</small></h5>
        </div>
        <div class="card-body">
            <table class="table table-borderless table-striped">
                <tbody>
                <tr>
                    <td><h5>Category</h5></td>
                    <td><h5>Amount</h5></td>
                </tr>
                <tr>
                    <td><h6>Revenue & Gains</h6></td>
                </tr>
                @foreach($revenueGains as $name=>$amount)
                    <tr>
                        <td>{{$name}}</td>
                        <td>{{number_format($amount,2)}}</td>
                    </tr>
                @endforeach
                <tr>
                    <td>Total Revenue & Gains</td>
                    <td>{{number_format($revenueGains->values()->sum(),2)}}</td>
                </tr>
                <tr>
                    <td><h6>Expenses & Losses</h6></td>
                    <td></td>
                </tr>
                @foreach($expenseLoss as $name=>$amount)
                    <tr>
                        <td>{{$name}}</td>
                        <td>{{number_format($amount,2)}}</td>
                    </tr>
                @endforeach
                <tr>
                    <td>Total Expenses & Losses</td>
                    <td>{{number_format($expenseLoss->values()->sum(),2)}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><h6>Net Income</h6></td>
                    <td><h6>{{number_format($revenueGains->values()->sum()-$expenseLoss->values()->sum(),2)}}</h6></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/jquery-ui.js')}}"></script>
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
</body>
</html>
