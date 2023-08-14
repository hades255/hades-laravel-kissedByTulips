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
                        <li class="breadcrumb-item active"><a href="/accountadmin/email-setting">Email Account</a></li>
                    </ol>
                    <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white" style="margin-top:-34px;"><i class="fa fa-plus-circle"></i>{{ isset($emailAccount) && ($emailAccount->pk_email_account) ? 'Edit Email Account':'Create New Email Account'}} </button>
                </div>
            </div>
        </div>
        <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title" style="text-align:center;">{{ isset($emailAccount) && ($emailAccount->pk_email_account) ? 'Edit Email Account':'Create New Email Account'}}</h4>
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
                                          <form class="form-horizontal mt-4 "  style="margin-left:550px;" method="post" action="{{isset($emailAccount) && ($emailAccount->pk_email_account) ? '/accountadmin/email-account/update' : '/accountadmin/email-account/submit'}}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="product_category">Host</label>
                                                <input type="text" name="host" class="form-control @error('host') is-invalid @enderror" value="{{ isset($emailAccount) && ($emailAccount->host) ?$emailAccount->host: old('host')}}">
                                                @error('host')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Port</label>
                                                <input type="text" name="port" class="form-control @error('port') is-invalid @enderror" value="{{ isset($emailAccount) && ($emailAccount->port) ?$emailAccount->port: old('port')}}">
                                                @error('port')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Encryption Type</label>
                                                <select class="form-control form-select" name="encryption_type">
                                                  <option value="tls" {{ isset($emailAccount) && ($emailAccount->encryption_type=="tls")? "selected" : "" }}>TLS</option>
                          												<option value="ssl" {{ isset($emailAccount) && ($emailAccount->encryption_type=="ssl")? "selected" : "" }}>SSL</option>
                                                 </select>
                                                @error('encryption_type')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="description">UserName</label>
                                                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ isset($emailAccount) && ($emailAccount->user_name) ?$emailAccount->user_name: old('username')}}">
                                                @error('username')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            @if(!isset($emailAccount) && empty($emailAccount->password))
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Your Email Password">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            @endif

                                            <div class="form-group">
                                                <label class="form-label">Active</label>
                                                    <input type="radio" name="active"  value="1" checked="checked" class="form-check-input" >
                                                    <label class="form-check-label" for="customRadio11" style="margin-left: 20px;">Yes</label>
                                                    <input type="radio" name="active" value="0" {{ isset($emailAccount) && ($emailAccount->active=="0")? "checked" : "" }}  class="form-check-input">
                                                    <label class="form-check-label" for="customRadio22" style="margin-left: 20px;">No</label>
                                            </div>
                                            <input type="hidden" name="pk_account" value="{{isset($pk_account) ? $pk_account : ''}}" >
                                            <input type="hidden" name="pk_email_account" value="{{ isset($emailAccount) && ($emailAccount->pk_email_account) ?$emailAccount->pk_email_account : ''}}" >
                                            <a href="/accountadmin/email-account/back"><input class="btn btn-primary" type="button" value="Cancel"></a>
                                            <input class="btn btn-primary" type="submit" value="{{ isset($emailAccount) && ($emailAccount->pk_email_account)? "Update" : "Submit" }}">
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
