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
                      <li class="breadcrumb-item active"><a href="/accountadmin/users">Users</a></li>
                    </ol>
                    <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white" style="margin-top: -34px;"><i class="fa fa-plus-circle"></i> {{isset($getCurrentUser) && ($getCurrentUser->pk_users) ? 'Edit User' : 'Create New User'}}</button>
                </div>
            </div>
        </div>
        <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title" style="text-align: center;">{{isset($getCurrentUser) && ($getCurrentUser->pk_users) ? 'Edit User' : 'Create New User'}}</h4>
                                <div class="tab-content br-n pn">
                                    <div id="navpills-1" class="tab-pane active">
                                        <div class="row">
                                          @if(Session::has('message'))
                                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                                          @endif
                                          <div class ="col-md-4"></div>
                                          <form class="form-horizontal mt-4 " method="post" action="/accountadmin/users/submit" style="margin-left: 122px;">
                                            @csrf
                                            <div class="form-group">
                                                <label for="role">Role</label>
                                                <select name="pk_roles" id="pk_roles" class="form-control account_admin_user_roles @error('pk_roles') is-invalid @enderror">
                                                    <option value="">Choose...</option>
                                                    @foreach($roles as $role)
                                                        <option value="{{ $role->pk_roles }}">{{ $role->roles }}</option>
                                                    @endforeach
                                                </select>
                                                @error('pk_roles')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group location-users" style="display:none;">
                                                <label for="role">Location</label>
                                                <select  multiple data-live-search="true" name="pk_locations[]" id="location" class="form-control selectpicker location  @error('pk_locations') is-invalid @enderror">
                                                    <option value="">Choose Location...</option>
                                                    @foreach($locations as $location)
                                                        <option value="{{ $location->pk_locations }}">{{ $location->location_name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('pk_locations')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="first_name">First Name</label>
                                                <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{old('first_name')}}">
                                                @error('first_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="last_name">Last Name</label>
                                                <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{old('last_name')}}">
                                                @error('last_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{old('phone')}}">
                                                @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="user_id">User Name</label>
                                                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{old('username')}}">
                                                @error('username')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="user_id">Password</label>
                                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"  value="{{old('password')}}">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Active</label>
                                                    <input type="radio" name="active"  value="1" checked="checked" class="form-check-input">
                                                    <label class="form-check-label" for="customRadio11" style="margin-left: 20px;">Yes</label>
                                                    <input type="radio" name="active" value="0" {{ isset($user) && ($user->active=="0")? "checked" : "" }} class="form-check-input" >
                                                    <label class="form-check-label" for="customRadio22" style="margin-left: 20px;">No</label>
                                            </div>
                                            <input type="hidden" name="pk_users" class="form-control" value="{{isset($getCurrentAccount) && ($getCurrentAccount->pk_users)?$getCurrentAccount->pk_users:''}}">
                                            <input type="hidden" name="pk_account" class="form-control" value="{{isset($getCurrentAccount) && ($getCurrentAccount->pk_account)?$getCurrentAccount->pk_account:''}}">
                                            <a href="/accountadmin/users/back"><input class="btn btn-primary" type="button" value="Cancel"></a>
                                            <input class="btn btn-primary" type="submit" value="Submit">
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
