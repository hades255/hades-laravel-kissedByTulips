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
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
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
                            <li class="nav-item homePage">
                                <a class="nav-link" href="{{ route('login') }}?redirect=customer"><b>Login</b></a>
                            </li>
                            @if(Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link homePage" href="{{ route('register') }}?redirect=customer"><b>Register</b></a>
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

                            @if(Auth::user()->pk_roles == 4)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/customer') }}"><b>Home</b></a>
                                </li>
                            @endif


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
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="{{ url('/product') }}"><b>Products</b></a>
                            </li> -->
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


    <!-- Notify Messages RJ -->

    <style>
        .active{
          font-weight: bold;
        }
        .bg-red {
            background-color: #F44336!important;
            color: #fff!important;
        }

        .bg-green {
            background-color: #4CAF50!important;
            color: #fff!important;
        }
    </style>

    <script src="{!! asset('assets/js/bootstrap-notify.js') !!}"></script>

    <script type="text/javascript">

		@if(session()->has('message'))
			var placementFrom = "top";
			var placementAlign = "right";
			var animateEnter = '';
			var animateExit = '';
			var colorName = "{{ (session()->get('level') == 'danger') ? 'bg-red' : 'bg-green' }}";
			showNotification(colorName, "{{ session()->get('message') }}", placementFrom, placementAlign, animateEnter, animateExit);
		@endif

        function showNotification(t, e, o, a, n, s) {
            (null !== t && "" !== t) || (t = "bg-black"), (null !== e && "" !== e) || (e = "Turning standard Bootstrap alerts"), (null !== n && "" !== n) || (n = "animated fadeInDown"), (null !== s && "" !== s) || (s = "animated fadeOutUp");
            $.notify(
                { message: e },
                {
                    type: t,
                    allow_dismiss: !0,
                    newest_on_top: !0,
                    timer: 1e3,
                    placement: { from: o, align: a },
                    animate: { enter: n, exit: s },
                    template:
                    '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible {0} p-r-35" role="alert"><span data-notify="icon"></span> <span data-notify="title">{1}</span> <span data-notify="message">{2}</span><div class="progress" data-notify="progressbar"><div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div></div><a href="{3}" target="{4}" data-notify="url"></a></div>',
                }
            );
        }

         $(".homePage").click(function (e) {
            window.localStorage.setItem('location', 'home');
        });
    </script>

    <!-- Notify Messages -->

</body>
</html>
