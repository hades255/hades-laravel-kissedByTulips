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
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Customer Type</li>
                    </ol>
                    <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i class="fa fa-plus-circle"></i>{{ isset($customertype) && ($customertype->pk_customer_type) ? 'Edit Customer Type':'Create New Customer Type'}} </button>
                </div>
            </div>
        </div>
        <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{ isset($customertype) && ($customertype->pk_customer_type) ? 'Edit Customer Type':'Create New Customer Type'}}</h4>
                                <div class="tab-content br-n pn">
                                    <div id="navpills-1" class="tab-pane active">
                                        <div class="row">
                                          @if(Session::has('message'))
                                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                                          @endif
                                          <form class="form-horizontal mt-4 " method="post" action="{{ isset($customertype) && ($customertype->pk_customer_type) ? '/accountadmin/customer-type/update':'/accountadmin/customer-type/submit'}}">
                                            @csrf
                                            <div class="form-group">
                                                <label for="product_category">Customer Type</label>
                                                <input type="text" name="customer_type" class="form-control @error('customer_type') is-invalid @enderror" value="{{ isset($customertype) && ($customertype->customer_type) ?$customertype->customer_type: old('customer_type')}}">
                                                @error('customer_type')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Customer Type Code</label>
                                                <input type="text" name="customer_type_code" class="form-control @error('customer_type_code') is-invalid @enderror" value="{{ isset($customertype) && ($customertype->customer_type_code) ?$customertype->customer_type_code: old('customer_type_code')}}">
                                                @error('customer_type_code')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Active</label>
                                                    <input type="radio" name="active"  value="1" checked="checked" class="form-check-input" style="margin-left: 20px;">
                                                    <label class="form-check-label" for="customRadio11">Yes</label>
                                                    <input type="radio" name="active" value="0" {{ isset($customertype) && ($customertype->active=="0")? "checked" : "" }}  class="form-check-input" style="margin-left: 20px;">
                                                    <label class="form-check-label" for="customRadio22">No</label>
                                            </div>
                                            <input type="hidden" name="pk_account" value="{{isset($pk_account) ? $pk_account : ''}}" >
                                            <input type="hidden" name="pk_customer_type" value="{{ isset($customertype) && ($customertype->pk_customer_type) ? $customertype->pk_customer_type : ''}}" >
                                            <input class="btn btn-primary" type="button" value="Reset">
                                            <input class="btn btn-primary" type="submit" value="{{ isset($customertype) && ($customertype->pk_customer_type)? "Update" : "Submit" }}">
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
