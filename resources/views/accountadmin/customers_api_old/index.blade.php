@extends('layouts.dashboard')

@section('content')
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
                <h4 class="text-themecolor">Customers</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="/accountadmin">Home</a></li>
                        <li class="breadcrumb-item active"><a href="/accountadmin/customers">Customers</a></li>
                    </ol>
                    <a href="/accountadmin/customers/add"> <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i
                            class="fa fa-plus-circle"></i> Add Customer</button></a>
                    <a href="/accountadmin/customer-business/add"> <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i
                            class="fa fa-plus-circle"></i> Add Business Customer</button></a>
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
                        <!-- <h4 class="card-title">Customers</h4> -->
                        <!-- <h6 class="card-subtitle">Export Customers to Copy, CSV, Excel, PDF & Print</h6> -->
                        <div class="table-responsive m-t-40">
                            <table id="example23"
                                class="display nowrap table table-hover table-striped border"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>Customer Type</th>
                                        <th style="text-align:center;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($customers as $customer)
                                    <tr>
                                      <td onclick="window.location='{{ route('accountadmin.customers.edit', ['id' => $customer->pk_customers]) }}'">{{$customer->customer_name}}</td>
                                      <td onclick="window.location='{{ route('accountadmin.customers.edit', ['id' => $customer->pk_customers]) }}'">{{$customer->customer_type}}</td>
                                        <td style="text-align:center;">
                                         <a href="/accountadmin/customers/edit/{{$customer->pk_customers}}"><button class="btn btn-danger text-white">Edit</button></a>
                                         <a href="/accountadmin/customers/delete/{{$customer->pk_customers}}"><button class="btn btn-danger text-white">Delete</button></a>
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
