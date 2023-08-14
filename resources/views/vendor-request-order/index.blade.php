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
                    <h4 class="text-themecolor">Purchase Orders</h4>
                </div>
                <div class="col-md-7 align-self-center text-end">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item">
                                <a href="/accountadmin">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                <a href="/accountadmin/vendor-request-order">
                                    Purchase Order
                                </a>
                            </li>
                        </ol>
                        <a href="/accountadmin/vendor-request-order/add" style="margin-top:-34px;">
                            <button type="button"
                                    class="btn btn-info d-none d-lg-block m-l-15 text-white"><i
                                    class="fa fa-plus-circle"></i>
                                Create New
                            </button>
                        </a>
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
                            <!-- <h4 class="card-title">Product Category Export</h4>
                                <h6 class="card-subtitle">Export locations to Copy, CSV, Excel, PDF & Print</h6> -->
                            <div class="table-responsive m-t-40">
                                <table id="example23" class="display nowrap table table-hover table-striped border"
                                       cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Vendor Name</th>
                                        <th>User Name</th>
                                        <th>PO Number</th>
                                        <th>Delivery Date</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th style="text-align:center;">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($vendorOrders as $vendorOrder)
                                        <tr>
                                            <td
                                                onclick="window.location='{{ route('accountadmin.vendor-request-order.view', ['id' => $vendorOrder->pk_purchase_order]) }}'">
                                                {{ @$vendorOrder->vendor->vendor_name }}</td>
                                            <td
                                                onclick="window.location='{{ route('accountadmin.vendor-request-order.view', ['id' => $vendorOrder->pk_purchase_order]) }}'">
                                                {{ @$vendorOrder->user->first_name }} {{ @$vendorOrder->user->last_name }}</td>
                                            <td
                                                onclick="window.location='{{ route('accountadmin.vendor-request-order.view', ['id' => $vendorOrder->pk_purchase_order]) }}'">
                                                {{ $vendorOrder->po_number }}</td>
                                            <td
                                                onclick="window.location='{{ route('accountadmin.vendor-request-order.view', ['id' => $vendorOrder->pk_purchase_order]) }}'">
                                                {{ Helper::formatDate($vendorOrder->delivery_date_request) }}</td>
                                            <td
                                                onclick="window.location='{{ route('accountadmin.vendor-request-order.view', ['id' => $vendorOrder->pk_purchase_order]) }}'">
                                                {{ @$vendorOrder->location->location_name }}</td>
                                            <td
                                                onclick="window.location='{{ route('accountadmin.vendor-request-order.view', ['id' => $vendorOrder->pk_purchase_order]) }}'">
                                                {{ $vendorOrder->status->purchase_order_status ?? 'N/A' }}
                                            </td>
                                            <td style="text-align:center;">
                                                <a
                                                    href="/accountadmin/vendor-request-order/edit/{{ $vendorOrder->pk_purchase_order }}">
                                                    <button
                                                        class="btn btn-danger text-white">Edit
                                                    </button>
                                                </a>
                                                <a href="javascript:"
                                                   onclick="form_alert('vendor-order-request-{{ $vendorOrder->pk_purchase_order }}', '{{ 'want to delete ' }}{{ 'Vendor Order?' }}')">
                                                    <button
                                                        class="btn btn-danger text-white">Delete
                                                    </button>
                                                </a>
                                                <form
                                                    action="{{ route('accountadmin.vendor-request-order.delete', [$vendorOrder->pk_purchase_order]) }}"
                                                    method="get"
                                                    id="vendor-order-request-{{ $vendorOrder->pk_purchase_order }}">
                                                    @csrf
                                                </form>
                                            </td>
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
