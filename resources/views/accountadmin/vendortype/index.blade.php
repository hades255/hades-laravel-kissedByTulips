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
                <h4 class="text-themecolor">Vendor Type</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                      <li class="breadcrumb-item"><a href="/accountadmin">Home</a></li>
                      <li class="breadcrumb-item active"><a href="/accountadmin/vendor-type">Vendor Type</a></li>
                    </ol>
                    <a href="/accountadmin/vendor-type/add"> <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white" style="margin-top:-34px;"><i
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
                        <!-- <h4 class="card-title">Vendor Type Export</h4>
                        <h6 class="card-subtitle">Export Vendor Type to Copy, CSV, Excel, PDF & Print</h6> -->
                        <div class="table-responsive m-t-40">
                            <table id="example23"
                                class="display nowrap table table-hover table-striped border"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Vendor Type</th>
                                        <th style="text-align:center;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($vendortypes as $vendortype)
                                    <tr>
                                      <td onclick="window.location='{{ route('accountadmin.vendor-type.edit', ['id' => $vendortype->pk_vendor_type]) }}'">{{$vendortype->vendor_type}}</td>
                                        <td style="text-align:center;">
                                         <a href="/accountadmin/vendor-type/edit/{{$vendortype->pk_vendor_type}}"><button class="btn btn-danger text-white">Edit</button></a>
                                         <a href="javascript:" onclick="form_alert('vendor-{{$vendortype->pk_vendor_type}}', '{{'want to delete '}}{{$vendortype->vendor_type}}{{' Vendor?'}}')"><button class="btn btn-danger text-white">Delete</button></a>
                                         <form action="{{route('accountadmin.vendor-type.delete',[$vendortype->pk_vendor_type])}}" method="get" id="vendor-{{$vendortype->pk_vendor_type}}">
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
