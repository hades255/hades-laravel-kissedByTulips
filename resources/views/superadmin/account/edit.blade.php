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
                      <li class="breadcrumb-item active"><a href="/superadmin/account">Account</a></li>
                    </ol>
                    <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white" style="margin-top:-34px;"><i class="fa fa-plus-circle"></i> {{isset($account) && ($account->pk_account) ? 'Edit account' : 'Create New Account'}}</button>
                </div>
            </div>
        </div>
        <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title" style="text-align:center;">Account</h4>
                                <ul class="nav nav-pills m-t-30 m-b-30" style="margin-left: 364px;">
                                    <li class="nav-item"> <a href="#navpills-1" class="nav-link active" data-bs-toggle="tab" aria-expanded="false">Business Info</a> </li>
                                    <li class="nav-item"> <a href="#navpills-2" class="nav-link" data-bs-toggle="tab" aria-expanded="false">Users Info</a> </li>
                                </ul>
                                <div class="tab-content br-n pn">
                                    <div id="navpills-1" class="tab-pane active">
                                      <div class="row">
                                        <form class="form-horizontal mt-4" method="post" action="/superadmin/account/edit/submit" style="margin-left: 380px;">
                                          @csrf
                                            <div class="form-group">
                                                <label for="business">Business Name</label>
                                                <input type="text" class="form-control @error('business_name') is-invalid @enderror" name="business_name" value="{{isset($account) && ($account->business_name)?$account->business_name:old('business_name')}}">
                                                @error('business_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="row">
                                            <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <input type="text" name="address" id="autocomplete" class="form-control" value="{{isset($account) && ($account->address)?$account->address:''}}">
                                            </div>
                                          </div>
                                            <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="address_1">Ste#</label>
                                                <input type="text" name="address_1" id="street_number" class="form-control" value="{{isset($account) && ($account->address_1)?$account->address_1:''}}" maxlength="10">
                                            </div>
                                           </div>
                                           </div>
                                           <div class="row">
                                             <div class="col-md-4">
                                              <div class="form-group">
                                                  <label for="city">City</label>
                                                  <input type="text" name="city" id="locality" class="form-control" value="{{isset($account) && ($account->city)?$account->city:''}}">
                                              </div>
                                            </div>
                                          <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="zip">Zip</label>
                                                <input type="text" name="zip" id="postal_code" class="form-control" value="{{isset($account) && ($account->zip)?$account->zip:''}}">
                                            </div>
                                          </div>
                                          <div class="col-md-4">
                                              <div class="form-group">
                                                 <label class="form-label">State</label>
                                                 <input id="administrative_area_level_1" type="text" name="state_name" class="form-control" value ="{{isset($account) && ($account->state_name) ? $account->state_name : old('state_name')}}">
                                              </div>
                                          </div>
                                          <!-- <div class="col-md-4">
                                         <div class="form-group">
                                             <label for="role">State</label>
                                             <select class="form-select col-12" name="pk_state">
                                                 <option selected="">Choose State...</option>
                                                 @foreach($states as $state)
                                                     <option value="{{ $state->pk_states }}"{{ isset($account) && ($account->pk_states  == $state->pk_states) ? 'selected' : '' }}>{{$state->state_code}}</option>
                                                 @endforeach
                                             </select>
                                             @error('pk_state')
                                                 <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                                 </span>
                                             @enderror
                                         </div>
                                       </div> -->
                                        </div>
                                          <div class="form-group">
                                              <label class="form-label">Country</label>
                                              <input id="country" type="text" name="country_name" class="form-control" value ="{{isset($account) && ($account->country_name) ? $account->country_name : old('country_name')}}">
                                          </div>
                                            <!-- <div class="form-group">
                                                <label for="role">Country</label>
                                                <select class="form-select col-12" name="pk_country">
                                                    <option value="">Choose Country...</option>
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->pk_country }}" {{ isset($account->pk_country) && ($country->pk_country  == $account->pk_country) ? 'selected' : '' }}>{{$country->country_code}}</option>
                                                    @endforeach
                                                </select>
                                                @error('pk_country')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div> -->

                                            <div class="form-group">
                                                <label for="business_phone">Business Phone</label>
                                                <input type="text" name="business_phone" class="form-control" value="{{isset($account) && ($account->business_phone)?$account->business_phone:''}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="business_phone">Business Fax</label>
                                                <input type="text" name="fax" class="form-control" value="{{isset($account) && ($account->fax)?$account->fax:''}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="business_email">Business Email</label>
                                                <input type="text" name="business_email" class="form-control" value="{{isset($account) && ($account->business_email)?$account->business_email:''}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="business_email">Business Website</label>
                                                <input type="text" name="website" class="form-control" value="{{isset($account) && ($account->website)?$account->website:''}}">
                                            </div>
                                              <input type="hidden" name="pk_account" class="form-control" value="{{isset($account) && ($account->pk_account)?$account->pk_account:''}}">
                                              <input type="hidden" name="pk_user" class="form-control" value="{{isset($$getUsers) && ($$getUsers->pk_user)?$$getUsers->pk_user:''}}">
                                      </div>
                                      <div class="form-group" style="margin-left:370px;">
                                          <label class="form-label">Active</label>
                                              <input type="radio" name="active"  value="1" checked="checked" class="form-check-input">
                                              <label class="form-check-label" for="customRadio11" style="margin-left: 20px;">Yes</label>
                                              <input type="radio" name="active" value="0" {{ isset($account) && ($account->active=="0")? "checked" : "" }} class="form-check-input">
                                              <label class="form-check-label" for="customRadio22" style="margin-left: 20px;">No</label>
                                      </div>
                                      <a href="/superadmin/account/back"><input class="btn btn-primary" type="button" value="Cancel" style="margin-left: 584px;"></a>
                                      <input class="btn btn-primary" type="submit" value="Update">
                                  </form>
                                    </div>
                                    <div id="navpills-2" class="tab-pane">
                                      <div class="row">
                                       <div class="col-12">
                                          <div class="card">
                                              <div class="card-body">
                                                  <!-- <h4 class="card-title">Account Users Export</h4>
                                                  <h6 class="card-subtitle">Export account users to Copy, CSV, Excel, PDF & Print</h6> -->
                                                  <div class="table-responsive m-t-40">
                                                      <table id="example23"
                                                          class="display nowrap table table-hover table-striped border"
                                                          cellspacing="0" width="100%">
                                                          <thead>
                                                              <tr>
                                                                  <th>First Name</th>
                                                                  <th>Last Name</th>
                                                                  <th>Email</th>
                                                                  <th>UserName</th>
                                                                  <th>Phone</th>
                                                                  <th style="text-align:center;">Actions</th>
                                                              </tr>
                                                          </thead>
                                                          <tbody>
                                                            @foreach($getUsers as $getUser)
                                                              <tr>
                                                                  <td onclick="window.location='{{ route('users.edit', ['id' => $getUser->pk_users]) }}'">{{$getUser->first_name}}</td>
                                                                  <td onclick="window.location='{{ route('users.edit', ['id' => $getUser->pk_users]) }}'">{{$getUser->last_name}}</td>
                                                                  <td onclick="window.location='{{ route('users.edit', ['id' => $getUser->pk_users]) }}'">{{$getUser->email}}</td>
                                                                  <td onclick="window.location='{{ route('users.edit', ['id' => $getUser->pk_users]) }}'">{{$getUser->username}}</td>
                                                                  <td onclick="window.location='{{ route('users.edit', ['id' => $getUser->pk_users]) }}'">{{$getUser->phone}}</td>
                                                                  <td style="text-align:center;">
                                                                    <a class="btn btn-danger text-white" href="/superadmin/account/users/edit/{{$getUser->pk_users}}">Edit</a>
                                                                    <a class="btn btn-danger text-white" style="margin-top:20px;" href="/superadmin/account/users/delete/{{$getUser->pk_users}}">Delete</a>
                                                                  </td>
                                                              </tr>
                                                              @endforeach
                                                          </tbody>
                                                      </table>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
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

@section('js')
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAB80hPTftX9xYXqy6_NcooDtW53kiIH3A&libraries=places&callback=initAutocomplete" async defer></script>
  <script src="/assets/address-auto-complete.js"></script>
@endsection
