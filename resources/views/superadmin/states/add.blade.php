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
                        <li class="breadcrumb-item active"><a href="/superadmin/states">State</a></li>
                    </ol>
                    <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i class="fa fa-plus-circle"></i> {{isset($country) && ($country->pk_country) ? 'Edit Country' : 'Create New Country'}}</button>
                </div>
            </div>
        </div>
        <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{isset($state) && ($state->pk_states) ? 'Edit State' : 'Create New State'}}</h4>
                                <div class="tab-content br-n pn">
                                    <div id="navpills-1" class="tab-pane active">
                                        <div class="row">
                                          @if(Session::has('message'))
                                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                                          @endif
                                          <form class="form-horizontal mt-4 " method="post" action="{{isset($state) && ($state->pk_states) ? '/superadmin/states/update' : '/superadmin/states/submit'}}">
                                            @csrf
                                            <div class="form-group">
                                                <label for="role">Select Country</label>
                                                <select class="form-select col-12 form-control @error('pk_country') is-invalid @enderror" name="pk_country">
                                                    <option value="">Choose Country...</option>
                                                        <option value="1" {{ isset($state->pk_country) && ($state->pk_country  == 1) ? 'selected' : '' }}>USA</option>
                                                </select>
                                                @error('pk_country')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="state_code">State Code</label>
                                                <input type="text" name="state_code" class="form-control @error('state_code') is-invalid @enderror" value="{{isset($state) && ($state->state_code)?$state->state_code:''}}">
                                                @error('state_code')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="country_name">State Name</label>
                                                <input type="text" name="state_name" class="form-control @error('state_name') is-invalid @enderror" value="{{isset($state) && ($state->state_name)?$state->state_name:''}}">
                                                @error('state_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Active</label>
                                                    <input type="radio" name="active"  value="1" checked="checked" class="form-check-input" style="margin-left: 20px;">
                                                    <label class="form-check-label" for="customRadio11">Yes</label>
                                                    <input type="radio" name="active" value="0" {{ isset($state) && ($state->active=="0")? "checked" : "" }} class="form-check-input" style="margin-left: 20px;">
                                                    <label class="form-check-label" for="customRadio22">No</label>
                                            </div>
                                            <input type="hidden" name="pk_states" class="form-control" value="{{isset($state) && ($state->pk_states)?$state->pk_states:''}}">
                                            <a href="/superadmin/states/back"><input class="btn btn-primary" type="button" value="Cancel"></a>
                                            <input class="btn btn-primary" type="submit" value="{{isset($state) && ($state->pk_states)?'Update':'Submit'}}">
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
