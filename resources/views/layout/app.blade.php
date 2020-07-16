<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{env('APP_NAME')}} |@yield('title')</title>
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/fonts/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/Navigation-with-Button.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
</head>
<body>
<section id="side-menu">
    <div id="logo-container"></div>
    <ul class="menu">
        <li class="menu-item"><a href="#"><i class="fa fa-dashboard icon mr-3"></i><span
                    class="text">Dashboard</span></a></li>
        <li class="menu-item active"><a href="#"><i class="fa fa-list icon mr-3"></i><span class="text">Products</span></a>
        </li>
        <li class="menu-item"><a href="#"><i class="fa fa-shopping-cart icon mr-3"></i><span
                    class="text">Sale</span></a></li>
        <li class="menu-item"><a href="#"><i class="fa fa-users icon mr-3"></i><span class="text">Customers</span></a>
        </li>
        <li class="menu-item"><a href="#"><i class="fa fa-home icon mr-3"></i><span class="text">Inventory</span></a>
        </li>
        <li class="menu-item"><a href="#"><i class="fa fa-dollar icon mr-3"></i><span class="text">Expenses</span></a>
        </li>
        <li class="menu-item"><a href="#"><i class="fa fa-user icon mr-3"></i><span class="text">Users</span></a></li>
        <li class="menu-item"><a href="#"><i class="fa fa-area-chart icon mr-3"></i><span class="text">Report</span></a>
        </li>
        <li class="menu-item"><a href="{{route('configure')}}"><i class="fa fa-gears icon mr-3"></i><span class="text">Configure</span></a>
        </li>
        <li class="menu-item"><a href="{{route('logout')}}"><i class="icon ion-power icon mr-3"></i><span class="text">Log Out</span></a>
        </li>
    </ul>
</section>
<section id="main">
    <nav class="navbar navbar-light navbar-expand-md" id="navbar">
        <div class="container"><a class="navbar-brand" href="#">Company Name</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span
                    class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse"
                 id="navcol-1">
                <ul class="nav navbar-nav mr-auto">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#">Dashboard</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#">Products</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#">Sale</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#">Customers</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#">Inventory</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#">Expenses</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#">Users</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#">Report</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="{{route('configure')}}">Configure</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="{{route('logout')}}"><i
                                class="fa fa-power-off mr-2"></i><span>Log Out</span></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="row">
        <div class="col">
            <div class="dropdown float-right m-3"><button class="btn btn-light btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false" type="button">{{auth()->user()->name}}</button>
                <div role="menu" class="dropdown-menu dropdown-menu-right"><a role="presentation" href="#change-password-modal" class="dropdown-item" data-toggle="modal"><i class="icon ion-locked"></i>  Change Password</a></div>
            </div>
        </div>
    </div>
    @yield('content')
    @yield('modal')
    <div role="dialog" tabindex="-1" class="modal fade" id="change-password-modal" data-backdrop="static">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon ion-locked"></i> Change Password</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                <div class="modal-body">
                    <form id="change-password-form" class="pt-3 pb-3 mb-3">
                        <div class="form-group"><label>New Password</label><input type="password" name="password" class="form-control form-control-sm" /></div>
                        <div class="form-group"><label>Confirm Password</label><input type="password" name="confirm_password" class="form-control form-control-sm" /></div>
                        <div class="float-right m-4"><button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">Close</button><button class="btn btn-primary btn-sm custom-btn" type="button">Confirm</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div></section>
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/script.js')}}"></script>
@yield('script')
</body>
</html>
