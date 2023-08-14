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
                        <li class="breadcrumb-item active">Suggested Note</li>
                    </ol>
                    <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i class="fa fa-plus-circle"></i>{{ isset($SuggestedNote) && ($SuggestedNote->pk_suggested_note) ? 'Edit Suggested Note':'Create New Suggested Note'}} </button>
                </div>
            </div>
        </div>
        <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{ isset($SuggestedNote) && ($SuggestedNote->pk_suggested_note) ? 'Edit Suggested Note':'Create New Suggested Note'}}</h4>
                                <div class="tab-content br-n pn">
                                    <div id="navpills-1" class="tab-pane active">
                                        <div class="row">
                                          @if(Session::has('message'))
                                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                                          @endif
                                          <form class="form-horizontal mt-4 " method="post" action="{{ isset($SuggestedNote) && ($SuggestedNote->pk_suggested_note) ? '/accountadmin/suggested-note/update':'/accountadmin/suggested-note/submit'}}">
                                            @csrf
                                            <div class="form-group">
                                            <label for="event">Select Event</label>
                                              <select class="form-control form-select" name="event">
                                                <option value="">--Select--</option>
                                                @foreach($events as $event)
                                                <option value="{{$event->pk_event}}" {{ isset($SuggestedNote) && ($SuggestedNote->pk_event  == $event->pk_event) ? 'selected' : '' }}>{{$event->event}}</option>
                                                @endforeach
                                               </select>
                                                @error('event')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                              </div>
                                            <div class="form-group">
                                                <label for="product_category">Suggested Note</label>
                                                <textarea name="suggested_note" class="form-control @error('suggested_note') is-invalid @enderror">{{ isset($SuggestedNote) && ($SuggestedNote->suggested_note) ?$SuggestedNote->suggested_note: old('suggested_note')}}</textarea>
                                                @error('suggested_note')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ isset($SuggestedNote) && ($SuggestedNote->description) ?$SuggestedNote->description: old('description')}}">
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
                                                    <input type="radio" name="active" value="0" {{ isset($SuggestedNote) && ($SuggestedNote->active=="0")? "checked" : "" }}  class="form-check-input" style="margin-left: 20px;">
                                                    <label class="form-check-label" for="customRadio22">No</label>
                                            </div>
                                            <input type="hidden" name="pk_account" value="{{isset($pk_account) ? $pk_account : ''}}" >
                                            <input type="hidden" name="pk_suggested_note" value="{{ isset($SuggestedNote) && ($SuggestedNote->pk_suggested_note) ? $SuggestedNote->pk_suggested_note : ''}}" >
                                            <input class="btn btn-primary" type="button" value="Reset">
                                            <input class="btn btn-primary" type="submit" value="{{ isset($SuggestedNote) && ($SuggestedNote->pk_suggested_note)? "Update" : "Submit" }}">
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
