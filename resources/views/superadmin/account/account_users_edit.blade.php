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
                      <li class="breadcrumb-item"><a href="/superadmin">Home</a></li>
                      <li class="breadcrumb-item active"><a href="/superadmin/account">Account - Users</a></li>
                    </ol>
                    <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white" style="margin-top:-34px;"><i class="fa fa-plus-circle"></i> {{isset($account) && ($account->pk_account) ? 'Edit account' : 'Create New Account'}}</button>
                </div>
            </div>
        </div>
        <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title" style="text-align:center;">Account User Edit</h4>
                                <div class="tab-content br-n pn">
                                        <div class="row">
                                          <form class="form-horizontal mt-4" method="post" action="/superadmin/account/users/update" style="margin-left:580px;">
                                            @csrf
                                            <div class="form-group">
                                                <label for="first_name">First Name</label>
                                                <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{isset($getUser) && ($getUser->first_name)?$getUser->first_name: old('first_name')}}">
                                                @error('first_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="last_name">Last Name</label>
                                                <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{isset($getUser) && ($getUser->last_name)?$getUser->last_name:old('last_name')}}">
                                                @error('last_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{isset($getUser) && ($getUser->email)?$getUser->email:old('email')}}">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{isset($getUser) && ($getUser->phone)?$getUser->phone:old('phone')}}">
                                                @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="username">UserName</label>
                                                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{isset($getUser) && ($getUser->username)?$getUser->username:old('username')}}">
                                                @error('username')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <input type="hidden" name="pk_users" class="form-control" value="{{isset($getUser) && ($getUser->pk_users)?$getUser->pk_users:''}}">
                                        <input type="hidden" name="pk_account" class="form-control" value="{{isset($getUser) && ($getUser->pk_account)?$getUser->pk_account:''}}">
                                    <div class="form-group" style="margin-left:570px;">
                                        <label class="form-label">Active</label>
                                            <input type="radio" name="active"  value="1" checked="checked" class="form-check-input">
                                            <label class="form-check-label" for="customRadio11" style="margin-left: 20px;">Yes</label>
                                            <input type="radio" name="active" value="0" {{ isset($getUser) && ($getUser->active=="0")? "checked" : "" }} class="form-check-input">
                                            <label class="form-check-label" for="customRadio22" style="margin-left: 20px;">No</label>
                                    </div>
                                    <a href="/superadmin/account/back" style="margin-left:434px;"><input class="btn btn-primary" type="button" value="Cancel"></a>
                                    @if(isset($getUser) && ($getUser->pk_users))
                                      <a href="/superadmin/account/users/reset-password/{{isset($getUser) && ($getUser->pk_users)?$getUser->pk_users:''}}"><input class="btn btn-primary" type="button" value="Reset Password"></a>
                                    @endif
                                    <input class="btn btn-primary" type="submit" value="Update">
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
</div>

@endsection
