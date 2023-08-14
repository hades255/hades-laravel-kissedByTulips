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
                <h4 class="text-themecolor">Customer Location Type</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                      <li class="breadcrumb-item"><a href="/accountadmin">Home</a></li>
                      <li class="breadcrumb-item active"><a href="/accountadmin/location-types">Customer Location Type</a></li>
                    </ol>
                    <a href="/accountadmin/customer-location-types/add"> <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i
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
                        <!-- <h4 class="card-title">Product Category Export</h4>
                        <h6 class="card-subtitle">Export locations to Copy, CSV, Excel, PDF & Print</h6> -->
                        <div class="table-responsive m-t-40">
                            <table id="example23"
                                class="display nowrap table table-hover table-striped border"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Customer Location Type</th>
                                        <th style="text-align:center;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($customerlocationtypes as $customerlocationtype)
                                    <tr>
                                      <td onclick="window.location='{{ route('accountadmin.customer-location-types.edit', ['id' => $customerlocationtype->pk_customer_location_types]) }}'">{{$customerlocationtype->customer_location_types}}</td>
                                        <td style="text-align:center;">
                                         <a href="/accountadmin/customer-location-types/edit/{{$customerlocationtype->pk_customer_location_types}}"><button class="btn btn-danger text-white">Edit</button></a>
                                         <a href="/accountadmin/customer-location-types/delete/{{$customerlocationtype->pk_customer_location_types}}"><button class="btn btn-danger text-white">Delete</button></a>
                                         <a href="javascript:" onclick="form_alert('customer-location-types-{{$customerlocationtype->pk_customer_location_types}}', '{{'want to delete '}}{{$customerlocationtype->customer_location_types}} {{'Customer Location Type'}}')"><button class="btn btn-danger text-white">Delete</button></a>
                                         <form action="{{route('accountadmin.customer-location-types.delete',[$customerlocationtype->pk_customer_location_types])}}" method="get" id="customer-location-types-{{$customerlocationtype->pk_customer_location_types}}">
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
