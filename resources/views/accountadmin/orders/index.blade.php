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
                <p class="alert alert-{{ Session::get('messageType') }}">{{ Session::get('message') }}</p>
            @endif
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-1 align-self-center">
                    <h4 class="text-themecolor">Orders</h4>
                </div>
                <div class="col-md-2 align-self-center">
                    <form method="post" action="/accountadmin/order-status">
                        @csrf
                        <!-- <label for="role">Order Status</label>-->
                        <select name="pk_order_status" id="pk_order_status" class="form-control">
                            <option value="">Filter Order by Status</option>
                            @foreach ($order_status as $status)
                                <option
                                    value="{{ $status->pk_order_status }}">{{ ucfirst($status->order_status) }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-secondary" value="Go"
                                style="margin-left: 200px;margin-top: -70px;">Go
                        </button>
                    </form>
                </div>
                <div class="col-md-4 align-self-center p-3" style="margin-top: -18px;margin-left: 80px;">
                    <form method="POST" action="{{ route('accountadmin.payment.index.filter') }}">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search orders..." name="search"
                                   value="{{ old('search', $search ?? '') }}" required>
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-4 align-self-center text-end">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="/accountadmin">Home</a></li>
                            <li class="breadcrumb-item active"><a href="/accountadmin/orders">Orders</a></li>
                        </ol>

                        <!-- <a href="/accountadmin/locations/add"> <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i
                                        class="fa fa-plus-circle"></i> Create New</button></a> -->
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
                            <!-- <h4 class="card-title">Locations Export</h4>
                                    <h6 class="card-subtitle">Export locations to Copy, CSV, Excel, PDF & Print</h6> -->
                            <div class="table-responsive m-t-40">
                                <table id="example23" class="table table-striped" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Order Number</th>
                                        <th style="width: 120px;">Date</th>
                                        <th>Order Status</th>
                                        <th>Customer Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>State</th>
                                        <th>Delivery Charge</th>
                                        <th>Discount</th>
                                        <th>Total Order Amount</th>
                                        <th>Estimated Delivery</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if (count($orders))
                                        @foreach ($orders as $order)
                                            <tr onclick="window.location='/accountadmin/orders/{{ $order->pk_orders }}'"
                                                style="cursor: pointer">
                                                <td>{{ $order->pk_orders }}</td>
                                                <td>{{ date('m/d/Y', strtotime($order->created_at)) }}</td>
                                                <td>{{ strtoupper($order->orderStatus->order_status) ?? 'NEW' }}</td>
                                                <td>{{ @$order->customer->customer_name }}</td>
                                                <td>{{ @$order->customer->email }}</td>
                                                <td>{{ @$order->customer->office_phone }}</td>
                                                <td>{{ @$order->location->state->state_code }}</td>
                                                <td>${{ number_format($order->delivery_charge, 2) }}</td>
                                                <td>${{ number_format($order->discount_charge, 2) }}</td>
                                                <td>${{ number_format($order->total, 2) }}</td>
                                                <td>{{ \Carbon\Carbon::parse($order->estimated_del)->isValid() ? date('m/d/Y', strtotime($order->estimated_del)) : '' }}</td>
                                                <td style="width:450px;height:40px;">
                                                    @if ($order->pk_order_status == 3)
                                                        <a style="height: 60px;
    width: 167px;"
                                                           href="/accountadmin/orders/cancel/{{ $order->pk_orders }}"
                                                           class="btn btn-primary">Cancel the Order </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="100%">
                                                No orders found!
                                            </td>
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
