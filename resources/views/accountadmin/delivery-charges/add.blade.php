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
                        <li class="breadcrumb-item active"><a href="/accountadmin/delivery-charges">Delivery Charges</a></li>
                    </ol>
                    <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white" style="margin-top:-34px;"><i class="fa fa-plus-circle"></i>{{ isset($data) && ($data->pk_delivery_charges) ? 'Edit Delivery Charges':'Create Delivery Charge'}} </button>
                </div>
            </div>
        </div>
        <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title" style="text-align: center;">{{ isset($data) && ($data->pk_delivery_charges) ? 'Edit Delivery Charge':'Create Delivery Charge'}}</h4>
                                <div class="tab-content br-n pn">
                                    <div id="navpills-1" class="tab-pane active">
                                        <div class="row">
                                          @if(Session::has('message'))
                                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                                          @endif
                                          <form class="form-horizontal mt-4 " style="margin-left: 540px;" method="post" action="/accountadmin/delivery-charges/submit" enctype="multipart/form-data">
                                            @csrf

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="miles_from">Miles From</label>
                                                        <input type="number" name="miles_from" class="form-control @error('miles_from') is-invalid @enderror" value="{{ isset($data) && ($data->miles_from) ?$data->miles_from: old('miles_from')}}">
                                                        @error('miles_from')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="miles_to">Miles To</label>
                                                        <input type="number" name="miles_to" class="form-control @error('miles_to') is-invalid @enderror" value="{{ isset($data) && ($data->miles_to) ?$data->miles_to: old('miles_to')}}">
                                                        @error('miles_to')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="cost">Cost</label>
                                                        <input type="text" name="cost" class="form-control @error('cost') is-invalid @enderror" value="{{ isset($data) && ($data->cost) ?$data->cost: old('cost')}}">
                                                        @error('cost')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <input type="hidden" name="pk_account" value="{{auth()->user()->pk_account}}">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Active</label>
                                                        <input type="radio" name="active"  value="1" id="customRadio11" checked="checked" class="form-check-input">
                                                        <label class="form-check-label" for="customRadio11" style="margin-left: 20px;">Yes</label>
                                                        <input type="radio" name="active" value="0" id="customRadio22" {{ isset($data) && ($data->active=="0")? "checked" : "" }}  class="form-check-input" >
                                                        <label class="form-check-label" for="customRadio22" style="margin-left: 20px;">No</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="hidden" name="pk_delivery_charges" value="{{ isset($data) && ($data->pk_delivery_charges) ?$data->pk_delivery_charges : ''}}" >
                                             <input class="btn btn-primary" type="submit" value="{{ isset($data) && ($data->pk_delivery_charges)? "Update" : "Submit" }}">
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
