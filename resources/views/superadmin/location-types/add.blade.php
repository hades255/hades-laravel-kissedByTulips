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
                        <li class="breadcrumb-item active"><a href="/superadmin/location-types">Location Type</a></li>
                    </ol>
                    <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i class="fa fa-plus-circle"></i>{{ isset($locationtype) && ($locationtype->pk_location_types) ? 'Edit Location Type':'Create New Location Type'}} </button>
                </div>
            </div>
        </div>
        <div class="row"> 


                    <div class="col-md-12">

                        
                        @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                        @endif


                        <div class="card">

                        
                            <div class="card-body">
                                <h4 class="card-title">{{ isset($locationtype) && ($locationtype->pk_location_types) ? 'Edit Location Type':'Create New Location Type'}}</h4>
                                
                                
    

                                <form class="form-horizontal mt-4 " method="post" action="/superadmin/location-types/submit">
                                    @csrf
                                
                                    <div class="tab-content"> 

                                        <div class="tab-pane p-20 active" id="locationlist" role="tabpanel">
    
                                            <div class="row">   
                                            
                                                <div class="form-group">
                                                    <label for="styles">Location Type</label>
                                                    <input type="text" name="location_types" class="form-control @error('location_types') is-invalid @enderror" value="{{ isset($locationtype) && ($locationtype->location_types) ?$locationtype->location_types: old('location_types')}}">
                                                    @error('location_types')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="description">Description</label>
                                                    <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ isset($locationtype) && ($locationtype->description) ?$locationtype->description: old('description')}}">
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
                                                        <input type="radio" name="active" value="0" {{ isset($locationtype) && ($locationtype->active=="0")? "checked" : "" }}  class="form-check-input" style="margin-left: 20px;">
                                                        <label class="form-check-label" for="customRadio22">No</label>
                                                </div>  
                                                <input type="hidden" name="pk_location_types" value="{{ isset($locationtype) && ($locationtype->pk_location_types) ?$locationtype->pk_location_types : ''}}" >
                                            </div>
                                        </div> 

                                    </div>

                                    <div class="row">  
                                        <div class="col-md-12 m-l-20">
                                            <a href="/superadmin/location-types/back"><input class="btn btn-primary" type="button" value="Cancel"></a>
                                            <input class="btn btn-primary" type="submit" value="{{ isset($locationtype) && ($locationtype->pk_location_types)? "Update" : "Submit" }}">
                                        </div>
                                    </div> 

                                    

                                </form> 
                                

                                
                            </div>
                        </div>
                    </div>
                </div>
    </div>
</div> 

@endsection