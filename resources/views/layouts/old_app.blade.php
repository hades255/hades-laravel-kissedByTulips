<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'KBT') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
    $( function() {
      $( "#datepicker" ).datepicker();
    } );
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'KBT') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto" style="margin-left: 824px;">
                        <!-- Authentication Links -->
                        @guest
                            @auth
                            @if(Auth::user()->pk_roles == 1)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/superadmin') }}"><b>Home</b></a>
                            </li>
                            @endif
                            @if(Auth::user()->pk_roles == 2)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/accountadmin') }}"><b>Home</b></a>
                            </li>
                            @endif
                            @if(Auth::user()->pk_roles == 3)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/locationmanager') }}"><b>Home</b></a>
                            </li>
                            @endif
                            @if(Auth::user()->pk_roles == 4)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/customer') }}"><b>Home</b></a>
                            </li>
                            @endif
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}"><b>Login</b></a>
                            </li>
                            @if(Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}"><b>Register</b></a>
                            </li>
                            @endif
                            @endauth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/shop') }}"><b>Shop</b></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/request-a-quote') }}"><b>Request a Quote</b></a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="{{ url('/product') }}"><b>Products</b></a>
                            </li> -->

                        @else
                            <li class="nav-item">
                                    <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                      <b>Logout</b>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/shop') }}"><b>Shop</b></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/request-a-quote') }}"><b>Request a Quote</b></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/product') }}"><b>Products</b></a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="row" id="header-bar">
        @include('_header_cart')
        </div>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
