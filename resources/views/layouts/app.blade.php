<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>EDMS &middot; @yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">

    <style type="text/css">

        #welcome{
            background: gray;
            color: white;
            width:100%;
            margin:0px auto 0px;
        }
    </style>

</head>
<body>

    {{--Banner--}}
    <div class="container">

        @include('partials.banner')

        <div class="row" id="welcome"><marquee scrollamount="2">WELCOME TO EMPLOYEE DIVISION MANAGEMENT SYSTEM</marquee> </div>
    </div>
    {{-- Banner --}}

    <div class="container" id="app">

        <nav class="navbar navbar-default navbar-static-top">

            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand">
                       EDMS
                   </a>
               </div>

               <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav pull-right">

                    <!-- Authentication Links -->
                    {{--  --}}
                    @if (Auth::guest())
                    {{-- <li><a href="{{ route('login') }}">Login</a></li> --}}
                    {{-- <li><a href="{{ route('register') }}">Register</a></li> --}}
                    @else

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">

                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">

                         <li><a href="/account/change-password"><i class="fa fa-gear" aria-hidden="true"></i>&nbsp;Change password</a>
                         </li>

                         <li>
                            <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>

                </ul>
            </li>

            @endif
        </ul>

    </div>
</div>
</nav>

<div class="container">
    <div class="row">
        @if(Auth::check())
        <div class="col-sm-2">
            @include('partials.sidebar')
        </div>
        <div class="col-sm-10">
            @include('message.success')
            @include('message.error-list')

            @yield('content')
        </div>
        @else
        <div class="col-sm-12">
            @yield('content')
        </div>
        @endif
    </div>
</div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
