@extends('layouts.backend_new')

@section('content')
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Setup</h4>
                </div>
                <div class="col-md-7 align-self-center text-end">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Setup</li>
                        </ol>
                        <!-- <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i class="fa fa-plus-circle"></i> Create New</button> -->
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <!-- column -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>General</th>
                                        <th>Catalog</th>
                                        <th>Purchase</th>
                                        <th>Customization</th>
                                        <th>Communications</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(Auth::user()->pk_roles == 1)
                                        <tr>
                                            <td><a href="/superadmin/account">Accounts</a></td>
                                            <td><a href="/superadmin/order-status">Order Status</a></td>
                                            <td></td>
                                            <td><a href="/superadmin/location-types">Locations Type</a></td>
                                            <td><a href="/superadmin/event">Communication Events</a></td>
                                        </tr>
                                        <tr>
                                            <td><a href="/superadmin/users">Users</a></td>
                                            <td><a href="/superadmin/frequency">Frequency</a></td>
                                            <td></td>
                                            <td><a href="/superadmin/customer-location-types">Customer Locations
                                                    Type</a></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><a href="/superadmin/roles">Roles</a></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><a href="/superadmin/states">States</a></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><a href="/superadmin/country">Countries</a></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @endif
                                    @if(Auth::user()->pk_roles == 2)
                                        <tr>
                                            <td><a href="/accountadmin/locations">Locations</a></td>
                                            <td><a href="/accountadmin/vase-types">Vase Types</a></td>
                                            <td><a href="/accountadmin/vendor-request-order">Purchase Order</a></td>
                                            <td><a href="/accountadmin/event-type">Event Type</a></td>
                                            <td><a href="/accountadmin/email-account">Email Accounts</a></td>
                                        </tr>
                                        <tr>
                                            <td><a href="/accountadmin/users">Users</a></td>
                                            <td><a href="/accountadmin/size-arrangement">Size of Arrangements</a></td>
                                            <td><a href="/accountadmin/vendor-request-order-status">Purchase Order Status</a></td>
                                            <td><a href="/accountadmin/vendor-type">Vendor Types</a></td>
                                            <td><a href="/accountadmin/email-template">Email Templates</a></td>
                                        </tr>
                                        <tr>
                                            <td><a href="/accountadmin/department">Departments</a></td>
                                            <td><a href="/accountadmin/color-flowers">Color of Flowers</td>
                                            <td><a href="/accountadmin/vendors">Vendors</a></td>
                                            <td><a href="/accountadmin/coupons">Coupon Codes</a></td>
                                            <td><a href="/accountadmin/text-account">Text Accounts</a></td>
                                        </tr>
                                        <tr>
                                            <td><a href="/accountadmin/flowers">Flowers</a></td>
                                            <td><a href="/accountadmin/styles">Styles</a></td>
                                            <td></td>
                                            <td><a href="/accountadmin/payment-gateway">Payment Gateway Setup</a></td>
                                            <td><a href="/accountadmin/text-template">Text Templates</a></td>
                                        </tr>
                                        <tr>
                                            <td><a href="/accountadmin/vase-colors">Vase Colors</a></td>
                                            <td><a href="/accountadmin/products-categories">Product Categories</a></td>
                                            <td></td>
                                            <td></td>
                                            <td><a href="/accountadmin/acknowledgments">Acknowledgments</a></td>
                                        </tr>
                                        <tr>
                                            <td><a href="/accountadmin/arrangement-type">Arrangement Types</a></td>
                                            <td><a href="/accountadmin/product-sub-category">Product Sub Categories</a>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td><a href="/accountadmin/pages">Pages</a></td>
                                        </tr>
                                        <tr>
                                            <td><a href="{{ route('accountadmin.sale-types.index') }}">Sale Types</a></td>
                                            <td><a href="/accountadmin/flower-subscription">Flower Subscriptions</a>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><a href="/accountadmin/delivery-charges">Delivery Charges</a></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><a href="/accountadmin/products">Products</a></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><a href="/accountadmin/floral-arrangements">Floral Arrangements</a></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><a href="#">Items</a></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
</div>
@endsection
