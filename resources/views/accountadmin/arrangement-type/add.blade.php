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
                        <li class="breadcrumb-item active">Arrangement Type</li>
                    </ol>
                    <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white" style="margin-top: -34px;"><i class="fa fa-plus-circle"></i>{{ isset($ArrangementType) && ($ArrangementType->pk_arrangement_type) ? 'Edit Arrangement Type':'Create New Arrangement Type'}} </button>
                </div>
            </div>
        </div>
        <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title" style="text-align:center;">{{ isset($ArrangementType) && ($ArrangementType->pk_arrangement_type) ? 'Edit Arrangement Type':'Create New Arrangement Type'}}</h4>
                                <div class="tab-content br-n pn">
                                    <div id="navpills-1" class="tab-pane active">
                                        <div class="row">
                                          @if(Session::has('message'))
                                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                                          @endif
                                          <div class="col-md-4"></div>
                                          <form class="form-horizontal mt-4 " method="post" action="{{ isset($ArrangementType) && ($ArrangementType->pk_arrangement_type) ? '/accountadmin/arrangement-type/update':'/accountadmin/arrangement-type/submit'}}"     style="margin-left: 110px;">
                                            @csrf
                                            <div class="form-group">
                                                <label for="product_category">Arrangement Type</label>
                                                <input type="text" name="arrangement_type" class="form-control @error('arrangement_type') is-invalid @enderror" value="{{ isset($ArrangementType) && ($ArrangementType->arrangement_type) ?$ArrangementType->arrangement_type: old('arrangement_type')}}">
                                                @error('arrangement_type')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ isset($ArrangementType) && ($ArrangementType->description) ?$ArrangementType->description: old('description')}}">
                                                @error('description')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            @if(isset($ArrangementType) && ($ArrangementType->arrangement_type == 'Custom'))
                                            <div class="form-group">
                                                <label for="minimum_amount">Minimum</label>
                                                <input type="number" name="minimum_amount" class="form-control @error('minimum_amount') is-invalid @enderror" value="{{ isset($ArrangementType) && ($ArrangementType->minimum_amount) ?$ArrangementType->minimum_amount: old('minimum_amount')}}" required>
                                                @error('minimum_amount')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="maximum_amount">Maximum</label>
                                                <input type="number" name="maximum_amount" class="form-control @error('maximum_amount') is-invalid @enderror" value="{{ isset($ArrangementType) && ($ArrangementType->maximum_amount) ?$ArrangementType->maximum_amount: old('maximum_amount')}}" required>
                                                @error('maximum_amount')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            @endif
                                            <div class="form-group">
                                                <label class="form-label">Active</label>
                                                    <input type="radio" name="active"  value="1" checked="checked" class="form-check-input">
                                                    <label class="form-check-label" for="customRadio11" style="margin-left: 20px;">Yes</label>
                                                    <input type="radio" name="active" value="0" {{ isset($ArrangementType) && ($ArrangementType->active=="0")? "checked" : "" }}  class="form-check-input">
                                                    <label class="form-check-label" for="customRadio22" style="margin-left: 20px;">No</label>
                                            </div>
                                            <input type="hidden" name="pk_account" value="{{isset($pk_account) ? $pk_account : ''}}" >
                                            <input type="hidden" name="pk_arrangement_type" value="{{ isset($ArrangementType) && ($ArrangementType->pk_arrangement_type) ? $ArrangementType->pk_arrangement_type : ''}}" >
                                            <input class="btn btn-primary" type="button" value="Reset">
                                            <input class="btn btn-primary" type="submit" value="{{ isset($ArrangementType) && ($ArrangementType->pk_arrangement_type)? "Update" : "Submit" }}">
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
