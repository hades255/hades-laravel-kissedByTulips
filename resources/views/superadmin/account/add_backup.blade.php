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
                      <li class="breadcrumb-item active"><a href="/superadmin/account">Account</a></li>
                    </ol>
                    @php if(session()->has('account')) { $account = session()->get('account'); }  @endphp
                    <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i class="fa fa-plus-circle"></i> {{isset($user) && ($user->id) ? 'Edit User' : 'Create New'}}</button>
                </div>
            </div>
        </div>
        <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Account</h4>
                                <ul class="nav nav-pills m-t-30 m-b-30">
                                    <li class="nav-item"> <a href="#navpills-1" class="nav-link {{isset($account) && ($account->pk_account)?'':'active'}}" data-bs-toggle="tab" aria-expanded="false">Business Info</a></li>
                                    <li class="nav-item"> <a href="#navpills-2" class="nav-link {{isset($account) && ($account->pk_account)?'active':''}}" data-bs-toggle="tab" aria-expanded="false">User Info</a> </li>
                                </ul>
                                <div class="tab-content br-n pn">
                                    <div id="navpills-1" class="tab-pane {{isset($account) && ($account->pk_account)?'':'active'}}">
                                      <form class="form-horizontal mt-4" method="post" action="/superadmin/account/submit">
                                        @csrf
                                      <div class="row">
                                            <div class="form-group">
                                                <label for="business">Business Name</label>
                                                <input type="text" class="form-control @error('business_name') is-invalid @enderror" name="business_name" value="{{isset($account) && ($account->business_name)?$account->business_name:old('business_name')}}">
                                                @error('business_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class ="row">
                                              <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address">Address</label>
                                                    <input type="text" name="address" class="form-control" value="{{isset($account) && ($account->address)?$account->address:old('address')}}">
                                                </div>
                                              </div>
                                              <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address_1">Ste#</label>
                                                    <input type="text" name="address_1" class="form-control @error('address_1') is-invalid @enderror" value="{{isset($account) && ($account->address_1)?$account->address_1:old('address_1')}}" maxlength="10">
                                                    @error('address_1')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                              </div>
                                            </div>
                                            <div class ="row">
                                            <div class="col-md-4">
                                              <div class="form-group">
                                                  <label for="city">City</label>
                                                  <input type="text" name="city" class="form-control" value="{{isset($account) && ($account->city)?$account->city:old('city')}}">
                                              </div>
                                            </div>
                                            <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="role">State</label>
                                                <select class="form-select col-12" name="pk_states" class="form-control @error('pk_states') is-invalid @enderror">
                                                    <option value="">Select State</option>
                                                    @foreach($states as $state)
                                                        <option value="{{ $state->pk_states }}" {{ old('pk_states') == $state->pk_states || isset($account) && ($account->pk_states == $state->pk_states)? 'selected':''}}>{{$state->state_code}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                          </div>
                                            <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="zip">Zip</label>
                                                <input type="text" name="zip" class="form-control" value="{{isset($account) && ($account->zip)?$account->zip:old('zip')}}">
                                            </div>
                                          </div>
                                        </div>
                                            <div class="form-group">
                                                <label for="role">Country</label>
                                                <select class="form-select col-12" name="pk_country" id="pk_country" class="form-control @error('pk_country') is-invalid @enderror">
                                                    <option value="">Select Country</option>
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->pk_country }}" {{ old('pk_country') == $country->pk_country || isset($account) && ($account->pk_country == $country->pk_country)? 'selected':''}}>{{$country->country_code}}</option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="form-group">
                                                <label for="business_phone">Business Phone</label>
                                                <input type="text" name="business_phone" class="form-control" value="{{isset($account) && ($account->business_phone)?$account->business_phone:old('business_phone')}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="business_fax">Business Fax</label>
                                                <input type="text" name="fax" class="form-control" value="{{isset($account) && ($account->fax)?$account->fax:old('fax')}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="business_email">Business Email</label>
                                                <input type="text" name="business_email" class="form-control" value="{{isset($account) && ($account->business_email)?$account->business_email:old('business_email')}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="website">Website</label>
                                                <input type="text" name="website" class="form-control" value="{{isset($account) && ($account->website)?$account->website:old('website')}}">
                                            </div>

                                      </div>
                                      <a href="/superadmin/account/back"><input class="btn btn-primary" type="button" value="Cancel"></a>
                                      <input class="btn btn-primary" type="submit" value="Continue">
                                    </form>
                                    </div>
                                    <div id="navpills-2" class="tab-pane {{isset($account) && ($account->pk_account)?'active':''}}">
                                      <div class="row">
                                        <form name="account-user" id ="account-user" class="form-horizontal mt-4" method="post" action="/superadmin/account/users/submit">
                                          @csrf
                                          <div class="form-group">
                                              <label for="role">Select Role</label>
                                              <select name="roles" id="pk_roles" class="form-control @error('roles') is-invalid @enderror">
                                                  <option value="">Select Role</option>
                                                  @foreach($roles as $role)
                                                      <option value="{{ $role->pk_roles }}" @if (old('pk_roles') == $role->pk_roles) {{ 'selected' }} @endif>{{$role->roles}}</option>
                                                  @endforeach
                                              </select>
                                              @error('roles')
                                                  <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                  </span>
                                              @enderror
                                          </div>
                                          <div class="form-group">
                                              <label for="first_name">First Name</label>
                                              <input type="text" name="first_name"  value="{{old('first_name')}}" class="form-control @error('first_name') is-invalid @enderror">
                                              @error('first_name')
                                                  <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                  </span>
                                              @enderror
                                          </div>
                                          <div class="form-group">
                                              <label for="last_name">Last Name</label>
                                              <input type="text" name="last_name"  value="{{old('last_name')}}" class="form-control @error('last_name') is-invalid @enderror">
                                              @error('last_name')
                                                  <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                  </span>
                                              @enderror
                                          </div>
                                          <div class="form-group">
                                              <label for="email">Email</label>
                                              <input type="text" id="email" name="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror">
                                              @error('email')
                                                  <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                  </span>
                                              @enderror
                                          </div>
                                          <div class="form-group">
                                              <label for="phone">Phone</label>
                                              <input type="text" name="phone" value="{{old('phone')}}"  class="form-control @error('phone') is-invalid @enderror">
                                              @error('phone')
                                                  <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                  </span>
                                              @enderror
                                          </div>
                                          <div class="form-group">
                                              <label for="user_id">User Name</label>
                                              <input type="text" id="username" name="username" value="{{old('username')}}" class="form-control @error('username') is-invalid @enderror">
                                              @error('username')
                                                  <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                  </span>
                                              @enderror
                                          </div>
                                          <div class="form-group">
                                              <label for="password">Password</label>
                                              <input type="password" name="password" value="{{old('password')}}" class="form-control @error('password') is-invalid @enderror">
                                              @error('password')
                                                  <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                  </span>
                                              @enderror
                                          </div>
                                      </div>
                                      <input type="hidden" name="pk_account" value="{{isset($account) && ($account->pk_account)?$account->pk_account:''}}">
                                      <a href="/superadmin/account/back"><input class="btn btn-primary" type="button" value="Cancel"></a>
                                      <a href=""><input class="btn btn-primary" type="submit" value="Submit"></a>
                                  </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
