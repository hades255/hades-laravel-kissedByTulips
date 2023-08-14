<header>
  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href="/"><img style="width:200px;" src="{{asset('home/images/logo.webp')}}" /> </a>
    <ul class="navbar-nav onMobile pb-0">
    <li class="nav-item"><a href="#" class="nav-link searchItem t-top"> <img style="width:20px;" src="{{asset('home/images/srch.png')}}" /> </a></li>
    <li class="nav-item">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="fa fa-bars"></span>
        </button>
    </li>
    <li class="nav-item"><a href="#" class="nav-link"> <img class="cart" style="width:30px;" src="{{asset('home/images/cart.png')}}" /> </a></li>
    </ul>
      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav m-auto">
          @if(Auth::user()->pk_roles == 4)
          <li class="nav-item active"><a href="/" class="nav-link">Dashboard</a></li>
          <li class="nav-item"><a href="{{url('floral-arrangement')}}" class="nav-link">Shop</a></li>
          <li class="nav-item"><a href="{!! route('dashboard.myorders') !!}" class="nav-link">My Orders</a></li>
          {{-- <li class="nav-item"><a href="{!! route('dashboard.vendor-order-request') !!}" class="nav-link">Vendor Order Request</a></li> --}}
          @endif
          @if(Auth::user()->pk_roles == 1)
          <li class="nav-item"><a href="{{url('superadmin')}}" class="nav-link">Dashboard</a></li>
          <li class="nav-item"><a href="{{url('superadmin/setup')}}" class="nav-link">Setup</a></li>
          @endif
          @if(Auth::user()->pk_roles == 3)
          <li class="nav-item"><a href="/locationmanager/vendor-order-request" class="nav-link">Vendor Order Request</a></li>
          @endif
          @if(Auth::user()->pk_roles == 2)
          <li class="nav-item"><a href="/accountadmin" class="nav-link">Dashboard</a></li>
          <li class="nav-item"><a href="/accountadmin/orders" class="nav-link">Orders</a></li>
          <li class="nav-item"><a href="{{ route('accountadmin.sales.index') }}" class="nav-link">Sales</a></li>
          <li class="nav-item"><a href="/accountadmin/customers" class="nav-link">Customers</a></li>
          <li class="nav-item"><a href="#" class="nav-link">Reports</a></li>
          <li class="nav-item"><a href="/accountadmin/setup" class="nav-link">Setup</a></li>
          @endif
          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link" aria-expanded="false" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Logout</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST">
              @csrf
          </form>
        </li>
        </ul>
    <ul class="navbar-nav ml-auto xs-none">
      <!-- <li class="nav-item active"><a href="/" class="nav-link">Home</a></li>
      <li class="nav-item"><a href="/floral-arrangement" class="nav-link">Customer</a></li>
      <li class="nav-item"><a href="/login?redirect=customer" class="nav-link">Logout</a></li> -->
    </ul>
      </div>
    </div>
  </nav>
</header>
