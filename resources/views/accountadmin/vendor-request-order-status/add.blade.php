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
                        <li class="breadcrumb-item active"><a href="/accountadmin/vendor-request-order-status">Purchase Orders</a></li>
                    </ol>
                    <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white" style="margin-top: -34px;"><i class="fa fa-plus-circle"></i>{{ isset($vendorRequest) && ($vendorRequest->pk_purchase_order_status) ? 'Edit Purchase Order Status':'Create New Purchase Order Status'}} </button>
                </div>
            </div>
        </div>
        <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title" style="text-align: center;">{{ isset($vendorRequest) && ($vendorRequest->pk_purchase_order_status) ? 'Edit Purchase Order Status':'Create New Purchase Order Status'}}</h4>
                                <div class="tab-content br-n pn">
                                    <div id="navpills-1" class="tab-pane active">
                                        <div class="row">
                                        <div class="col-md-4"></div>
                                          @if(Session::has('message'))
                                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                                          @endif
                                          <form class="form-horizontal mt-4 " method="post" action="/accountadmin/vendor-request-order-status/submit" style="margin-left: 110px;">
                                            @csrf
                                            <div class="form-group">
                                                <label for="styles">Purchase Order Status</label>
                                                <input type="text" name="purchase_order_status" class="form-control @error('purchase_order_status') is-invalid @enderror" value="{{ isset($vendorRequest) && ($vendorRequest->purchase_order_status) ?$vendorRequest->purchase_order_status: old('purchase_order_status')}}">
                                                @error('purchase_order_status')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ isset($vendorRequest) && ($vendorRequest->description) ?$vendorRequest->description: old('description')}}">
                                                @error('description')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Active</label>
                                                    <input type="radio" name="active"  value="1" checked="checked" class="form-check-input">
                                                    <label class="form-check-label" for="customRadio11" style="margin-left: 20px;">Yes</label>
                                                    <input type="radio" name="active" value="0" {{ isset($VaseColor) && ($VaseColor->active=="0")? "checked" : "" }}  class="form-check-input">
                                                    <label class="form-check-label" for="customRadio22" style="margin-left: 20px;">No</label>
                                            </div>
                                            <input type="hidden" name="pk_account" value="{{isset($pk_account) ? $pk_account : ''}}" >
                                            <input type="hidden" name="pk_purchase_order_status" value="{{ isset($vendorRequest) && ($vendorRequest->pk_purchase_order_status) ?$vendorRequest->pk_purchase_order_status : ''}}" >
                                            <a href="/accountadmin/vendor-request-order-status/back"><input class="btn btn-primary" type="button" value="Cancel"></a>
                                            <input class="btn btn-primary" type="submit" value="{{ isset($vendorRequest) && ($vendorRequest->pk_purchase_order_status)? "Update" : "Submit" }}">
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
