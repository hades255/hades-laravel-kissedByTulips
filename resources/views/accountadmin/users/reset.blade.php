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
                        <li class="breadcrumb-item active"><a href="/accountadmin/users">User</a></li>
                    </ol>
                    <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white" style="margin-top: -34px;"><i class="fa fa-plus-circle"></i>Change Password</button>
                </div>
            </div>
        </div>
        <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                              @if(Session::has('success'))
                              <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('success') }}</p>
                               @endif
                               @if(Session::has('error'))
                               <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('error') }}</p>
                                @endif
                                <h4 class="card-title" style="text-align: center;">Change Password</h4>
                                <div class="tab-content br-n pn">
                                    <div id="navpills-1" class="tab-pane active">
                                        <div class="row">
                                          <div class ="col-md-4"></div>
                                          <form class="form-horizontal mt-4 " method="post" action="/accountadmin/users/reset-password/submit" style="margin-left: 132px;">
                                            @csrf
                                            <div class="form-group">
                                                <label for="password">New Password</label>
                                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <input type="hidden" name="pk_users" value="{{isset($id)&& !empty($id) ? $id:''}}"
                                            <div class="form-group">
                                                <label for="confirm_password">Confirm Password</label>
                                                <input type="password" name="password_confirmation" class="form-control" >
                                                @error('password_confirmation')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <br>
                                            <div class="form-group" style="text-align: center;">
                                                <label class="form-label" style="margin-left: -120px;">Active</label>
                                                    <input type="radio" name="active"  value="1" checked="checked" class="form-check-input" style="margin-left: -82px;">
                                                    <label class="form-check-label" for="customRadio11" style="margin-left: -94px;">Yes</label>
                                                    <input type="radio" name="active" value="0" {{ isset($user) && ($user->active=="0")? "checked" : "" }} class="form-check-input" style="margin-left: -82px;">
                                                    <label class="form-check-label" for="customRadio22" style="margin-left: -94px;">No</label>
                                            </div>
                                            <input type="hidden" name="pk_users" class="form-control" value="{{isset($user) && ($user->pk_users)?$user->pk_users:''}}">
                                            <a href="/accountadmin/users/back" style="margin-left: 528px;"><input class="btn btn-primary" type="button" value="Cancel"></a>
                                            <input class="btn btn-primary" type="submit" value="{{isset($user) && ($user->pk_users)?'Update':'Submit'}}">
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
