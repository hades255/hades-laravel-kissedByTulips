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
                <h4 class="text-themecolor">Payment Gateway</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                      <li class="breadcrumb-item"><a href="/accountadmin">Home</a></li>
                      <li class="breadcrumb-item active"><a href="/accountadmin/payment-gateway">Payment Gateway</a></li>
                    </ol>
                    <a href="/accountadmin/payment-gateway/add"> <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white" style="margin-top:-34px;"><i
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
                                        <th>Merchant Login ID</th>
                                        <th>Merchant Transaction Key</th>
                                        <th>Merchant Client Key</th>
                                        <th style="text-align:center;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($payments as $payment)
                                    <tr>
                                      <td onclick="window.location='{{ route('accountadmin.payment.edit', ['id' => $payment->pk_account_admin_payment_gateways]) }}'">{{$payment->merchant_login_id}}</td>
                                      <td onclick="window.location='{{ route('accountadmin.payment.edit', ['id' => $payment->pk_account_admin_payment_gateways]) }}'">{{$payment->merchant_transaction_key}}</td>
                                      <td onclick="window.location='{{ route('accountadmin.payment.edit', ['id' => $payment->pk_account_admin_payment_gateways]) }}'">{{$payment->other_key}}</td>
                                        <td style="text-align:center;">
                                         <a href="/accountadmin/payment-gateway/edit/{{$payment->pk_account_admin_payment_gateways}}"><button class="btn btn-danger text-white">Edit</button></a>
                                         <a href="javascript:" onclick="form_alert('payment-{{$payment->pk_account_admin_payment_gateways}}', '{{'want to delete '}}{{$payment->merchant_login_id}}{{' Merchant?'}}')"><button class="btn btn-danger text-white">Delete</button></a>
                                         <form action="{{route('accountadmin.payment.delete',[$payment->pk_account_admin_payment_gateways])}}" method="get" id="payment-{{$payment->pk_account_admin_payment_gateways}}">
                                         @csrf
                                         </form>
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
