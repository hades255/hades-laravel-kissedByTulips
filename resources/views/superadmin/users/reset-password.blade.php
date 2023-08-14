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
                    <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i class="fa fa-plus-circle"></i>Change Password</button>
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
                                <h4 class="card-title">Change Password</h4>
                                <div class="tab-content br-n pn">
                                    <div id="navpills-1" class="tab-pane active">
                                        <div class="row">
                                          <form class="form-horizontal mt-4 " method="post" action="/superadmin/users/reset-password/submit">
                                            @csrf
                                            <div class="form-group">
                                                <label for="password">New Password</label>
                                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{old('password')}}">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <input type="hidden" name="pk_users" value="{{isset($id)&& !empty($id) ? $id:''}}"
                                            <div class="form-group">
                                                <label for="confirm_password">Confirm Password</label>
                                                <input type="password" name="password_confirmation" class="form-control" value="{{old('confirm_password')}}">
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label class="form-label">Active</label>
                                                    <input type="radio" name="active"  value="1" checked="checked" class="form-check-input" style="margin-left: 20px;">
                                                    <label class="form-check-label" for="customRadio11">Yes</label>
                                                    <input type="radio" name="active" value="0" {{ isset($user) && ($user->active=="0")? "checked" : "" }} class="form-check-input" style="margin-left: 20px;">
                                                    <label class="form-check-label" for="customRadio22">No</label>
                                            </div>
                                            <input type="hidden" name="pk_users" class="form-control" value="{{isset($user) && ($user->pk_users)?$user->pk_users:''}}">
                                            <a href="/superadmin/users/back"><input class="btn btn-primary" type="button" value="Cancel"></a>
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
