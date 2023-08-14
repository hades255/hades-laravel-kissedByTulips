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
                        <li class="breadcrumb-item active"><a href="/superadmin/roles">Role</a></li>
                    </ol>
                    <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i class="fa fa-plus-circle"></i>{{isset($role) && ($role->id) ? 'Edit Role' : 'Create New Role'}}</button>
                </div>
            </div>
        </div>
        @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
        @endif
        <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{isset($role) && ($role->pk_roles) ? 'Edit Role' : 'Create New Role'}}</h4>
                                <div class="tab-content br-n pn">
                                    <div id="navpills-1" class="tab-pane active">
                                        <div class="row">
                                          @if(Session::has('message'))
                                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                                          @endif
                                          <form class="form-horizontal mt-4" method="post" action="/superadmin/roles/submit">
                                            @csrf
                                            <div class="form-group">
                                                <label for="role">Role Name</label>
                                                <input type="text" name="roles" class="form-control"  value="{{isset($role) && ($role->roles)?$role->roles:''}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="role">Description</label>
                                                <input type="text" name="description" class="form-control"  value="{{isset($role) && ($role->description)?$role->description:''}}">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Active</label>
                                                    <input type="radio" name="active"  value="1" checked="checked" class="form-check-input" style="margin-left: 20px;">
                                                    <label class="form-check-label" for="customRadio11">Yes</label>
                                                    <input type="radio" name="active" value="0" {{ isset($role) && ($role->active=="0")? "checked" : "" }} class="form-check-input" style="margin-left: 20px;">
                                                    <label class="form-check-label" for="customRadio22">No</label>
                                            </div>
                                            <input type="hidden" name="pk_roles" class="form-control" value="{{isset($role) && ($role->pk_roles)?$role->pk_roles:''}}">
                                            <a href="/superadmin/roles/back"><input class="btn btn-primary" type="button" value="Cancel"></a>
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
