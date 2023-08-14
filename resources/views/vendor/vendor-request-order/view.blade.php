@extends('layouts.backend_new')

@section('content')
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            @if (Session::has('message'))
                <p class="alert alert-{{ Session::get('messageType') }} }}">
                    {{ Session::get('message') }}</p>
            @endif
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Vendor Order Request</h4>
                </div>
                <div class="col-md-7 align-self-center text-end">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="/vendor">Home</a></li>
                            <li class="breadcrumb-item active"><a href="/vendor/vendor-order-request">Vendor Order
                                    Request</a></li>
                        </ol>

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
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <!--
                                        <h6 class="card-subtitle">Export locations to Copy, CSV, Excel, PDF & Print</h6> -->

                            <h4 class="card-title">Summary</h4>
                            <div class="table-responsive m-t-40">
                                <table class="display nowrap table table-hover table-striped border" cellspacing="0"
                                    width="100%">
                                    <thead>
                                        <tr>
                                            <th>Vendor Name</th>
                                            <th>User Name</th>
                                            <th>PO Number</th>
                                            <th>Delivery Date</th>
                                            <th>Address</th>
                                            <th>Address 1</th>
                                            <th>State</th>
                                            <th>Country</th>
                                            <th>Zip Code</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $vendorOrder->vendor->vendor_name }}</td>
                                            <td>{{ @$vendorOrder->user->first_name }} {{ @$vendorOrder->user->last_name }}</td>
                                            <td>{{ $vendorOrder->po_number }}</td>
                                            <td>{{ date('m/d/Y', strtotime($vendorOrder->delivery_date_request ))}}</td>
                                            <td>{{ $vendorOrder->shipping_address }}</td>
                                            <td>{{ $vendorOrder->shipping_address_1 }}</td>
                                            <td>{{ $vendorOrder->shipping_state }}</td>
                                            <td>{{ $vendorOrder->shipping_country }}</td>
                                            <td>{{ $vendorOrder->shipping_zip }}</td>
                                            <td>{{ $vendorOrder->active == 1? 'Active': 'Inactive'}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <h4 class="card-title">Products</h4>
                            <div class="table-responsive m-t-40">
                                <table class="display nowrap table table-hover table-striped border" cellspacing="0"
                                    width="100%">
                                    <thead>
                                        <tr>
                                            <th>Item Name</th>
                                            <th>Item Description</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vendorOrder->items as $item)
                                            <tr>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->description }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $item->price }}</td>
                                                <td>{{ $item->total }}</td>
                                            </tr>
                                        @endforeach
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
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
@endsection
