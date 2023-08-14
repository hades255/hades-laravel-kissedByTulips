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
                        <li class="breadcrumb-item active"><a href="/accountadmin/text-account">Text Account</a></li>
                    </ol>
                    <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white" style="margin-top:-34px;"><i class="fa fa-plus-circle"></i>{{ isset($textAccount) && ($textAccount->pk_text_settings) ? 'Edit Text Settings':'Create New Text Settings'}} </button>
                </div>
            </div>
        </div>
        <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title" style="text-align:center;">{{ isset($textTemplate) && ($textTemplate->pk_text_settings) ? 'Edit Text Settings':'Create New Text Settings'}}</h4>
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
                                          <form class="form-horizontal mt-4" style="margin-left:550px;"" method="post" action="/accountadmin/text-account/submit" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="product_category">Sid</label>
                                                <input type="text" name="sid" class="form-control @error('sid') is-invalid @enderror" value="{{ isset($textTemplate) && ($textTemplate->sid) ?$textTemplate->sid: old('sid')}}">
                                                @error('sid')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Token</label>
                                                <input type="text" name="token" class="form-control @error('token') is-invalid @enderror" value="{{ isset($textTemplate) && ($textTemplate->token) ?$textTemplate->token: old('token')}}">
                                                @error('token')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="description">From Number</label>
                                                <input type="text" name="from_no" class="form-control @error('from_no') is-invalid @enderror" value="{{ isset($textTemplate) && ($textTemplate->from_no) ?$textTemplate->from_no: old('from_no')}}">
                                                @error('from_no')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Active</label>
                                                    <input type="radio" name="active"  value="1" checked="checked" class="form-check-input">
                                                    <label class="form-check-label" for="customRadio11" style="margin-left: 20px;">Yes</label>
                                                    <input type="radio" name="active" value="0" {{ isset($textTemplate) && ($textTemplate->active=="0")? "checked" : "" }}  class="form-check-input">
                                                    <label class="form-check-label" for="customRadio22" style="margin-left: 20px;">No</label>
                                            </div>
                                            <input type="hidden" name="pk_account" value="{{isset($pk_account) ? $pk_account : ''}}" >
                                            <input type="hidden" name="pk_text_settings" value="{{ isset($textTemplate) && ($textTemplate->pk_text_settings) ?$textTemplate->pk_text_settings : ''}}" >
                                            <a href="/accountadmin/text-account/back"><input class="btn btn-primary" type="button" value="Cancel"></a>
                                            <input class="btn btn-primary" type="submit" value="{{ isset($textTemplate) && ($textTemplate->pk_text_settings)? "Update" : "Submit" }}">
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
