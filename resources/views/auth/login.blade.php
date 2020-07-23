<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{env('APP_NAME')}}|@yield('title')</title>
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/fonts/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/Navigation-with-Button.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
</head>
<body>

<div class="login-wrapper">
    <div class="col-md-6 col-lg-5 col-xl-4">
        <form id="login-form" action="{{url('login')}}" method="POST">
            {{csrf_field()}}
            <h5 class="text-center value">Login</h5>
            @if($errors->any())
                <small class="text-danger">Invalid email/Password</small>
            @endif
            <div class="form-group">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user-o"></i></span>
                    </div>
                    <input class="form-control" type="email" name="email" placeholder="email"></div>
            </div>
            <div class="form-group">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-lock"></i></span>
                    </div>
                    <input class="form-control" type="password" name="password" placeholder="password"></div>
            </div>
            <div class="text-center">
                <button class="btn btn-primary btn-sm custom-btn" type="submit">Login</button>
            </div>
        </form>
    </div>
</div>
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
@yield('script')
</body>
</html>
