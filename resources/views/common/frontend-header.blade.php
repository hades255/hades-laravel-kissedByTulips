<div class="topForm">
  <div id="zapiet-delivery-validator__container">
          <form id="zapiet-delivery-validator__form">
            <span id="zapiet-delivery-validator__label">Do we deliver?</span>
            <div class="zapiet-delivery-validator__fields">
              <input type="text"  placeholder="Enter your postal code ...">
              <button type="submit" class="zapiet-delivery-validator__submit" fdprocessedid="gv7lnq">
                <span id="zapiet-delivery-validator__button_label">Go</span>
                <span id="zapiet-delivery-validator__loading" style="display: none">
                  <svg width="18" height="18" viewBox="0 0 38 38" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient x1="8.042%" y1="0%" x2="65.682%" y2="23.865%" id="a"><stop stop-color="#fff" stop-opacity="0" offset="0%"></stop><stop stop-color="#fff" stop-opacity=".631" offset="63.146%"></stop><stop stop-color="#fff" offset="100%"></stop></linearGradient></defs><g transform="translate(1 1)" fill="none" fill-rule="evenodd"><path d="M36 18c0-9.94-8.06-18-18-18" stroke="url(#a)" stroke-width="2"><animateTransform attributeName="transform" type="rotate" from="0 18 18" to="360 18 18" dur="0.9s" repeatCount="indefinite"></animateTransform></path><circle fill="#fff" cx="36" cy="18" r="1"><animateTransform attributeName="transform" type="rotate" from="0 18 18" to="360 18 18" dur="0.9s" repeatCount="indefinite"></animateTransform></circle></g></svg>
                </span>
              </button>
              <a href="#" id="zapiet-delivery-validator__close" class="zapiet-delivery-validator__close">
                <svg class="zapiet-delivery-validator__close" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M12 0c6.623 0 12 5.377 12 12s-5.377 12-12 12-12-5.377-12-12 5.377-12 12-12zm0 1c6.071 0 11 4.929 11 11s-4.929 11-11 11-11-4.929-11-11 4.929-11 11-11zm0 10.293l5.293-5.293.707.707-5.293 5.293 5.293 5.293-.707.707-5.293-5.293-5.293 5.293-.707-.707 5.293-5.293-5.293-5.293.707-.707 5.293 5.293z"></path></svg>
              </a>
            </div>
          </form>
        </div>
</div>
<div class="topVar">
  <span> Luxury Flower Shop Located in Costa Mesa, CA that Specializes in Contemporary Floral Design
  </span>
   <button class="close"> x </button>
</div>

<header>
  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href="{{url('/')}}"><img style="margin-right: 160px;" src="{{asset('home/images/logo.webp')}}" /> </a>
      <!-- <form action="#" class="searchform order-sm-start order-lg-last">
        <div class="form-group d-flex">
          <input type="text" class="form-control pl-3" placeholder="Search">
          <button type="submit" placeholder="" class="form-control search"><span class="fa fa-search"></span></button>
        </div>
      </form> -->

    <ul class="navbar-nav onMobile pb-0">

    <li class="nav-item"><a href="#" class="nav-link searchItem t-top"> <img style="width:20px;" src="./home/images/srch.png" /> </a></li>
    <li class="nav-item">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="fa fa-bars"></span>
        </button>
    </li>
    <li class="nav-item"><a href="#" class="nav-link"> <img class="cart" style="width:30px;" src="./home/images/cart.png" /> </a></li>
    </ul>
      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav m-auto">
          <li class="nav-item active"><a href="{{url('/')}}" class="nav-link">Home</a></li>
          <li class="nav-item"><a href="{{url('floral-arrangement')}}" class="nav-link">Shop</a></li>
          <li class="nav-item"><a href="{{url('flower-by-subscription')}}" class="nav-link">Subscription</a></li>
          <li class="nav-item" style="width: 142px;"><a href="#" class="nav-link" style="padding-left: 2px;">Our Story</a></li>
          <li class="nav-item"><a href="{{url('request-a-quote')}}" class="nav-link">Contact</a></li>
          <li class="nav-item"><a href="#" class="nav-link">Delivery</a></li>
          <li class="nav-item"><a href="{{url('location-we-serve')}}" class="nav-link" style="width: 186px;">Location We Serve</a></li>
        </ul>
    <ul class="navbar-nav ml-auto xs-none" style="width: 165px;">
          @if(auth()->check() && auth()->user()->pk_roles == 1)
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/superadmin') }}">  <img style="width:20px;" src="{{asset('home/images/user.png')}}"></a>
            </li>
          @endif
          @if(auth()->check() && auth()->user()->pk_roles == 2)
          <li class="nav-item">
              <a class="nav-link" href="{{ url('/accountadmin') }}"><img style="width:20px;" src="{{asset('home/images/user.png')}}"></a>
            </li>
          @endif
          @if(auth()->check() && auth()->user()->pk_roles == 3)
          <li class="nav-item">
              <a class="nav-link" href="{{ url('/locationmanager') }}"><img style="width:20px;" src="{{asset('home/images/user.png')}}"></a>
          </li>
          @endif
          @if(auth()->check() && auth()->user()->pk_roles == 4)
          <li class="nav-item">
              <a class="nav-link" href="{{ url('/customer') }}"><img style="width:20px;" src="./home/images/user.png"></a>
          </li>
          @endif
          @if(empty(auth()->user()->pk_roles))
          <li class="nav-item">
          <a href="/login?redirect=customer" class="nav-link">
          <img style="width:20px;" src="./home/images/user.png">
         </a>
        </li>
        @endif
      <li class="nav-item"><a href="#" class="nav-link searchItem t-top"> <img style="width:20px;" src="./home/images/srch.png" /> </a></li>
      <li class="nav-item"><a href="{{ URL::to('other-cart') }}" class="nav-link"><img class="cart" style="width:30px;" src="./home/images/cart.png" /><span class="cardCounter"> {{ session('oth_total_quantity') ? session('oth_total_quantity') : 0 }}</span></a></li>
    </ul>
      </div>
    </div>
  </nav>


  <nav class="navbar hidemenu top displayMenu navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container position-relative">
    <div class="site-header__search">
      <div class="page-width">
        <form action="/search" method="get" id="HeaderSearchForm" class="site-header__search-form" role="search" autocomplete="off">
        <input type="hidden" name="type" value="product,article,page,collection">
        <input type="hidden" name="options[prefix]" value="last">
        <label for="search-icon" class="hidden-label">Search</label>
        <label for="SearchClose" class="hidden-label">"Close (esc)"</label>
        <button type="submit" id="search-icon" class="text-link site-header__search-btn">
          <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-search" viewBox="0 0 64 64"><path d="M47.16 28.58A18.58 18.58 0 1 1 28.58 10a18.58 18.58 0 0 1 18.58 18.58zM54 54L41.94 42"></path></svg>
          <span class="icon__fallback-text">Search</span>
        </button>
        <input type="search" name="q" value="" placeholder="Search our store" class="site-header__search-input" aria-label="Search our store" spellcheck="false" data-ms-editor="true">
        </form>
        <button type="button" id="SearchClose" class="top showemenu text-link site-header__search-btn">
        <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-close" viewBox="0 0 64 64"><path d="M19 17.61l27.12 27.13m0-27.12L19 44.74"></path></svg>
        <span class="icon__fallback-text">"Close (esc)"</span>

        </button>
      </div>
      </div>
  </div>
  </nav>

</header>
