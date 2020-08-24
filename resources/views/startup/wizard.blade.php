<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{env('APP_NAME')}} | Setup</title>
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/fonts/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/Navigation-with-Button.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
</head>
<body>

<div class="startup-wizard">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="fade-right">
                    <img src="{{asset('assets/img/startup-image.png')}}" alt="" width="500px">
                </div>
            </div>
            <div class="col-md-6 d-flex flex-column justify-content-center align-items-center order-md-0">
                <h2 class="text-light text-center mb-2">Welcome To Sales Management System</h2>
                <button type="button" data-toggle="modal" data-target="#get-started-modal"
                        class="btn btn-primary custom-btn m-3 shaking-btn">Get Started <span
                        class="fa fa-arrow-right"></span></button>
                <p class="text-light">Thanks for using Our Product</p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade {{$errors->any()?'show':''}}" role="dialog" tabindex="-1" id="get-started-modal"
     data-backdrop="static" style="{{$errors->any()?'display:block':''}}">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="icon ion-person"></i>&nbsp;System Manager</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('startup.new.user')}}">
                    @csrf
                    <ul>
                        @foreach($errors->all() as $error)
                            <li><small class="text-danger">{{$error}}</small></li>
                        @endforeach
                    </ul>
                    <div class="form-group">
                        <label for="firstName">First Name:</label>
                        <input class="form-control form-control-sm" type="text" placeholder="first name"
                               id="firstName" name="first_name" required>
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name:</label>
                        <input class="form-control form-control-sm" type="text" placeholder="last name"
                               id="lastName" name="last_name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input class="form-control form-control-sm" type="email" placeholder="email@email.com"
                               id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="language">Language:</label>
                        <select class="form-control form-control-sm"
                                id="language" name="language" required>
                            @foreach($languages as $lang)
                                <option value="{{$lang->id}}">{{$lang->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input class="form-control form-control-sm" type="password" placeholder="password"
                               id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password:</label>
                        <input class="form-control form-control-sm" type="password" placeholder="password"
                               id="confirm_password" name="confirm_password" required>
                    </div>
                    <div class="float-right">
                        <button class="btn btn-light mr-2" type="button" data-dismiss="modal">Close
                        </button>
                        <button class="btn btn-primary custom-btn" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
@yield('script')
</body>
</html>
