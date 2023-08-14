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
                        <li class="breadcrumb-item active"><a href="/accountadmin/email-template">Email Template</a></li>
                    </ol>
                    <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white" style="margin-top:-34px;"><i class="fa fa-plus-circle"></i>{{ isset($emailTemplate) && ($emailTemplate->pk_email_template) ? 'Edit Email Template':'Create New Email Template'}} </button>
                </div>
            </div>
        </div>
        <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"  style="text-align:center;">{{ isset($emailTemplate) && ($emailTemplate->pk_email_template) ? 'Edit Email Template':'Create New Email Template'}}</h4>
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
                                          <form class="form-horizontal mt-4" style="margin-left:550px;" method="post" action="/accountadmin/email-template/submit" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="product_category">Template Name</label>
                                                <input type="text" name="template_name" class="form-control @error('template_name') is-invalid @enderror" value="{{ isset($emailTemplate) && ($emailTemplate->template_name) ?$emailTemplate->template_name: old('template_name')}}">
                                                @error('template_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                            <label for="vase_type">Select Email Acocunt</label>
                                              <select class="form-control form-select" name="email_account">
                                                @foreach($emailAccounts as $emailAccount)
                                                <option value="{{$emailAccount->pk_email_account}}" {{ isset($emailTemplate) && ($emailTemplate->pk_email_account  == $emailAccount->pk_email_account) ? 'selected' : '' }}>{{$emailAccount->user_name}}</option>
                                                @endforeach
                                               </select>
                                                @error('email_account')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                              </div>
                                            <div class="form-group">
                                                <label for="description">Subject</label>
                                                <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror" value="{{ isset($emailTemplate) && ($emailTemplate->subject) ?$emailTemplate->subject: old('subject')}}">
                                                @error('subject')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Content</label>
                                                <input type="text" name="content" class="form-control @error('content') is-invalid @enderror" value="{{ isset($emailTemplate) && ($emailTemplate->subject) ?$emailTemplate->content: old('content')}}">
                                                @error('content')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Active</label>
                                                    <input type="radio" name="active"  value="1" checked="checked" class="form-check-input">
                                                    <label class="form-check-label" for="customRadio11" style="margin-left: 20px;">Yes</label>
                                                    <input type="radio" name="active" value="0" {{ isset($emailTemplate) && ($emailTemplate->active=="0")? "checked" : "" }}  class="form-check-input">
                                                    <label class="form-check-label" for="customRadio22" style="margin-left: 20px;">No</label>
                                            </div>
                                            <input type="hidden" name="pk_account" value="{{isset($pk_account) ? $pk_account : ''}}" >
                                            <input type="hidden" name="pk_email_template" value="{{ isset($emailTemplate) && ($emailTemplate->pk_email_template) ?$emailTemplate->pk_email_template : ''}}" >
                                            <a href="/accountadmin/email-template/back"><input class="btn btn-primary" type="button" value="Cancel"></a>
                                            <input class="btn btn-primary" type="submit" value="{{ isset($emailTemplate) && ($emailTemplate->pk_email_template)? "Update" : "Submit" }}">
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
