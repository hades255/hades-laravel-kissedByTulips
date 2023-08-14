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
                        <li class="breadcrumb-item active"><a href="/superadmin/users">User</a></li>
                    </ol>
                    <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i class="fa fa-plus-circle"></i> {{isset($user) && ($user->pk_users) ? 'Edit User' : 'Create New User'}}</button>
                </div>
            </div>
        </div>
        <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{isset($user) && ($user->pk_users) ? 'Edit User' : 'Create New User'}}</h4>
                                <div class="tab-content br-n pn">
                                    <div id="navpills-1" class="tab-pane active">
                                        <div class="row">
                                          <form class="form-horizontal mt-4 " method="post" action="{{isset($user) && ($user->id) ? '/superadmin/users/edit/submit' : '/superadmin/users/submit'}}">
                                            @csrf
                                            <div class="form-group">
                                                <label for="role">Role</label>
                                                <select class="form-select col-12" name="pk_roles"  class="form-control @error('pk_roles') is-invalid @enderror">
                                                    <option selected="">Choose...</option>
                                                    @foreach($roles as $role)
                                                        <option value="{{ $role->pk_roles }}" {{ isset($getUser->pk_roles) && ($role->pk_roles  == $getUser->pk_roles) ? 'selected' : '' }}>{{ $role->roles }}</option>
                                                    @endforeach
                                                </select>
                                                @error('pk_roles')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="role">Account</label>
                                                <select class="form-select col-12" name="pk_account" class="form-control @error('pk_account') is-invalid @enderror">
                                                    <option selected="">Choose Account...</option>
                                                    @foreach($accounts as $account)
                                                        <option value="{{ $account->pk_account }}" {{ isset($getUser->pk_account) && ($account->pk_account == $getUser->pk_account) ? 'selected' : '' }}>{{$account->business_name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('pk_account')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="first_name">First Name</label>
                                                <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{isset($user) && ($user->first_name)?$user->first_name:''}}">
                                                @error('first_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="last_name">Last Name</label>
                                                <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{isset($user) && ($user->last_name)?$user->last_name:''}}">
                                                @error('last_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{isset($user) && ($user->email)?$user->email:''}}">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{isset($user) && ($user->phone)?$user->phone:''}}">
                                                @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="user_id">User Name</label>
                                                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{isset($user) && ($user->username)?$user->username:''}}">
                                                @error('username')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            @if(!isset($user))
                                            <div class="form-group">
                                                <label for="user_id">Password</label>
                                                <input type="password" name="password" class="form-control">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            @endif
                                            <div class="form-group">
                                                <label class="form-label">Active</label>
                                                    <input type="radio" name="active"  value="1" checked="checked" class="form-check-input" style="margin-left: 20px;">
                                                    <label class="form-check-label" for="customRadio11">Yes</label>
                                                    <input type="radio" name="active" value="0" {{ isset($user) && ($user->active=="0")? "checked" : "" }} class="form-check-input" style="margin-left: 20px;">
                                                    <label class="form-check-label" for="customRadio22">No</label>
                                            </div>

                                            <input type="hidden" name="pk_users" class="form-control" value="{{isset($user) && ($user->pk_users)?$user->pk_users:''}}">
                                            <a href="/superadmin/users/back"><input class="btn btn-primary" type="button" value="Cancel"></a>
                                            @if(isset($user) && ($user->pk_users))
                                              <a href="/superadmin/users/reset-password/{{isset($user) && ($user->pk_users)?$user->pk_users:''}}"><input class="btn btn-primary" type="button" value="Reset Password"></a>
                                            @endif
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
