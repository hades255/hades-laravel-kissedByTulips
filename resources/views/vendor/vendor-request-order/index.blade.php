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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($vendorOrders))
                                            @foreach ($vendorOrders as $vendorOrder)
                                                <tr>
                                                    <td onclick="goLink('{{ $vendorOrder->pk_purchase_order }}')">
                                                        {{ @$vendorOrder->vendor->vendor_name }}</td>
                                                    <td
                                                    onclick="goLink('{{ $vendorOrder->pk_purchase_order }}')">
                                                        {{ @$vendorOrder->user->first_name }}
                                                        {{ @$vendorOrder->user->last_name }}</td>
                                                    <td
                                                    onclick="goLink('{{ $vendorOrder->pk_purchase_order }}')">
                                                        {{ $vendorOrder->po_number }}</td>
                                                    <td
                                                    onclick="goLink('{{ $vendorOrder->pk_purchase_order }}')">
                                                        {{ date('m/d/Y', strtotime($vendorOrder->delivery_date_request ))}}</td>
                                                    <td
                                                    onclick="goLink('{{ $vendorOrder->pk_purchase_order }}')">
                                                        {{ $vendorOrder->shipping_address }}</td>
                                                    <td
                                                    onclick="goLink('{{ $vendorOrder->pk_purchase_order }}')">
                                                        {{ $vendorOrder->active == 1 ? 'Active' : 'Inactive' }}</td>

                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="7">No data found</td>
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
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
@endsection

<script>
    function goLink(id){
        window.location.href = `/vendor/vendor-order-request/view/${id}`;
    }
</script>

