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
              <li class="breadcrumb-item"><a href="/accountadmin">Home</a></li>
               <li class="breadcrumb-item active"><a href="/accountadmin/customers/edit/{{isset($customer_contact) && ($customer_contact->pk_customers)?$customer_contact->pk_customers:''}}">Contact</a></li>
            </ol>
            <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i class="fa fa-plus-circle"></i> Create New Contact</button>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-lg-12">
         <div class="card">
               <div class="form-body">
                 <form method="post" action="{{isset($customer_contact) && ($customer_contact->pk_customer_contacts) ? '/accountadmin/customers/contacts/update' : '/accountadmin/customers/contacts/submit'}}">
                    @csrf
                  <div class="card-body">
                     <div class="row pt-3">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="form-label">Contact Name</label>
                              <input type="text" name="contact_name" class="form-control @error('contact_name') is-invalid @enderror" value= "{{isset($customer_contact) && ($customer_contact->contact_name) ? $customer_contact->contact_name : old('contact_name')}}">
                                <input type="hidden" name="pk_customer_contacts" value= "{{isset($customer_contact) && ($customer_contact->pk_customer_contacts) ? $customer_contact->pk_customer_contacts:'' }}">
                              @error('business_name')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                             <label class="form-label">Title</label>
                             <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value= "{{isset($customer_contact) && ($customer_contact->title) ? $customer_contact->title : old('title')}}">
                             @error('website')
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                 </span>
                             @enderror
                          </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="form-label">Department</label>
                                 <select class="form-control @error('pk_department') is-invalid @enderror form-select" name="pk_department">
                                   <option value="">Choose--</option>
                                     @foreach($departments as $department)
                                        <option value="{{$department->pk_department}}" {{isset($customer_contact) && ($customer_contact->pk_department  == $department->pk_department) || old('pk_department') == $department->pk_department ? 'selected' : ''  }}>{{$department->department}}</option>
                                     @endforeach
                                 </select>
                                 @error('pk_department')
                                     <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                     </span>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-md-4">
                                 <div class="form-group" style="margin-top: 36px;">
                                  <input type="checkbox" name="login_enable" class="form-check-input @error('login_enable') is-invalid @enderror" id="accountadminvendorloginform" {{isset($customer_contact) && ($customer_contact->login_enable == 1) || old('login_enable') ? 'checked' : ''}}>
                                  <label class="form-check-label" for="customCheck1">Enable Login</label>
                                  @error('login_enable')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                                 </div>
                           </div>
                        </div>
                        <div class="row" id="loginform">
                           <div class="col-md-4">
                             <div class="form-group">
                                <label class="form-label">User Name</label>
                                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value= "{{isset($customer_contact) && ($customer_contact->username) ? $customer_contact->username : old('username')}}">
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                             </div>
                           </div>
                           @if(!isset($customer_contact->username))
                           <div class="col-md-4">
                             <div class="form-group">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                             </div>
                           </div>
                           <div class="col-md-4">
                             <div class="form-group">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" >
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                             </div>
                          </div>
                          @endif
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                             <div class="form-group">
                                <label class="form-label">Address</label>
                                <input type="text" name="address" id="autocomplete" class="form-control" value = "{{isset($customer_contact) && ($customer_contact->address) ? $customer_contact->address : old('address')}}">
                             </div>
                           </div>
                           <div class="col-md-6">
                             <div class="form-group">
                                <label class="form-label">Ste/Unit #</label>
                                <input type="text" name="address_1" id="address_1" class="form-control" value ="{{isset($customer_contact) && ($customer_contact->address_1) ? $customer_contact->address_1 : old('address_1')}}" maxlength="10">
                             </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-4">
                             <div class="form-group">
                                <label class="form-label">City</label>
                                <input type="text" name="city" id="city" class="form-control" value ="{{isset($customer_contact) && ($customer_contact->city) ? $customer_contact->city : old('city')}}">
                             </div>
                           </div>
                           <div class="col-md-4">
                                <div class="form-group">
                                   <label class="form-label">State</label>
                                   <select id="states" class="form-control @error('pk_states') is-invalid @enderror form-select" name="pk_states">
                                     <option value="">Choose--</option>
                                     @foreach($states as $state)
                                      <option value="{{$state->pk_states}}" {{ isset($customer_contact) && ($customer_contact->pk_states  == $state->pk_states) ? 'selected' : '' }}>{{$state->state_code}}</option>
                                      @endforeach
                                   </select>
                                   @error('pk_states')
                                       <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                   @enderror
                             </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label class="form-label">Zip</label>
                                 <input type="text" id="zip" name="zip" class="form-control" value ="{{isset($customer_contact) && ($customer_contact->zip) ? $customer_contact->zip : old('zip')}}">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="form-label">Country</label>
                                 <select class="form-control @error('pk_country') is-invalid @enderror form-select" name="pk_country">
                                   <option value="">Choose--</option>
                                   @foreach($countries as $country)
                                    <option value="{{$country->pk_country}}" {{ isset($customer_contact) && ($customer_contact->pk_country  == $country->pk_country) ? 'selected' : '' }}>{{$country->country_code}}</option>
                                    @endforeach
                                 </select>
                                 @error('pk_country')
                                     <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                     </span>
                                 @enderror
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                             <div class="form-group">
                                <label class="form-label">Office Phone</label>
                                <input type="text" name="office_phone" class="form-control @error('office_phone') is-invalid @enderror "  value ="{{isset($customer_contact) && ($customer_contact->office_phone) ? $customer_contact->office_phone : ''}}">
                                @error('office_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                             </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                             <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="text" name="email" class="form-control"  value ="{{isset($customer_contact) && ($customer_contact->email) ? $customer_contact->email : ''}}">
                             </div>
                           </div>
                        </div>
                        @if(isset($customer_contact) && ($customer_contact->pk_customers))
                        <div class="form-group">
                            <label class="form-label">Active</label>
                                <input type="radio" name="active"  value="1" checked="checked" class="form-check-input" style="margin-left: 20px;">
                                <label class="form-check-label" for="customRadio11">Yes</label>
                                <input type="radio" name="active" value="0" {{ isset($customer_contact) && ($customer_contact->active=="0")? "checked" : "" }} class="form-check-input" style="margin-left: 20px;">
                                <label class="form-check-label" for="customRadio22">No</label>
                        </div>
                        @endif
                        <input type="hidden" name="pk_account" class="form-control" value="{{isset($pk_account)?$pk_account:''}}">
                        @if(isset($customer_contact) && ($customer_contact->pk_customers))
                        <input type="hidden" name="pk_customers" class="form-control" value="{{isset($customer_contact) && ($customer_contact->pk_customers)?$customer_contact->pk_customers:''}}">
                          <input type="hidden" name="pk_customer_contacts" class="form-control" value="{{isset($customer_contact) && ($customer_contact->pk_customer_contacts)?$customer_contact->pk_customer_contacts:''}}">
                        @else
                        <input type="hidden" name="pk_customers" class="form-control" value="{{isset($customer_id) ? $customer_id :''}}">
                        @endif
                        <input type="hidden" name="pk_roles" class="form-control" value="4">

                        <input type="hidden" name="pk_users" class="form-control" value="{{isset($customer_contact) && ($customer_contact->pk_users)?$customer_contact->pk_users:''}}">
                     </div>

                     <div class="form-actions">
                        <div class="card-body">
                          <a href="/accountadmin/customers/edit/{{isset($customer_contact) && ($customer_contact->pk_customers)?$customer_contact->pk_customers:''}}"><input class="btn btn-primary" type="button" value="Cancel"></a>
                          <input class="btn btn-primary" type="submit" name="submit" value="{{isset($customer_contact) && ($customer_contact->pk_customers)?'Update':'Submit'}}">
                          <input class="btn btn-primary" type="submit" name="submit" value="{{isset($customer_contact) && ($customer_contact->pk_customers)?'Update And Next':'Save And Next'}}">
                        </div>
                     </div>
                  </div>
            </form>
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
