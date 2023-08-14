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
                <h4 class="text-themecolor">Account</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="/superadmin">Home</a></li>
                        <li class="breadcrumb-item active"><a href="/superadmin/account">Account</a></li>
                    </ol>
                    <a href="/superadmin/account/create"> <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white" style="margin-top:-34px;"><i
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
                        <!-- <h4 class="card-title">Account Export</h4>
                        <h6 class="card-subtitle">Export accounts to Copy, CSV, Excel, PDF & Print</h6> -->
                        <div class="table-responsive m-t-40">
                            <table id="example23"
                                class="display nowrap table table-hover table-striped border"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Business Name</th>
                                        <th>address</th>
                                        <th>City</th>
                                        <th>Zip</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th style="text-align:center;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($accounts as $account)
                                    <tr>
                                        <td onclick="window.location='{{ route('account.edit', ['id' => $account->pk_account]) }}'">{{$account->business_name}}</td>
                                        <td onclick="window.location='{{ route('account.edit', ['id' => $account->pk_account]) }}'">{{$account->address}}</td>
                                        <td onclick="window.location='{{ route('account.edit', ['id' => $account->pk_account]) }}'">{{$account->city}}</td>
                                        <td onclick="window.location='{{ route('account.edit', ['id' => $account->pk_account]) }}'">{{$account->zip}}</td>
                                        <td onclick="window.location='{{ route('account.edit', ['id' => $account->pk_account]) }}'">{{$account->business_phone}}</td>
                                        <td onclick="window.location='{{ route('account.edit', ['id' => $account->pk_account]) }}'">{{$account->business_email}}</td>
                                        <td style="text-align:center;">
                                          <a class="btn btn-danger text-white" href="/superadmin/account/edit/{{$account->pk_account}}">Edit</a>
                                          <a href="javascript:" onclick="form_alert('account-{{$account->pk_account}}', '{{'want to delete '}}{{$account->business_name}} {{' Account?'}}')"><button class="btn btn-danger text-white">Delete</button></a>
                                          <form action="{{route('account.delete',[$account->pk_account])}}" method="get" id="account-{{$account->pk_account}}">
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
