@extends('layouts.backend_new')

@section('content')
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Dashboard</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="/accountadmin">Home</a></li>
                        <li class="breadcrumb-item active"><a href="/accountadmin/payment-gateway">Payment Gateway</a></li>
                    </ol>
                    <!-- <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i class="fa fa-plus-circle"></i>{{ isset($payment) && ($payment->pk_account_admin_payment_gateways) ? 'Edit Payment Gateway':'Create New Payment Gateway'}} </button> -->
                </div>
            </div>
        </div>
        <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title" style="text-align:center;">{{ isset($payment) && ($payment->pk_account_admin_payment_gateways) ? 'Edit Payment Gateway':'Create New Payment Gateway'}}</h4>
                                <div class="tab-content br-n pn">
                                    <div id="navpills-1" class="tab-pane active">
                                        <div class="row">
                                          @if(Session::has('message'))
                                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                                          @endif
                                          <form class="form-horizontal mt-4 " method="post" action="/accountadmin/payment-gateway/submit" style="margin-left:550px;">
                                            @csrf
                                            <div class="form-group">
                                                <label for="merchant_login_id">Merchant Login ID</label>
                                                <input type="text" name="merchant_login_id" class="form-control @error('merchant_login_id') is-invalid @enderror" value="{{ isset($payment) && ($payment->merchant_login_id) ?$payment->merchant_login_id: old('merchant_login_id')}}" required="">
                                                @error('merchant_login_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="merchant_transaction_key">Merchant Transaction Key</label>
                                                <input type="text" name="merchant_transaction_key" class="form-control @error('merchant_transaction_key') is-invalid @enderror" value="{{ isset($payment) && ($payment->merchant_transaction_key) ?$payment->merchant_transaction_key: old('merchant_transaction_key')}}" required="">
                                                @error('merchant_transaction_key')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="other_key">Merchant Client Key</label>
                                                <input type="text" name="other_key" class="form-control @error('other_key') is-invalid @enderror" value="{{ isset($payment) && ($payment->other_key) ?$payment->other_key: old('other_key')}}">
                                                @error('other_key')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Active</label>
                                                    <input type="radio" name="active"  value="1" checked="checked" class="form-check-input" >
                                                    <label class="form-check-label" for="customRadio11" style="margin-left: 20px;">Yes</label>
                                                    <input type="radio" name="active" value="0" {{ isset($payment) && ($payment->active=="0")? "checked" : "" }}  class="form-check-input" >
                                                    <label class="form-check-label" for="customRadio22" style="margin-left: 20px;">No</label>
                                            </div>
                                            <input type="hidden" name="pk_account" value="{{isset($pk_account) ? $pk_account : ''}}" >
                                            <input type="hidden" name="pk_account_admin_payment_gateways" value="{{ isset($payment) && ($payment->pk_account_admin_payment_gateways) ?$payment->pk_account_admin_payment_gateways : ''}}" >
                                            <a href="/accountadmin/payment-gateway/back"><input class="btn btn-primary" type="button" value="Cancel"></a>
                                            <input class="btn btn-primary" type="submit" value="{{ isset($payment) && ($payment->pk_account_admin_payment_gateways)? "Update" : "Submit" }}">
                                          </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
</div>

@endsection
