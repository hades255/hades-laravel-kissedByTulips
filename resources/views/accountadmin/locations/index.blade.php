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
                <h4 class="text-themecolor">Locations</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                      <li class="breadcrumb-item"><a href="/accountadmin">Home</a></li>
                      <li class="breadcrumb-item active"><a href="/accountadmin/locations">Location</a></li>
                    </ol>
                    <a href="/accountadmin/locations/add"> <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i
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
                        <!-- <h4 class="card-title">Locations Export</h4>
                        <h6 class="card-subtitle">Export locations to Copy, CSV, Excel, PDF & Print</h6> -->
                        <div class="table-responsive m-t-40">
                            <table id="example23" class="table table-striped"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Location Type</th>
                                        <th>Location Name</th>
                                        <th>Location Code</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>Zip</th>
                                        <th style="text-align:center;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($locations as $location)
                                    <tr>
                                        <td onclick="window.location='{{ route('accountadmin.locations.edit', ['id' => $location->pk_locations]) }}'">{{$location->location_types}}</td>
                                        <td onclick="window.location='{{ route('accountadmin.locations.edit', ['id' => $location->pk_locations]) }}'">{{$location->location_name}}</td>
                                        <td onclick="window.location='{{ route('accountadmin.locations.edit', ['id' => $location->pk_locations]) }}'">{{$location->location_code}}</td>
                                        <td onclick="window.location='{{ route('accountadmin.locations.edit', ['id' => $location->pk_locations]) }}'">{{$location->address}}</td>
                                        <td onclick="window.location='{{ route('accountadmin.locations.edit', ['id' => $location->pk_locations]) }}'">{{$location->city}}</td>
                                        <td onclick="window.location='{{ route('accountadmin.locations.edit', ['id' => $location->pk_locations]) }}'">{{$location->zip}}</td>
                                        <td style="text-align:center;">
                                         <a href="/accountadmin/locations/edit/{{$location->pk_locations}}"><button class="btn btn-danger text-white">Edit</button></a>
                                         <a href="javascript:" onclick="form_alert('locations-{{$location->pk_locations}}', '{{'want to delete '}}{{$location->location_name}} {{'Location?'}}')"><button class="btn btn-danger text-white">Delete</button></a>
                                         <form action="{{route('accountadmin.locations.delete',[$location->pk_locations])}}" method="get" id="locations-{{$location->pk_locations}}">
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
