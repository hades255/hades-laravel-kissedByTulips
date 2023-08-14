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
               <li class="breadcrumb-item active"><a href="/accountadmin/customers">Customer</a></li>
            </ol>
            <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i class="fa fa-plus-circle"></i>{{isset($customer) && ($customer->pk_customers) ? 'Edit '.$customer->customer_name :'Create New Customer'}}</button>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-body p-b-0">
               <h4 class="card-title">{{isset($customer) && ($customer->pk_customers) ? 'Edit ' .$customer->customer_name:'Create New Customer'}}</h4>
            </div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs customtab" role="tablist">
               <li class="nav-item"> <a class="nav-link {{isset($tab) && ($tab == 'comment-edit') ? '' : 'active'}}" data-bs-toggle="tab" href="#customerinfo" role="tab" aria-selected="true"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Customer Info</span></a> </li>
               <!-- <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#contacts" role="tab" aria-selected="false"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Contacts</span></a> </li>
               <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#quotes" role="tab" aria-selected="false"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Quotes</span></a> </li>
               <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#shipping" role="tab" aria-selected="false"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Shipping</span></a> </li> -->
               <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#orders" role="tab" aria-selected="false"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Orders</span></a> </li>
               <!-- <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#invoices" role="tab" aria-selected="false"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Invoices</span></a> </li> -->
               <li class="nav-item"> <a class="nav-link {{isset($tab) && ($tab == 'comment-edit') ? 'active' : ''}}" data-bs-toggle="tab" href="#comments" role="tab" aria-selected="{{isset($tab) && ($tab == 'comment-edit') ? 'true' : 'false'}}"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Comments</span></a> </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
               <div class="tab-pane p-20 {{isset($tab) && ($tab == 'comment-edit') ? '' : 'active'}}" id="customerinfo" role="tabpanel">
                 <div class="row">
                    <div class="col-lg-12">
                       <div class="card">
                             <div class="form-body">
                               <form method="post" id="vendor-customer-form" action="{{isset($customer) && ($customer->pk_customers) ? '/accountadmin/customers/update' : '/accountadmin/customers/submit'}}">
                                  @csrf
                                <div class="card-body">
                                   <div class="row pt-3">
                                      <div class="col-md-6">
                                         <div class="form-group">
                                            <label class="form-label">Customer Name</label>
                                            <input type="text" name="customer_name" class="form-control @error('customer_name') is-invalid @enderror" value= "{{isset($customer) && ($customer->customer_name) ? $customer->customer_name : old('customer_name')}}">
                                            @error('customer_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                         </div>
                                      </div>
                                      <div class="row">
                                         <div class="col-md-6">
                                           <div class="form-group">
                                              <label class="form-label">Address</label>
                                              <input type="text" name="address" class="form-control" id="autocomplete" value ="{{isset($customer) && ($customer->address) ? $customer->address : old('address')}}">
                                           </div>
                                         </div>
                                         <div class="col-md-6">
                                           <div class="form-group">
                                              <label class="form-label">Ste/Unit #</label>
                                              <input type="text" name="address_1" class="form-control" id="street_number" value ="{{isset($customer) && ($customer->address_1) ? $customer->address_1 : old('address_1')}}" maxlength="10">
                                           </div>
                                         </div>
                                      </div>
                                      <div class="row">
                                         <div class="col-md-4">
                                           <div class="form-group">
                                              <label class="form-label">City</label>
                                              <input type="text" name="city" id="locality" class="form-control" value ="{{isset($customer) && ($customer->city) ? $customer->city : old('city')}}">
                                           </div>
                                         </div>
                                         <div class="col-md-4">
                                           <div class="form-group">
                                              <label class="form-label">State</label>
                                              <input id="administrative_area_level_1" type="text" name="state_name" class="form-control" value ="{{isset($customer) && ($customer->state_name) ? $customer->state_name : old('state_name')}}">
                                           </div>
                                         </div>
                                         <div class="col-md-4">
                                            <div class="form-group">
                                               <label class="form-label">Zip</label>
                                               <input type="text" id="postal_code" name="zip" class="form-control" value ="{{isset($customer) && ($customer->zip) ? $customer->zip : old('zip')}}">
                                            </div>
                                         </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-md-6">
                                             <div class="form-group">
                                                 <label class="form-label">Country</label>
                                                 <input id="country" type="text" name="country_name" class="form-control" value ="{{isset($customer) && ($customer->country_name) ? $customer->country_name : old('country_name')}}">
                                             </div>
                                          </div>
                                      </div>
                                      <div class="row">
                                         <div class="col-md-6">
                                           <div class="form-group">
                                              <label class="form-label">Office Phone</label>
                                              <input type="text" name="office_phone" class="form-control @error('office_phone') is-invalid @enderror "  value ="{{isset($customer) && ($customer->office_phone) ? $customer->office_phone : ''}}">
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
                                              <input type="text" name="email" class="form-control"  value ="{{isset($customer) && ($customer->email) ? $customer->email : ''}}">
                                           </div>
                                         </div>
                                      </div>
                                      <div class="row">
                                         <div class="col-md-6">
                                           <div class="form-group">
                                              <label class="form-label">Fax</label>
                                              <input type="text" name="fax" class="form-control"  value ="{{isset($customer) && ($customer->fax) ? $customer->fax : ''}}">
                                           </div>
                                         </div>
                                      </div>
                                      <div class="row">
                                         <div class="col-md-6">
                                           <div class="form-group">
                                              <label class="form-label" id="customerlabelLat">Lat: <span id="latLab">{{isset($customer) && ($customer->lat) ? $customer->lat : ''}}</span></label>
                                              {{-- @if(isset($customer) && ($customer->lat)) --}}
                                              <input type="hidden" id="lat_value" name="lat" value="{{isset($customer) && ($customer->lat) ? $customer->lat : ''}}">
                                             {{-- @endif --}}
                                           </div>
                                         </div>
                                      </div>
                                      <div class="row">
                                         <div class="col-md-6">
                                           <div class="form-group">
                                             <label class="form-label" id="customerlabelLng">Lng: <span id="lngLab">{{isset($customer) && ($customer->lng) ? $customer->lng : ''}}</span></label>
                                              {{-- @if(isset($customer) && ($customer->lng)) --}}
                                              <input type="hidden" id="lng_value" name="lng" value="{{isset($customer) && ($customer->lng) ? $customer->lng : ''}}">
                                             {{-- @endif --}}
                                           </div>
                                         </div>
                                      </div>
                                      @if(isset($customer) && ($customer->pk_customers))
                                      <div class="form-group">
                                          <label class="form-label">Active</label>
                                              <input type="radio" name="active"  value="1" checked="checked" class="form-check-input" style="margin-left: 20px;">
                                              <label class="form-check-label" for="customRadio11">Yes</label>
                                              <input type="radio" name="active" value="0" {{ isset($customer) && ($customer->active=="0")? "checked" : "" }} class="form-check-input" style="margin-left: 20px;">
                                              <label class="form-check-label" for="customRadio22">No</label>
                                      </div>
                                      @endif

                                      <input type="hidden" name="pk_account" class="form-control" value="{{isset($pk_account)?$pk_account:''}}">
                                      <input type="hidden" name="pk_customer_type" class="form-control" value="1">
                                      <input type="hidden" name="pk_customers" class="form-control" value="{{isset($customer) && ($customer->pk_customers)?$customer->pk_customers:''}}">
                                      <input type="hidden" name="pk_roles" class="form-control" value="4">
                                      <input type="hidden" name="pk_users" class="form-control" value="{{isset($customerUser) && ($customerUser->pk_users)?$customerUser->pk_users:''}}">
                                   </div>
                                   <div class="form-actions">
                                      <div class="card-body">
                                        <a href="/accountadmin/customers/back"><input class="btn btn-primary" type="button" value="Cancel"></a>
                                        <input class="btn btn-primary" type="submit" value="{{isset($customer) && ($customer->pk_customers)?'Update':'Submit'}}">
                                      </div>
                                   </div>
                                </div>
                          </form>

                          </div>
                       </div>
                    </div>
                 </div>
               </div>
               <div class="tab-pane p-20" id="orders" role="tabpanel">Test13</div>
               <div class="tab-pane p-20 {{isset($tab) && ($tab == 'comment-edit') ? 'active' : ''}}" id="comments" role="tabpanel">
                 <div class="row">
                    <div class="col-12">
                        <div class="card card-body">
                            <h4 class="card-title">Add Comment</h4>
                            <div class="row">
                                <div class="col-sm-4 col-xs-12">
                                    <form action="/accountadmin/customers/comments/store" method="post">
                                      @csrf
                                        <div class="form-group">
                                            <label for="comment" class="form-label">Comment</label>
                                            <textarea class="form-control @error('comments') is-invalid @enderror" rows="5" name="comments">{{isset($editComment) && ($editComment->comments) ? $editComment->comments :''}}</textarea>
                                            @error('comments')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        @if(isset($editComment) && ($editComment->pk_customers))
                                        <input type ="hidden" name="pk_customers" value="{{isset($editComment) && ($editComment->pk_customers)?$editComment->pk_customers:$customer->pk_customers}}">
                                        @else
                                          <input type ="hidden" name="pk_customers" value="{{isset($customer) && ($customer->pk_customers)?$customer->pk_customers:''}}">
                                        @endif
                                        <input type ="hidden" name="pk_comments" value="{{isset($editComment) && ($editComment->pk_comment)?$editComment->pk_comment:''}}">
                                            <input type="hidden" class="form-control" name="contact_name"  value="{{auth()->user()->first_name}} {{auth()->user()->last_name}}">
                                          <a href="/accountadmin/customers/back"><input class="btn btn-primary" type="button" value="Cancel"></a>
                                          <input class="btn btn-primary" type="submit" value="{{isset($editComment) && ($editComment->contact_name) ? 'Update' :'Submit'}}">
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
                                                <th>User Name</th>
                                                <th>Comments</th>
                                                <th style="text-align:center;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          @if(!empty($comments))
                                          @foreach ($comments as $comment)
                                           <tr>
                                              <td>{{$comment->created_at->format('m/d/Y')}} at {{$comment->created_at->format('H:i:s')}}</td>
                                              <td>{{$comment->contact_name}}</td>
                                              <td>{{$comment->comments}}</td>
                                              <td>
                                                <a href="/accountadmin/customers/comments/customers/{{$comment->pk_customers}}/edit/{{$comment->pk_comment}}"><button class="btn btn-danger text-white">Edit</button></a>
                                                <a href="/accountadmin/customers/comments/delete/{{$comment->pk_comment}}"><button class="btn btn-danger text-white">Delete</button></a>
                                              </td>
                                           </tr>
                                          @endforeach
                                          @endif
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
@endsection

@section('js')
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAB80hPTftX9xYXqy6_NcooDtW53kiIH3A&libraries=places&callback=initAutocomplete" async defer></script>
  <script src="/assets/address-auto-complete.js"></script>
@endsection
