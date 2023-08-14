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
                    <h4 class="text-themecolor">Sale Types</h4>
                </div>
                <div class="col-md-7 align-self-center text-end">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="/accountadmin">Home</a></li>
                            <li class="breadcrumb-item active">
                                <a href="{{ route('accountadmin.sale-types.index') }}">
                                    Sale Types
                                </a>
                            </li>
                        </ol>
                        <a href="{{ route('accountadmin.sale-types.create') }}">
                            <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"
                                    style="margin-top: -34px;"><i
                                    class="fa fa-plus-circle"></i> Create New
                            </button>
                        </a>
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
                            @if(Session::has('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ Session::get('success') }}
                                </div>
                            @endif
                            <div class="table-responsive m-t-40">
                                <table id="example23"
                                       class="display nowrap table table-hover table-striped border"
                                       cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Sale Types</th>
                                        <th style="text-align:center;">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($saleTypes as $saleType)
                                        <tr>
                                            <td onclick="window.location='{{ route('accountadmin.sale-types.edit', $saleType->pk_sales_type) }}'">
                                                {{ $saleType->sale_type }}
                                            </td>
                                            <td style="text-align:center;">
                                                <a href="{{ route('accountadmin.sale-types.edit', $saleType->pk_sales_type) }}">
                                                    <button class="btn btn-danger text-white">Edit</button>
                                                </a>
                                                <button type="button" class="btn btn-danger text-white"
                                                        onclick="form_alert('sale-type-{{ $saleType->pk_sales_type }}', '{{'want to delete '}}{{$saleType->sale_type}}{{' Sale Type?'}}')">
                                                    Delete
                                                </button>
                                                <form
                                                    action="{{ route('accountadmin.sale-types.destroy', $saleType->pk_sales_type) }}"
                                                    method="POST" id="sale-type-{{$saleType->pk_sales_type}}">
                                                    @csrf
                                                    @method("DELETE")
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
