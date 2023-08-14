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
                <h4 class="text-themecolor">Text Account</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="/accountadmin">Home</a></li>
                        <li class="breadcrumb-item active"><a href="/accountadmin/text-account">Text Account</a></li>
                    </ol>
                    <a href="/accountadmin/text-account/add"> <button type="button" style="margin-top:-34px;" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i
                            class="fa fa-plus-circle"></i> Add Text Account</button></a>
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
                                        <th>Sid</th>
                                        <th>Token</th>
                                        <th>From No.</th>
                                        <th style="text-align:center;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($textAccounts as $textAccount)
                                    <tr>
                                      <td onclick="window.location='{{ route('accountadmin.text-account.edit', ['id' => $textAccount->pk_text_settings]) }}'">{{$textAccount->sid}}</td>
                                      <td onclick="window.location='{{ route('accountadmin.text-account.edit', ['id' => $textAccount->pk_text_settings]) }}'">{{$textAccount->token}}</td>
                                      <td onclick="window.location='{{ route('accountadmin.text-account.edit', ['id' => $textAccount->pk_text_settings]) }}'">{{$textAccount->from_no}}</td>
                                        <td style="text-align:center;">
                                         <a href="/accountadmin/text-account/edit/{{$textAccount->pk_text_settings}}"><button class="btn btn-danger text-white">Edit</button></a>
                                         <a href="javascript:" onclick="form_alert('text-account-{{$textAccount->pk_text_settings}}', '{{'want to delete '}}{{'Text Account?'}}')"><button class="btn btn-danger text-white">Delete</button></a>
                                         <form action="{{route('accountadmin.text-account.delete',[$textAccount->pk_text_settings])}}" method="get" id="text-account-{{$textAccount->pk_text_settings}}">
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