</div>
<script>
if ($("#account-user").length > 0) {
        $("#account-user").validate({
            rules: {
                roles: {
                    required: true,
                },

                first_name: {
                    required: true,
                },

                last_name: {
                    required: true,
                },
                email: {
                  required: true,
                  email: true,
                  remote: {
                           url: "{{url("/superadmin/account/checkemail")}}",
                           type: "GET",
                           data: {
                                    email: function() {
                                    return $( "#email" ).val();
                                    }
                                 }

                          }
                  },
                  username: {
                    required: true,
                    remote: {
                             url: "{{url("/superadmin/account/checkusername")}}",
                             type: "GET",
                             data: {
                                      username: function() {
                                      return $( "#username" ).val();
                                      }
                                   }

                            }
                    },
                    password: {
                                required: true,
                                minlength: 6
                                },
                    phone: {
                        required: true,
                        minlength: 10,
                        maxlength: 10,
                        number: true
                    },
            },
            messages: {
                roles: {
                    required: "Please Select roles",
                },
                first_name: {
                    required: "Please enter first name",
                },
                email: {
                         required: "Please enter Email Address",
                         email :  "Use Proper format of mail",
                         remote:"Email id already registred",
                      },
                username: {
                         required: "Please enter username",
                         remote:"Username is already registred",
                      },
                phone: {
                        required: "Phone number is required",
                        minlength: "Phone number must be of 10 digits"
                    },
                last_name: {
                    required: "Please enter last name",
                },
                password: {
                        required: "Password is required",
                        minlength: "Password must be at least 6 characters"
                    },
            },
      });
    }
</script>

@endsection
