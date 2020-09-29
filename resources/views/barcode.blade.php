<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{env('APP_NAME')}} Barcode</title>
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/fonts/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/Navigation-with-Button.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">

    <style>
        @media print{
            #header{display: none;}
        }
    </style>
</head>
<body>
<div class="p-1">
    <div class="container">
        <div id="header">
            <div class="row mt-3">
                <div class="col">
                    <h3 class="text-center">{{$name}}</h3>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <div class="text-right">
                        <button class="btn btn-primary custom-btn" onclick="window.print()"> <span class="ion ion-printer"></span> Print</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="barcodes" class="d-flex flex-wrap">
        @for($i=0;$i<$count;$i++)
            <div class="item mr-3 mb-5">
                @php
                    echo $barcode;
                @endphp
            </div>
        @endfor
    </div>
</div>
</body>
</html>
