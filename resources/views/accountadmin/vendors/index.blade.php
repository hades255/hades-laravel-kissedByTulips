@extends('layouts.backend_new')

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
                <h4 class="text-themecolor">Vendors</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                      <li class="breadcrumb-item"><a href="/accountadmin">Home</a></li>
                      <li class="breadcrumb-item active"><a href="/accountadmin/vendors">Vendors</a></li>
                    </ol>
                    <a href="/accountadmin/vendors/add" style="margin-top: -34px;"> <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i
                            class="fa fa-plus-circle"></i> Create New</button></a>
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
                        <!-- <h4 class="card-title">Vendors Export</h4>
                        <h6 class="card-subtitle">Export Vendors to Copy, CSV, Excel, PDF & Print</h6> -->
                        <div class="table-responsive m-t-40">
                            <table id="example23"
                                class="display nowrap table table-hover table-striped border"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Vendor Name</th>
                                        <th>Vendor Type</th>
                                        <th>City</th>
                                        <th>State</th>
                                        <th style="text-align:center;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($vendors as $vendor)
                                    <tr>
                                        <td onclick="window.location='{{ route('accountadmin.vendors.edit', ['id' => $vendor->pk_vendors]) }}'">{{$vendor->vendor_name}}</td>
                                        <td onclick="window.location='{{ route('accountadmin.vendors.edit', ['id' => $vendor->pk_vendors]) }}'">{{$vendor->vendor_type}}</td>
                                        <td onclick="window.location='{{ route('accountadmin.vendors.edit', ['id' => $vendor->pk_vendors]) }}'">{{$vendor->city}}</td>
                                        <td onclick="window.location='{{ route('accountadmin.vendors.edit', ['id' => $vendor->pk_vendors]) }}'">{{$vendor->state_name}}</td>
                                        <td style="text-align:center;">
                                         <a href="/accountadmin/vendors/edit/{{$vendor->pk_vendors}}"><button class="btn btn-danger text-white">Edit</button></a>
                                         <a href="javascript:" onclick="form_alert('vendor-{{$vendor->pk_vendors}}', '{{'want to delete '}}{{$vendor->vendor_name}}{{' Vendor?'}}')"><button class="btn btn-danger text-white">Delete</button></a>
                                         <form action="{{route('accountadmin.vendors.delete',[$vendor->pk_vendors])}}" method="get" id="vendor-{{$vendor->pk_vendors}}">
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
