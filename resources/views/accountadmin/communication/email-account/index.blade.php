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
                <h4 class="text-themecolor">Email Account</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="/accountadmin">Home</a></li>
                        <li class="breadcrumb-item active"><a href="/accountadmin/email-account">Email Account</a></li>
                    </ol>
                    <a href="/accountadmin/email-account/add"> <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white" style="margin-top:-34px;"><i
                            class="fa fa-plus-circle"></i> Add Email Account</button></a>
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
                                        <th>Host</th>
                                        <th>Port</th>
                                        <th>Encryption Type</th>
                                        <th style="text-align:center;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($emailAccounts as $emailAccount)
                                    <tr>
                                      <td onclick="window.location='{{ route('accountadmin.email-account.edit', ['id' => $emailAccount->pk_email_account]) }}'">{{$emailAccount->host}}</td>
                                      <td onclick="window.location='{{ route('accountadmin.email-account.edit', ['id' => $emailAccount->pk_email_account]) }}'">{{$emailAccount->port}}</td>
                                      <td onclick="window.location='{{ route('accountadmin.email-account.edit', ['id' => $emailAccount->pk_email_account]) }}'">{{$emailAccount->encryption_type}}</td>
                                        <td style="text-align:center;">
                                         <a href="/accountadmin/email-account/edit/{{$emailAccount->pk_email_account}}"><button class="btn btn-danger text-white">Edit</button></a>
                                         <a href="javascript:" onclick="form_alert('email-account-{{$emailAccount->pk_email_account}}', '{{'want to delete '}}{{'Email Account?'}}')"><button class="btn btn-danger text-white">Delete</button></a>
                                         <form action="{{route('accountadmin.email-account.delete',[$emailAccount->pk_email_account])}}" method="get" id="email-account-{{$emailAccount->pk_email_account}}">
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
