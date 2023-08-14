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
                        <li class="breadcrumb-item active"><a href="/accountadmin/vase-colors">Vase Colors</a></li>
                    </ol>
                    <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white" style="margin-top: -34px;"><i class="fa fa-plus-circle"></i>{{ isset($VaseColor) && ($VaseColor->pk_vase_colors) ? 'Edit Vase Color':'Create New Vase Color'}} </button>
                </div>
            </div>
        </div>
        <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title" style="text-align: center;">{{ isset($VaseColor) && ($VaseColor->pk_vase_colors) ? 'Edit Vase Color':'Create New Vase Color'}}</h4>
                                <div class="tab-content br-n pn">
                                    <div id="navpills-1" class="tab-pane active">
                                        <div class="row">
                                        <div class="col-md-4"></div>
                                          @if(Session::has('message'))
                                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                                          @endif
                                          <form class="form-horizontal mt-4 " method="post" action="/accountadmin/vase-colors/submit" style="margin-left: 110px;">
                                            @csrf
                                            <div class="form-group">
                                            <label for="vase_type">Select Vase Type</label>
                                              <select class="form-control form-select" name="vase_type">
                                                @foreach($vaseTypes as $vaseType)
                                                <option value="{{$vaseType->pk_vase_type}}" {{ isset($VaseColor) && ($VaseColor->pk_vase_type  == $vaseType->pk_vase_type) ? 'selected' : '' }}>{{$vaseType->vase_type}}</option>
                                                @endforeach
                                               </select>
                                                @error('vase_type')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                              </div>
                                            <div class="form-group">
                                                <label for="styles">Vase Color</label>
                                                <input type="text" name="vase_colors" class="form-control @error('vase_colors') is-invalid @enderror" value="{{ isset($VaseColor) && ($VaseColor->vase_colors) ?$VaseColor->vase_colors: old('vase_colors')}}">
                                                @error('vase_colors')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ isset($VaseColor) && ($VaseColor->description) ?$VaseColor->description: old('description')}}">
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
                                            <input type="hidden" name="pk_vase_colors" value="{{ isset($VaseColor) && ($VaseColor->pk_vase_colors) ?$VaseColor->pk_vase_colors : ''}}" >
                                            <a href="/accountadmin/vase-colors/back"><input class="btn btn-primary" type="button" value="Cancel"></a>
                                            <input class="btn btn-primary" type="submit" value="{{ isset($VaseColor) && ($VaseColor->pk_vase_colors)? "Update" : "Submit" }}">
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
