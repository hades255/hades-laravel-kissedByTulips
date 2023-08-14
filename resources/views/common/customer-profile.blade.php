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
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                    <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i class="fa fa-plus-circle"></i>Edit Profile</button>
                </div>
            </div>
        </div>
        <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Edit Profile</h4>
                                <div class="tab-content br-n pn">
                                    <div id="navpills-1" class="tab-pane active">
                                        <div class="row">
                                          <form class="form-horizontal mt-4 " method="post" action="/customer/profile/update">
                                            @csrf
                                           <div class="form-group">
                                                <label for="role">Role</label>
                                                @if(isset($user) && ($user->pk_roles == 4))
                                                <input type="text" name="role" class="form-control" value="Customer" readonly>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="user_id">User Name</label>
                                                <input type="text" name="username" class="form-control" value="{{isset($user) && ($user->username) ? $user->username:''}}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="first_name">First Name</label>
                                                <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{isset($user) && ($user->first_name)?$user->first_name:old('first_name')}}">
                                                @error('first_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="last_name">Last Name</label>
                                                <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{isset($user) && ($user->last_name)?$user->last_name:old('last_name')}}">
                                                @error('last_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{isset($user) && ($user->email)?$user->email:old('email')}}">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{isset($user) && ($user->phone)?$user->phone:old('phone')}}">
                                                @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <!-- <div class="form-group">
                                                <label for="user_id">Password</label>
                                                <input type="password" name="password" class="form-control  @error('password') is-invalid @enderror">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div> -->
                                            <input type="hidden" name="pk_users" class="form-control" value="{{isset($user) && ($user->pk_users)?$user->pk_users:''}}">
                                            <a href="/customer"><input class="btn btn-primary" type="button" value="Cancel"></a>
                                            <a href="/customer/reset/{{isset($user) && ($user->pk_users)?$user->pk_users:''}}"><input class="btn btn-primary" type="button" value="{{isset($user) && ($user->pk_users)?'Reset Password':''}}"></a>
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
