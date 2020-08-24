<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{env('APP_NAME')}} | @yield('title')</title>
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
        @if(auth()->user()->isManager)
            <li class="menu-item @yield('dashboard')"><a href="{{route('dashboard')}}"><i
                        class="fa fa-dashboard icon mr-3"></i><span
                        class="text">{{\App\Language::term('Dashboard')}}</span></a></li>
        @endif
        @can('sell-product')
            <li class="menu-item">
                <a href="#sales" data-toggle="collapse">
                    <i class="fa fa-shopping-cart icon mr-3"></i>
                    <span class="text">{{\App\Language::term('Sale')}}</span>
                </a>
                <ul id="sales" class="collapse sub-menu">
                    <li><a href="{{route('sale')}}">{{\App\Language::term('New Sale')}}</a></li>
                    <li><a href="{{route('sale.view')}}">{{\App\Language::term('View Sales')}}</a></li>
                </ul>
            </li>
        @endcan
        @can('view-customers')
            <li class="menu-item @yield('customer')"><a href="{{route('customers')}}"><i
                        class="fa fa-users icon mr-3"></i><span
                        class="text">{{\App\Language::term('Customers')}}</span></a>
            </li>
        @endcan
        @can('view-inventory')
            <li class="menu-item @yield('product')"><a href="{{route('products')}}"><i class="fa fa-list icon mr-3"></i><span
                        class="text">{{\App\Language::term('Products')}}</span></a>
            </li>
            <li class="menu-item @yield('inventory')"><a href="{{route('inventories')}}"><i
                        class="fa fa-home icon mr-3"></i><span
                        class="text">{{\App\Language::term('Inventory')}}</span></a>
            </li>
        @endcan
        @can('view-expenses')
            <li class="menu-item @yield('expense')"><a href="{{route('expenses')}}"><i
                        class="fa fa-dollar icon mr-3"></i><span
                        class="text">{{\App\Language::term('Expenses')}}</span></a>
            </li>
        @endcan
        @can('view-users')
            <li class="menu-item @yield('user')"><a href="{{route('users')}}"><i class="fa fa-user icon mr-3"></i><span
                        class="text">{{\App\Language::term('Users')}}</span></a></li>
        @endcan
        @can('view-incomes')
            <li class="menu-item @yield('income')"><a href="{{route('incomes')}}"><i
                        class="fa fa-eur icon mr-3"></i><span
                        class="text">{{\App\Language::term('Extra Income')}}</span></a>
            </li>
        @endcan
        @can('view-report')
            <li class="menu-item @yield('report')"><a href="{{route('report')}}"><i
                        class="fa fa-area-chart icon mr-3"></i><span
                        class="text">{{\App\Language::term('Report')}}</span></a>
            </li>
        @endcan
        @if(auth()->user()->isManager)
            <li class="menu-item @yield('configure')"><a href="{{route('configure')}}"><i
                        class="fa fa-gears icon mr-3"></i><span
                        class="text">{{\App\Language::term('Configure')}}</span></a>
            </li>
        @endif
        <li class="menu-item"><a href="{{route('logout')}}"><i class="icon ion-power icon mr-3"></i><span class="text">{{\App\Language::term('Log Out')}}</span></a>
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
                    @if(auth()->user()->isManager)
                        <li class="nav-item" role="presentation"><a class="nav-link" href="{{route('dashboard')}}">Dashboard</a>
                        </li>
                    @endif
                    @can('sell-product')
                        <li class="nav-item" role="presentation">
                            <a href="#sales" data-toggle="collapse" class="nav-link">Sale</a>
                            <ul id="sales" class="collapse sub-menu">
                                <li><a href="{{route('sale')}}">New Sale</a></li>
                                <li><a href="{{route('sale.view')}}">View Sales</a></li>
                            </ul>
                        </li>
                    @endcan
                    @can('view-customers')
                        <li class="nav-item" role="presentation"><a class="nav-link" href="{{route('customers')}}">Customers</a>
                        </li>
                    @endcan
                    @can('view-inventory')
                        <li class="nav-item" role="presentation"><a class="nav-link" href="{{route('products')}}">Products</a>
                        </li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="{{route('inventories')}}">Inventory</a>
                        </li>
                    @endcan
                    @can('view-expenses')
                        <li class="nav-item" role="presentation"><a class="nav-link" href="{{route('expenses')}}">Expenses</a>
                        </li>
                    @endcan
                    @can('view-users')
                        <li class="nav-item" role="presentation"><a class="nav-link" href="{{route('users')}}">Users</a>
                        </li>
                    @endcan
                    @can('view-incomes')
                        <li class="nav-item" role="presentation"><a class="nav-link" href="{{route('incomes')}}">Extra
                                Income</a></li>
                    @endcan
                    @can('view-report')
                        <li class="nav-item" role="presentation"><a class="nav-link"
                                                                    href="{{route('report')}}">Report</a></li>
                    @endcan
                    @if(auth()->user()->isManager)
                        <li class="nav-item" role="presentation"><a class="nav-link" href="{{route('configure')}}">Configure</a>
                        </li>
                    @endif
                    <li class="nav-item" role="presentation"><a class="nav-link" href="{{route('logout')}}"><i
                                class="fa fa-power-off mr-2"></i><span>Log Out</span></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="row">
        <div class="col text-right">
            <div class="dropdown m-3">
                <button class="btn btn-light btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false"
                        type="button">{{auth()->user()->name}} (<strong>{{auth()->user()->role->name}}</strong>)
                </button>
                <div role="menu" class="dropdown-menu dropdown-menu-right">
                    <a href="#" class="dropdown-item">Language: {{auth()->user()->language->name}}</a>
                    <a role="presentation" href="#change-password-modal" class="dropdown-item" data-toggle="modal">
                        <i class="icon ion-locked"></i>  Change Password</a>
                </div>
            </div>
            @error('password')
            <div class="d-block">
                <p class="text-danger">{{$message}}</p>
            </div>
            @enderror
        </div>
    </div>
    @yield('content')
    @yield('modal')
    <div role="dialog" tabindex="-1" class="modal fade" id="change-password-modal" data-backdrop="static">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon ion-locked"></i> Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form id="change-password-form" class="pt-3 pb-3 mb-3" method="POST"
                          action="{{route('user.change.password')}}">
                        <input type="hidden" name="_method" value="PUT">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input id="password" type="password" name="password" class="form-control form-control-sm"/>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input id="confirm_password" type="password" name="confirm_password"
                                   class="form-control form-control-sm"/>
                        </div>
                        <div class="float-right m-4">
                            <button class="btn btn-light btn-sm mr-2" type="button" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary btn-sm custom-btn" type="submit">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/jquery-ui.js')}}"></script>
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/script.js')}}"></script>
@yield('script')
</body>
</html>
