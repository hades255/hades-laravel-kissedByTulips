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
               <li class="breadcrumb-item active"><a href="/accountadmin/vendors">Vendors</a></li>
            </ol>
            <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i class="fa fa-plus-circle"></i> {{isset($vendor) && ($vendor->pk_vendors) ? 'Edit Vendor' : 'Create New Vendor'}}</button>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-body p-b-0">
               <h4 class="card-title">{{isset($vendor) && ($vendor->pk_vendors) ? 'Edit Business Vendor'.' '. $vendor->vendor_name : 'Create New Business Vendor'}}</h4>
            </div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs customtab" role="tablist" id="tablist">
               <li class="nav-item"> <a class="nav-link @if( !request()->get('tab') ){{'active'}}@endif" data-bs-toggle="tab" href="#vendorinfo" role="tab" aria-selected="true"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Vendor Info</span></a> </li>
               <li class="nav-item"> <a class="nav-link @if( request()->get('tab') == 'contact' ){{'active'}}@endif" data-bs-toggle="tab" href="#contacts" role="tab" aria-selected="false"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Contacts</span></a> </li>
               <li class="nav-item"> <a class="nav-link @if( request()->get('tab') == 'comment' ){{'active'}}@endif" data-bs-toggle="tab" href="#comments" role="tab" aria-selected="false"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Comments</span></a> </li>
               <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#orders" role="tab" aria-selected="false"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Orders</span></a> </li>
               <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#invoices" role="tab" aria-selected="false"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Invoices</span></a> </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
               <div class="tab-pane @if( !request()->get('tab') ){{'active'}}@endif" id="vendorinfo" role="tabpanel">
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="card">
                           <form method="post" id="vendor-customer-form" action="{{isset($vendor) && ($vendor->pk_vendors) ? '/accountadmin/vendors/update' : '/accountadmin/vendors/submit'}}" >
                              @csrf
                              <div class="form-body">
                                 <div class="card-body">
                                    <div class="row pt-3">
                                       <div class="col-md-6">
                                          <div class="form-group">
                                             <label class="form-label">Vendor Name</label>
                                             <input type="text" name="vendor_name" class="form-control @error('vendor_name') is-invalid @enderror" value= "{{isset($vendor) && ($vendor->vendor_name) ? $vendor->vendor_name : old('vendor_name')}}">
                                             @error('vendor_name')
                                                 <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                                 </span>
                                             @enderror
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                         <div class="form-group">
                                            <label class="form-label">Website</label>
                                            <input type="text" name="website" class="form-control @error('website') is-invalid @enderror" value= "{{isset($vendor) && ($vendor->website) ? $vendor->website : old('website')}}">
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
                                                <label class="form-label">Vendor Type</label>
                                                <select class="form-control @error('vendor_type') is-invalid @enderror form-select" name="vendor_type">
                                                  <option value="">Choose--</option>
                                                  @foreach($vendor_types as $vendor_type)
                                                   <option value="{{$vendor_type->pk_vendor_type}}" {{ isset($vendor) && ($vendor->pk_vendor_type  == $vendor_type->pk_vendor_type) || old('pk_vendor_type') == $vendor_type->pk_vendor_type ? 'selected' : '' }}>{{$vendor_type->vendor_type}}</option>
                                                   @endforeach
                                                </select>
                                                @error('vendor_type')
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
                                               <label class="form-label">Address</label>
                                               <input type="text" name="address" id="address" class="form-control" value = "{{isset($vendor) && ($vendor->address) ? $vendor->address : old('address')}}">
                                            </div>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-md-6">
                                            <div class="form-group">
                                               <label class="form-label">Ste/Unit #</label>
                                               <input type="text" name="address_1" id="address_1" class="form-control" value ="{{isset($vendor) && ($vendor->address_1) ? $vendor->address_1 : old('address_1')}}">
                                            </div>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-md-2">
                                            <div class="form-group">
                                               <label class="form-label">City</label>
                                               <input type="text" name="city" id="city" class="form-control" value ="{{isset($vendor) && ($vendor->city) ? $vendor->city : old('city')}}">
                                            </div>
                                          </div>
                                          <div class="col-md-2">
                                               <div class="form-group">
                                                  <label class="form-label">State</label>
                                                  <select id="states"  class="form-control @error('pk_states') is-invalid @enderror form-select" name="pk_states">
                                                    <option value="">Choose--</option>
                                                    @foreach($states as $state)
                                                     <option value="{{$state->pk_states}}" {{ isset($vendor) && ($vendor->pk_states  == $state->pk_states) ? 'selected' : '' }}>{{$state->state_code}}</option>
                                                     @endforeach
                                                  </select>
                                                  @error('pk_states')
                                                      <span class="invalid-feedback" role="alert">
                                                          <strong>{{ $message }}</strong>
                                                      </span>
                                                  @enderror
                                            </div>
                                          </div>
                                          <div class="col-md-2">
                                             <div class="form-group">
                                                <label class="form-label">Zip</label>
                                                <input type="text" name="zip" id="zip" class="form-control" value ="{{isset($vendor) && ($vendor->zip) ? $vendor->zip : old('zip')}}">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-md-6">
                                             <div class="form-group">
                                                <label class="form-label">Country</label>
                                                <select id="country" class="form-control @error('pk_country') is-invalid @enderror form-select" name="pk_country">
                                                  <option value="">Choose--</option>
                                                  @foreach($countries as $country)
                                                   <option value="{{$country->pk_country}}" {{ isset($vendor) && ($vendor->pk_country  == $country->pk_country) ? 'selected' : '' }}>{{$country->country_code}}</option>
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
                                               <input type="text" name="office_phone" class="form-control @error('office_phone') is-invalid @enderror "  value ="{{isset($vendor) && ($vendor->office_phone) ? $vendor->office_phone : ''}}">
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
                                               <input type="text" name="email" class="form-control"  value ="{{isset($vendor) && ($vendor->email) ? $vendor->email : ''}}">
                                            </div>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-md-6">
                                            <div class="form-group">
                                               <label class="form-label">Fax</label>
                                               <input type="text" name="fax" class="form-control"  value ="{{isset($vendor) && ($vendor->fax) ? $vendor->fax : ''}}">
                                            </div>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-md-6">
                                            <div class="form-group">
                                                 <label class="form-label" id="customerlabelLat">Lat: {{isset($vendor) && ($vendor->lat) ? $vendor->lat : ''}}</label>
                                                 @if(isset($vendor) && ($vendor->lat))
                                                 <input type="hidden" name="lat" value="{{ $vendor->lat}}">
                                                 @endif
                                            </div>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label class="form-label" id="customerlabelLng">Lng: {{isset($vendor) && ($vendor->lng) ? $vendor->lng : ''}}</label>
                                               @if(isset($vendor) && ($vendor->lng))
                                               <input type="hidden" name="lng" value="{{$vendor->lng}}">
                                              @endif
                                            </div>
                                          </div>
                                       </div>
                                       @if(isset($vendor) && ($vendor->pk_vendors))
                                       <div class="form-group">
                                           <label class="form-label">Active</label>
                                               <input type="radio" name="active"  value="1" checked="checked" class="form-check-input" style="margin-left: 20px;">
                                               <label class="form-check-label" for="customRadio11">Yes</label>
                                               <input type="radio" name="active" value="0" {{ isset($vendor) && ($vendor->active=="0")? "checked" : "" }} class="form-check-input" style="margin-left: 20px;">
                                               <label class="form-check-label" for="customRadio22">No</label>
                                       </div>
                                       @endif
                                       <input type="hidden" name="pk_account" class="form-control" value="{{isset($pk_account)?$pk_account:''}}">
                                       <input type="hidden" name="pk_vendors" class="form-control" value="{{isset($vendor) && ($vendor->pk_vendors)?$vendor->pk_vendors:''}}">
                                       <input type="hidden" name="pk_roles" class="form-control" value="5">
                                       <input type="hidden" name="pk_users" class="form-control" value="{{isset($vendorUser) && ($vendorUser->pk_users)?$vendorUser->pk_users:''}}">
                                    </div>
                                    <div class="form-actions">
                                       <div class="card-body">
                                         <a href="/accountadmin/vendors/back"><input class="btn btn-primary" type="button" value="Cancel"></a>
                                         <input class="btn btn-primary" type="submit" value="{{isset($vendor) && ($vendor->pk_vendors)?'Update':'Submit'}}">
                                         <input class="btn btn-primary" type="submit" name="submit" value="{{isset($vendor) && ($vendor->pk_vendors)?'Update And Next':'Save And Next'}}">
                                       </div>
                                    </div>
                                 </div>
                           </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="tab-pane p-20 @if( request()->get('tab') == 'contact' ){{'active'}}@endif" id="contacts" role="tabpanel">
                 <div class="row">
                     <div class="col-12">
                         <div class="card">
                             <div class="card-body">
                                  @if(isset($vendor) && !empty($vendor->pk_vendors))
                                    <a href="/accountadmin/vendors/contacts/add/{{$vendor->pk_vendors}}">
                                      <button class="btn btn-danger text-white card-title" style="float: right;margin-right: 36px;">Add Contact</button>
                                    </a>
                                   @else
                                    <a href="#">
                                      <button class="btn btn-danger text-white card-title" style="float: right;margin-right: 36px;">First Add Business Vendor</button>
                                   </a>
                                   @endif
                                 <!-- <h6 class="card-subtitle">Export Customers to Copy, CSV, Excel, PDF & Print</h6> -->
                                 <div class="table-responsive m-t-40">
                                     <table id="example23"
                                         class="display nowrap table table-hover table-striped border"
                                         cellspacing="0" width="100%">
                                         <thead>
                                             <tr>
                                                 <th>Contact Name</th>
                                                 <th>Department</th>
                                                 <th>Email</th>
                                                 <th>Phone</th>
                                                 <th style="text-align:center;">Actions</th>
                                             </tr>
                                         </thead>
                                         <tbody>
                                               @if(!empty($vendorContacts))
                                               @foreach($vendorContacts as $contact)
                                               <tr>
                                               <td onclick="window.location='{{ route('accountadmin.vendors.contacts.edit', ['id' => $contact->pk_vendor_contacts]) }}'">{{$contact->contact_name}}</td>
                                               <td onclick="window.location='{{ route('accountadmin.vendors.contacts.edit', ['id' => $contact->pk_vendor_contacts]) }}'">{{$contact->department}}</td>
                                               <td onclick="window.location='{{ route('accountadmin.vendors.contacts.edit', ['id' => $contact->pk_vendor_contacts]) }}'">{{$contact->email}}</td>
                                               <td onclick="window.location='{{ route('accountadmin.vendors.contacts.edit', ['id' => $contact->pk_vendor_contacts]) }}'">{{$contact->office_phone}}</td>
                                                 <td style="text-align:center;">
                                                  <a href="/accountadmin/vendors/contacts/edit/{{$contact->pk_vendor_contacts}}"><button class="btn btn-danger text-white">Edit</button></a>
                                                  <a href="/accountadmin/vendors/contacts/delete/{{$contact->pk_vendor_contacts}}"><button class="btn btn-danger text-white">Delete</button></a>
                                                </td>
                                              </tr>
                                              @endforeach
                                              @endif
                                             </tr>
                                         </tbody>
                                     </table>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
               </div>
               <div class="tab-pane p-20 @if( request()->get('tab') == 'comment' ){{'active'}}@endif" id="comments" role="tabpanel">
                 <div class="row">
                   <div class="col-12">
                       <div class="card card-body">
                           <h4 class="card-title">{{isset($editComment) && ($editComment->pk_comment)?'Add':''}} Comment</h4>
                           <div class="row">
                               <div class="col-sm-12 col-xs-12">
                                   <form action="/accountadmin/vendors/comments/store" method="post">
                                     @csrf
                                       <div class="form-group">
                                           <label for="comment" class="form-label">Comment</label>
                                           <textarea class="form-control" rows="5" name="comment" value="{{isset($editComment) && ($editComment->comments)?$editComment->comments:''}}">{{isset($editComment) && ($editComment->comments)?$editComment->comments:''}}</textarea>
                                       </div>
                                       <div class="form-group">
                                           <label for="contact_name" class="form-label">Contact Name</label>
                                           <input type="text" class="form-control" name="contact_name" value="{{isset($editComment) && ($editComment->contact_name)?$editComment->comments:''}}">
                                       </div>
                                        @if(isset($editComment) && ($editComment->pk_comment))
                                        <input type="hidden" name="pk_vendors" value ="{{isset($editComment) && ($editComment->pk_vendors) ?$editComment->pk_vendors : ''}}">
                                        @else
                                       <input type="hidden" name="pk_vendors" value ="{{isset($vendor) && ($vendor->pk_vendors) ? $vendor->pk_vendors : ''}}">
                                       @endif
                                        <input type="hidden" name="pk_comment" value ="{{isset($editComment) && ($editComment->pk_comment) ? $editComment->pk_comment : ''}}">
                                         <a href ='/accountadmin/vendors/back'><input class="btn btn-primary" type="button" value="Cancel"></a>
                                         <input class="btn btn-primary" type="submit" value="{{isset($editComment) && ($editComment->pk_vendors) ? 'Update' : 'Submit'}}">
                                   </form>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
               <hr>
               <div class="row">
                   <div class="col-12">
                       <div class="card">
                           <div class="card-body">
                               <!-- <h4 class="card-title">Comments Export</h4>
                               <h6 class="card-subtitle">Export Comments to Copy, CSV, Excel, PDF & Print</h6> -->
                               <div class="table-responsive m-t-40">
                                   <table id="example23"
                                       class="display nowrap table table-hover table-striped border"
                                       cellspacing="0" width="100%">
                                       <thead>
                                           <tr>
                                               <th>Comment Date & User</th>
                                               <th>Contact Name</th>
                                               <th>Comments</th>
                                               <th style="text-align:center;">Actions</th>
                                           </tr>
                                       </thead>
                                       <tbody>

                                           @foreach($comments as $comment)
                                           <tr>
                                           <td>{{$comment->created_at->format('m/d/Y')}} Comment By {{auth()->user()->first_name}} {{auth()->user()->last_name}}</td>
                                            <td>{{$comment->contact_name}}</td>
                                            <td>{{$comment->comments}}</td>
                                            <td>
                                              <!-- <a href="/accountadmin/vendors/comments/edit/{{$comment->pk_comment}}">-->
                                              <button class="btn btn-danger text-white" id="vendor-edit-comment" data="{{$comment->pk_comment}}">Edit</button>
                                              <a href="/accountadmin/vendors/comments/delete/{{$comment->pk_comment}}"><button class="btn btn-danger text-white">Delete</button></a>
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
               <div class="tab-pane p-20" id="orders" role="tabpanel">Test25</div>
               <div class="tab-pane p-20" id="invoices" role="tabpanel">Test13</div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
@endsection
