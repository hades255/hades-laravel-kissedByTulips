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
                        <li class="breadcrumb-item active"><a href="/superadmin/uom">Unit Of Measures</a></li>
                    </ol>
                    <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i class="fa fa-plus-circle"></i> {{isset($uom) && ($uom->pk_uom) ? 'Edit Uom' : 'Create New Uom'}}</button>
                </div>
            </div>
        </div>
        <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{isset($uom) && ($uom->pk_uom) ? 'Edit Uom' : 'Create New Uom'}}</h4>
                                <div class="tab-content br-n pn">
                                    <div id="navpills-1" class="tab-pane active">
                                        <div class="row">
                                          @if(Session::has('message'))
                                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                                          @endif
                                          <form class="form-horizontal mt-4 " method="post" action="{{isset($uom) && ($uom->pk_uom) ? '/superadmin/uom/update' : '/superadmin/uom/submit'}}">
                                            @csrf
                                            <div class="form-group">
                                                <label for="uom">Uom</label>
                                                <input type="text" name="uom" class="form-control @error('uom') is-invalid @enderror" value="{{isset($uom) && ($uom->uom)?$uom->uom:''}}">
                                                @error('uom')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="role">Select Frequency</label>
                                                <select class="form-select col-12 form-control @error('frequency') is-invalid @enderror" name="frequency">
                                                    <option value="">Choose Frequency...</option>
                                                    @foreach($frequencies as $frequency)
                                                        <option value="{{$frequency->pk_frequency}}" {{ isset($uom->pk_frequency) && ($uom->pk_frequency  == $frequency->pk_frequency) ? 'selected' : '' }}>{{$frequency->frequency}}</option>
                                                    @endforeach
                                                </select>
                                                @error('Frequency')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Active</label>
                                                    <input type="radio" name="active"  value="1" checked="checked" class="form-check-input" style="margin-left: 20px;">
                                                    <label class="form-check-label" for="customRadio11">Yes</label>
                                                    <input type="radio" name="active" value="0" {{ isset($uom) && ($uom->active=="0")? "checked" : "" }} class="form-check-input" style="margin-left: 20px;">
                                                    <label class="form-check-label" for="customRadio22">No</label>
                                            </div>
                                            <input type="hidden" name="pk_uom" class="form-control" value="{{isset($uom) && ($uom->pk_uom)?$uom->pk_uom:''}}">
                                            <a href="/superadmin/uom/back"><input class="btn btn-primary" type="button" value="Cancel"></a>
                                            <input class="btn btn-primary" type="submit" value="{{isset($uom) && ($uom->pk_uom)?'Update':'Submit'}}">
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
