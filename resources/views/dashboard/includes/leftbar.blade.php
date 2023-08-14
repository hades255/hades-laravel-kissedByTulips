<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User Profile-->
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                @if(Auth::user()->pk_roles == 1)
                <li><a href="/superadmin" aria-expanded="false"><i class="ti-layout-grid2"></i><span class="hide-menu">Home</span></a></li>
                <li><a href="/superadmin/setup" aria-expanded="false"><i class="ti-settings"></i><span class="hide-menu">Setup</span></a></li>
                @endif
                @if(Auth::user()->pk_roles == 2)
                <li><a href="/accountadmin" aria-expanded="false"><i class="ti-layout-grid2"></i><span class="hide-menu">Home</span></a></li>
                <li><a href="/accountadmin/products" aria-expanded="false"><i class="mdi mdi-store-24-hour"></i><span class="hide-menu">Products</span></a></li>
                <li><a href="/accountadmin/floral-arrangements" aria-expanded="false"><i class="mdi mdi-store-24-hour"></i><span class="hide-menu">Floral Arrangements</span></a></li>
                <li><a href="/accountadmin/orders" aria-expanded="false"><i class="fab fa-first-order"></i><span class="hide-menu">Orders</span></a></li>
                <li><a href="/accountadmin/customers" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">Customers</span></a></li>
                <li><a href="#" aria-expanded="false"><i class="mdi mdi-store-24-hour"></i><span class="hide-menu">Items</span></a></li>
                <li><a href="/accountadmin/vendors" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">Vendors</span></a></li>
                <li> <a href="#" aria-expanded=" false"><i class="fa fa-file"></i><span class="hide-menu">Reports</span></a>
                <li><a href="/accountadmin/setup" aria-expanded="false"><i class="ti-settings"></i><span class="hide-menu">Setup</span></a></li>
                </li>
                @endif

                @if(Auth::user()->pk_roles == 4)
                    <li><a href="/shop" aria-expanded="false"><i class="fab fa-first-order"></i><span class="hide-menu">Shop</span></a></li>
                    <li><a href="{!! route('dashboard.myorders') !!}" aria-expanded="false"><i class="fab fa-first-order"></i><span class="hide-menu">My Orders</span></a></li>
                @endif



            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
