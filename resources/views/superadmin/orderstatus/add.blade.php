@extends('layouts.dashboard')

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
                        <li class="breadcrumb-item"><a href="/superadmin">Home</a></li>
                        <li class="breadcrumb-item active"><a href="/superadmin/order-status">Order Status</a></li>
                    </ol>
                    <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i class="fa fa-plus-circle"></i> {{isset($order_status) && ($order_status->pk_order_status) ? 'Edit Order Status' : 'Create New Order Status'}}</button>
                </div>
            </div>
        </div>
        <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{isset($order_status) && ($order_status->pk_order_status) ? 'Edit Order Status' : 'Create New Order Status'}}</h4>
                                <div class="tab-content br-n pn">
                                    <div id="navpills-1" class="tab-pane active">
                                        <div class="row">
                                          @if(Session::has('message'))
                                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                                          @endif
                                          <form class="form-horizontal mt-4 " method="post" action="{{isset($order_status) && ($order_status->pk_order_status) ? '/superadmin/order-status/update' : '/superadmin/order-status/submit'}}">
                                            @csrf
                                            <div class="form-group">
                                                <label for="order_status">Order Status</label>
                                                <input type="text" name="order_status" class="form-control @error('order_status') is-invalid @enderror" value="{{isset($order_status) && ($order_status->pk_order_status)?$order_status->order_status:''}}">
                                                @error('order_status')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{isset($order_status) && ($order_status->pk_order_status)?$order_status->description:''}}">
                                                @error('description')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Active</label>
                                                    <input type="radio" name="active"  value="1" checked="checked" class="form-check-input" style="margin-left: 20px;">
                                                    <label class="form-check-label" for="customRadio11">Yes</label>
                                                    <input type="radio" name="active" value="0" {{ isset($order_status) && ($order_status->active=="0")? "checked" : "" }} class="form-check-input" style="margin-left: 20px;">
                                                    <label class="form-check-label" for="customRadio22">No</label>
                                            </div>
                                            <input type="hidden" name="pk_order_status" class="form-control" value="{{isset($order_status) && ($order_status->pk_order_status)?$order_status->pk_order_status:''}}">
                                            <a href="/superadmin/order-status/back"><input class="btn btn-primary" type="button" value="Cancel"></a>
                                            <input class="btn btn-primary" type="submit" value="{{isset($order_status) && ($order_status->pk_order_status)?'Update':'Submit'}}">
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
