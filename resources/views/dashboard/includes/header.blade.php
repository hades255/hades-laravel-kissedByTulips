<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <div class="navbar-header">
            <a class="navbar-brand" href="/">
                <!-- Logo icon --><b>
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <!-- <img src="../assets/images/logo-icon.png" alt="homepage" class="dark-logo" /> -->
                    <!-- Light Logo icon -->
                    <!-- <img src="../assets/images/logo-light-icon.png" alt="homepage" class="light-logo" /> -->
                </b>
                <!--End Logo icon -->
                <!-- Logo text --><span>
                    <!-- dark Logo text -->
                    <img src="/assets/images/kbt.png" alt="homepage" class="dark-logo" height="50" width="160" />
                    <!-- Light Logo text -->
                    <img src="/assets/images/logo-light-text.png" class="light-logo" alt="homepage" /></span>
            </a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav me-auto">
                <!-- This is  -->
                <li class="nav-item"> <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark"
                        href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                <li class="nav-item"> <a
                        class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark"
                        href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
                <!-- ============================================================== -->
                <!-- Search -->
                <!-- ============================================================== -->
                <li class="nav-item">
                    <form class="app-search d-none d-md-block d-lg-block">
                        <input type="text" class="form-control" placeholder="Search & enter">
                    </form>
                </li>
            </ul>
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
            <ul class="navbar-nav my-lg-0">
                <!-- ============================================================== -->
                <!-- Comment -->
                <!-- ============================================================== -->
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false"> <i class="ti-email"></i>
                        <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                    </a>
                </li> -->
                <!-- ============================================================== -->
                <!-- End Comment -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Messages -->
                <!-- ============================================================== -->
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i
                            class="icon-note"></i>
                        <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                    </a>
                </li> -->
                <!-- ============================================================== -->
                <!-- End Messages -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- mega menu -->
                <!-- ============================================================== -->
                <!-- <li class="nav-item dropdown mega-dropdown"> <a
                        class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false"><i class="ti-layout-width-default"></i></a>
                </li> -->
                <!-- ============================================================== -->
                <!-- End mega menu -->
                <!-- ============================================================== -->
                <ul class="navbar-nav my-lg-0">
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:white;">
                        <img src="/assets/images/users/2.jpg" alt="user-img" class="img-circle" width="35" height="35"> &nbsp;&nbsp;&nbsp;{{ Auth::user()->first_name}} {{ Auth::user()->last_name}} <i class="fas fa-angle-down"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-end mailbox animated bounceInDown">
                          <ul>
                              <li>
                                @if(auth()->check() && ( auth()->user()->pk_roles == 1))
                                <a href="/superadmin/account/users/profile" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                                @endif
                                @if(auth()->check() && ( auth()->user()->pk_roles == 2))
                                <a href="/accountadmin/account/users/profile" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                                @endif
                                @if(auth()->check() && ( auth()->user()->pk_roles == 4))
                                <a href="/customer/profile" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                                @endif
                               </li>
                                <li>
                                  <a href="{{ route('logout') }}" class="dropdown-item" aria-expanded="false" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();"><i class="fas fa-power-off"></i>Logout</a>
                                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                      @csrf
                                  </form>
                                </li>
                           </ul>
                      </div>
                  </li>
               </ul>
            </ul>
        </div>
    </nav>
</header>
