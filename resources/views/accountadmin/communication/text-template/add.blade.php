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
                        <li class="breadcrumb-item active"><a href="/accountadmin/text-template">Text Template</a></li>
                    </ol>
                    <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white" style="margin-top:-34px;"><i class="fa fa-plus-circle"></i>{{ isset($emailTemplate) && ($emailTemplate->pk_email_template) ? 'Edit Email Template':'Create New Email Template'}} </button>
                </div>
            </div>
        </div>
        <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title" style="text-align:center;">{{ isset($textTemplate) && ($textTemplate->pk_text_template) ? 'Edit Text Template':'Create New Text Template'}}</h4>
                                <div class="tab-content br-n pn">
                                    <div id="navpills-1" class="tab-pane active">
                                        <div class="row">
                                          @if(Session::has("success"))
                                              <div class="alert alert-success alert-dismissible"><button type="button" class="close">&times;</button>{{Session::get('success')}}</div>
                                          @elseif(Session::has("failed"))
                                              <div class="alert alert-danger alert-dismissible"><button type="button" class="close">&times;</button>{{Session::get('failed')}}</div>
                                          @elseif(Session::has("error"))
                                              <div class="alert alert-danger alert-dismissible"><button type="button" class="close">&times;</button>{{Session::get('error')}}</div>
                                          @endif
                                          <form class="form-horizontal mt-4" style="margin-left:550px;" method="post" action="/accountadmin/text-template/submit" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="product_category">Template Name</label>
                                                <input type="text" name="template_name" class="form-control @error('template_name') is-invalid @enderror" value="{{ isset($textTemplate) && ($textTemplate->template_name) ?$textTemplate->template_name: old('template_name')}}">
                                                @error('template_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                            <label for="vase_type">Select Text Setting</label>
                                              <select class="form-control form-select" name="text_settings">
                                                @foreach($textSettings as $textSetting)
                                                <option value="{{$textSetting->pk_text_settings}}" {{ isset($textTemplate) && ($textTemplate->pk_text_settings  == $textSetting->pk_text_settings) ? 'selected' : '' }}>{{$textSetting->sid}}</option>
                                                @endforeach
                                               </select>
                                                @error('text_settings')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                              </div>
                                            <div class="form-group">
                                                <label for="description">Content</label>
                                                <input type="text" name="content" class="form-control @error('content') is-invalid @enderror" value="{{ isset($textTemplate) && ($textTemplate->content) ?$textTemplate->content: old('content')}}">
                                                @error('content')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Active</label>
                                                    <input type="radio" name="active"  value="1" checked="checked" class="form-check-input">
                                                    <label class="form-check-label" for="customRadio11"  style="margin-left: 20px;">Yes</label>
                                                    <input type="radio" name="active" value="0" {{ isset($textTemplate) && ($textTemplate->active=="0")? "checked" : "" }}  class="form-check-input">
                                                    <label class="form-check-label" for="customRadio22"  style="margin-left: 20px;">No</label>
                                            </div>
                                            <input type="hidden" name="pk_account" value="{{isset($pk_account) ? $pk_account : ''}}" >
                                            <input type="hidden" name="pk_text_template" value="{{ isset($textTemplate) && ($textTemplate->pk_text_template) ?$textTemplate->pk_text_template : ''}}" >
                                            <a href="/accountadmin/text-template/back"><input class="btn btn-primary" type="button" value="Cancel"></a>
                                            <input class="btn btn-primary" type="submit" value="{{ isset($textTemplate) && ($textTemplate->pk_text_template)? "Update" : "Submit" }}">
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
