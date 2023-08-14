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
                <h4 class="text-themecolor">Email Template</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="/accountadmin">Home</a></li>
                        <li class="breadcrumb-item active"><a href="/accountadmin/text-template">Text Template</a></li>
                    </ol>
                    <a href="/accountadmin/text-template/add"> <button type="button" style="margin-top:-34px;" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i
                            class="fa fa-plus-circle"></i> Add Text Template</button></a>
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
                                        <th>Template Name</th>
                                        <th>SID</th>
                                        <th>Token</th>
                                        <th style="text-align:center;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($textTemplates as $textTemplate)
                                    <tr>
                                      <td onclick="window.location='{{ route('accountadmin.text-template.edit', ['id' => $textTemplate->pk_text_template]) }}'">{{$textTemplate->template_name}}</td>
                                      <td onclick="window.location='{{ route('accountadmin.text-template.edit', ['id' => $textTemplate->pk_text_template]) }}'">{{$textTemplate->sid}}</td>
                                      <td onclick="window.location='{{ route('accountadmin.text-template.edit', ['id' => $textTemplate->pk_text_template]) }}'">{{$textTemplate->token}}</td>
                                        <td style="text-align:center;">
                                         <a href="/accountadmin/text-template/edit/{{$textTemplate->pk_text_template}}"><button class="btn btn-danger text-white">Edit</button></a>
                                         <a href="javascript:" onclick="form_alert('text-template-{{$textTemplate->pk_text_template}}', '{{'want to delete '}}{{'Text Template?'}}')"><button class="btn btn-danger text-white">Delete</button></a>
                                         <form action="{{route('accountadmin.text-template.delete',[$textTemplate->pk_text_template])}}" method="get" id="text-template-{{$textTemplate->pk_text_template}}">
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
