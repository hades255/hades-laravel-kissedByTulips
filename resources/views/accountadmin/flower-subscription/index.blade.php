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
                <h4 class="text-themecolor">Flower Subscriptions</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                      <li class="breadcrumb-item"><a href="/accountadmin">Home</a></li>
                      <li class="breadcrumb-item active"><a href="/accountadmin/flower-subscription">Flower Subscriptions</a></li>
                    </ol>
                    <a href="/accountadmin/flower-subscription/add"> <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white" style="margin-top:-34px;"><i
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
                        <!-- <h4 class="card-title">Countries Export</h4>
                        <h6 class="card-subtitle">Export Countries to Copy, CSV, Excel, PDF & Print</h6> -->
                        <div class="table-responsive m-t-40">
                            <table id="example23"
                                class="display nowrap table table-hover table-striped border"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Flower Subscription</th>
                                        <th>Price</th>
                                        <th>Unit of Measure</th>
                                        <th style="text-align:center;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($flowerSubscriptions as $flowerSubscription)
                                    <tr>
                                        <td onclick="window.location='{{ route('accountadmin.flower-subscription.edit', ['id' => $flowerSubscription->pk_flower_subscription]) }}'">{{$flowerSubscription->frequency}} </td>
                                        <td onclick="window.location='{{ route('accountadmin.flower-subscription.edit', ['id' => $flowerSubscription->pk_flower_subscription]) }}'">{{$flowerSubscription->price}}$</td>
                                        <td onclick="window.location='{{ route('accountadmin.flower-subscription.edit', ['id' => $flowerSubscription->pk_flower_subscription]) }}'">{{$flowerSubscription->uom}}</td>
                                        <td style="text-align:center;">
                                         <a href="/accountadmin/flower-subscription/edit/{{$flowerSubscription->pk_flower_subscription}}"><button class="btn btn-danger text-white">Edit</button></a>
                                         <a href="javascript:" onclick="form_alert('flowers-subscription-{{$flowerSubscription->pk_flower_subscription}}', '{{'want to delete '}}{{$flowerSubscription->frequency}} {{'Flower Subscription?'}}')"><button class="btn btn-danger text-white">Delete</button></a>
                                         <form action="{{route('accountadmin.flower-subscription.delete',[$flowerSubscription->pk_flower_subscription])}}" method="get" id="flowers-subscription-{{$flowerSubscription->pk_flower_subscription}}">
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
