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
                        <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white" style="
    margin-top: -34px;">
                            <i class="fa fa-plus-circle"></i> {{isset($customer) && ($customer->pk_customers) ? 'Edit' : 'Create New'}}
                            Business
                        </button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body p-b-0">
                            <h4 class="card-title">{{isset($customer) && ($customer->pk_customers) ? 'Edit' : 'Create New'}}
                                Business</h4>
                        </div>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs customtab" role="tablist">
                            <li class="nav-item"><a class="nav-link @if( !request()->get('tab') ){{'active'}}@endif"
                                                    data-bs-toggle="tab" href="#customerinfo" role="tab"
                                                    aria-selected="true"><span class="hidden-sm-up"></span> <span
                                        class="hidden-xs-down">Info</span></a></li>
                            <li class="nav-item"><a
                                    class="nav-link @if( request()->get('tab') == 'contact' ){{'active'}}@endif"
                                    data-bs-toggle="tab" href="#contacts" role="tab" aria-selected="false"><span
                                        class="hidden-sm-up"></span> <span
                                        class="hidden-xs-down">Contacts</span></a>
                            </li>
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#quotes" role="tab"
                                                    aria-selected="false"><span class="hidden-sm-up"></span> <span
                                        class="hidden-xs-down">Quotes</span></a></li>
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#shipping" role="tab"
                                                    aria-selected="false"><span class="hidden-sm-up"></span> <span
                                        class="hidden-xs-down">Shipping</span></a></li>
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#orders" role="tab"
                                                    aria-selected="false"><span class="hidden-sm-up"></span> <span
                                        class="hidden-xs-down">Orders</span></a></li>
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#invoices" role="tab"
                                                    aria-selected="false"><span class="hidden-sm-up"></span> <span
                                        class="hidden-xs-down">Invoices</span></a></li>
                            <li class="nav-item"><a
                                    class="nav-link @if( request()->get('tab') == 'comment' ){{'active'}}@endif"
                                    data-bs-toggle="tab" href="#comments" role="tab" aria-selected="false"><span
                                        class="hidden-sm-up"></span> <span
                                        class="hidden-xs-down">Comments</span></a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane p-20 @if( !request()->get('tab') ){{'active'}}@endif" id="customerinfo"
                                 role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="form-body">
                                                <form method="post" id="vendor-customer-form"
                                                      action="{{isset($customer) && ($customer->pk_customers) ? '/accountadmin/customer-business/update' : '/accountadmin/customer-business/submit'}}">
                                                    @csrf
                                                    <div class="card-body">
                                                        <div class="row pt-3">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="form-label">Contact Name</label>
                                                                    <input type="text" name="customer_name"
                                                                           class="form-control @error('customer_name') is-invalid @enderror"
                                                                           value="{{isset($customer) && ($customer->customer_name) ? $customer->customer_name : old('customer_name')}}">
                                                                    @error('customer_name')
                                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <div class="form-group">
                                                                        <label class="form-label" style="width: 130px;">Customer
                                                                            Type</label>
                                                                        <select
                                                                            class="form-control @error('customer_type') is-invalid @enderror form-select"
                                                                            name="customer_type"
                                                                            style="width: 425px;">
                                                                            <option value="">Choose--</option>
                                                                            @foreach($customer_types->slice(1) as $customer_type)
                                                                                <option
                                                                                    value="{{$customer_type->pk_customer_type}}" {{ isset($customer) && ($customer->pk_customer_type  == $customer_type->pk_customer_type) || old('pk_customer_type') == $customer_type->pk_customer_type ? 'selected' : '' }}>{{$customer_type->customer_type}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('customer_type')
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
                                                                        <label class="form-label"
                                                                               style="margin-left: -232px;width: 120px;">User
                                                                            Name</label>
                                                                        <input type="text" name="username"
                                                                               class="form-control @error('username') is-invalid @enderror"
                                                                               value="{{isset($customerUser) && ($customerUser->username) ? $customerUser->username : old('username')}}"
                                                                               style="margin-left: -236px;width: 750px;">
                                                                        @error('username')
                                                                        <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                  </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4" style="margin-left: 18px;">
                                                                    <div class="form-group">
                                                                        <label class="form-label">Address</label>
                                                                        <input type="text" id="autocomplete"
                                                                               name="address" class="form-control"
                                                                               value="{{isset($customer) && ($customerPrimaryAddr) ? $customerPrimaryAddr->address : old('address')}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="form-label">Ste/Unit #</label>
                                                                        <input id="street_number" type="text"
                                                                               name="address_1" class="form-control"
                                                                               value="{{isset($customer) && ($customerPrimaryAddr) ? $customerPrimaryAddr->address_1 : old('address_1')}}"
                                                                               maxlength="10">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label class="form-label">City</label>
                                                                        <input id="locality" type="text" name="city"
                                                                               class="form-control"
                                                                               value="{{isset($customer) && ($customerPrimaryAddr) ? $customerPrimaryAddr->city : old('city')}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label class="form-label">State</label>
                                                                        <input id="administrative_area_level_1"
                                                                               type="text" name="state_name"
                                                                               class="form-control"
                                                                               value="{{isset($customer) && ($customerPrimaryAddr) ? $customerPrimaryAddr->state->state_code : old('state_name')}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label class="form-label">Zip</label>
                                                                        <input type="text" id="postal_code" name="zip"
                                                                               class="form-control"
                                                                               value="{{isset($customer) && ($customerPrimaryAddr) ? $customerPrimaryAddr->zip : old('zip')}}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="form-label"
                                                                               style="margin-left: 20px;">Country</label>
                                                                        <input id="country" type="text"
                                                                               name="country_name" class="form-control"
                                                                               value="USA" readonly
                                                                               style="width: 250px;margin-left: 20px;">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6" style="margin-left: 20px;">
                                                                    <div class="form-group">
                                                                        <label class="form-label" style="width: 114px;">Office
                                                                            Phone</label>
                                                                        <input type="text" name="office_phone"
                                                                               class="form-control @error('office_phone') is-invalid @enderror "
                                                                               value="{{isset($customer) && ($customer->office_phone) ? $customer->office_phone : ''}}"
                                                                               style="width: 350px;">
                                                                        @error('office_phone')
                                                                        <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                  </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row" style="margin-left:150px;">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="form-label"
                                                                               style="margin-left: -156px;">Email</label>
                                                                        <input type="text" name="email"
                                                                               style="margin-left: -156px;width: 560px;"
                                                                               class="form-control"
                                                                               value="{{isset($customer) && ($customer->email) ? $customer->email : ''}}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row" style="margin-left:150px;">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="form-label" id="customerlabelLat"
                                                                               style="margin-left: -485px;">Lat: <span
                                                                                id="latLab">{{isset($customer) && ($customer->lat) ? $customer->lat : ''}}</span></label>
                                                                        {{-- @if(isset($customer) && ($customer->lat)) --}}
                                                                        <input type="hidden" id="lat_value" name="lat"
                                                                               value="{{isset($customer) && ($customer->lat) ? $customer->lat : ''}}">
                                                                        {{-- @endif --}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="form-label" id="customerlabelLng"
                                                                               style="margin-left: -330px;">Lng: <span
                                                                                id="lngLab">{{isset($customer) && ($customer->lng) ? $customer->lng : ''}}</span></label>
                                                                        {{-- @if(isset($customer) && ($customer->lng)) --}}
                                                                        <input type="hidden" id="lng_value" name="lng"
                                                                               value="{{isset($customer) && ($customer->lng) ? $customer->lng : ''}}">
                                                                        {{-- @endif --}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @if(isset($customer) && ($customer->pk_customers))
                                                                <div class="form-group">
                                                                    <label class="form-label">Active</label>
                                                                    <input type="radio" name="active" value="1"
                                                                           checked="checked" class="form-check-input"
                                                                           style="margin-left: 20px;">
                                                                    <label class="form-check-label" for="customRadio11">Yes</label>
                                                                    <input type="radio" name="active" value="0"
                                                                           {{ isset($customer) && ($customer->active=="0")? "checked" : "" }} class="form-check-input"
                                                                           style="margin-left: 20px;">
                                                                    <label class="form-check-label" for="customRadio22">No</label>
                                                                </div>
                                                            @endif
                                                            <input type="hidden" name="pk_account" class="form-control"
                                                                   value="{{isset($pk_account)?$pk_account:''}}">
                                                            <input type="hidden" name="pk_customers"
                                                                   class="form-control"
                                                                   value="{{isset($customer) && ($customer->pk_customers)?$customer->pk_customers:''}}">
                                                            <input type="hidden" name="pk_roles" class="form-control"
                                                                   value="4">
                                                            <input type="hidden" name="pk_users" class="form-control"
                                                                   value="{{isset($customerUser) && ($customerUser->pk_users)?$customerUser->pk_users:''}}">
                                                        </div>
                                                        <div class="form-actions">
                                                            <div class="card-body">
                                                                <a href="/accountadmin/customers/back"><input
                                                                        class="btn btn-primary" type="button"
                                                                        value="Cancel"></a>
                                                                <input class="btn btn-primary" type="submit"
                                                                       name="submit"
                                                                       value="{{isset($customer) && ($customer->pk_customers)?'Update':'Submit'}}">
                                                                <input class="btn btn-primary" type="submit"
                                                                       name="submit"
                                                                       value="{{isset($customer) && ($customer->pk_customers)?'Update And Next':'Save And Next'}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane p-20 @if( request()->get('tab') == 'contact' ){{'active'}}@endif"
                                 id="contacts" role="tabpanel">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <!-- <h6 class="card-subtitle">Export Customers to Copy, CSV, Excel, PDF & Print</h6> -->
                                                <div class="table-responsive m-t-40">
                                                    @if(isset($customer) && !empty($customer->pk_customers))
                                                        <a href="/accountadmin/customers/contacts/add/{{$customer->pk_customers}}">
                                                            <button class="btn btn-danger text-white card-title"
                                                                    style="float: right;margin-right: 36px;margin-left: 20px;margin-top: 4px;">
                                                                Add Contact
                                                            </button>
                                                        </a>
                                                    @else
                                                        <a href="#">
                                                            <button class="btn btn-danger text-white card-title"
                                                                    style="float: right;margin-right: 36px;margin-top: 4px;">
                                                                First Add Business Customer
                                                            </button>
                                                        </a>
                                                    @endif
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
                                                        @if(!empty($customercontacts))
                                                            @foreach($customercontacts as $customer)
                                                                <tr>
                                                                    <td onclick="window.location='{{ route('accountadmin.customers.contacts.edit', ['id' => $customer->pk_customer_contacts]) }}'">{{$customer->contact_name}}</td>
                                                                    <td onclick="window.location='{{ route('accountadmin.customers.contacts.edit', ['id' => $customer->pk_customer_contacts]) }}'">{{$customer->department}}</td>
                                                                    <td onclick="window.location='{{ route('accountadmin.customers.contacts.edit', ['id' => $customer->pk_customer_contacts]) }}'">{{$customer->email}}</td>
                                                                    <td onclick="window.location='{{ route('accountadmin.customers.contacts.edit', ['id' => $customer->pk_customer_contacts]) }}'">{{$customer->office_phone}}</td>
                                                                    <td style="text-align:center;">
                                                                        <a href="/accountadmin/customers/contacts/edit/{{$customer->pk_customer_contacts}}/">
                                                                            <button class="btn btn-danger text-white">
                                                                                Edit
                                                                            </button>
                                                                        </a>
                                                                        <a href="/accountadmin/customers/contacts/delete/{{$customer->pk_customer_contacts}}">
                                                                            <button class="btn btn-danger text-white">
                                                                                Delete
                                                                            </button>
                                                                        </a>
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
                            <div class="tab-pane p-20" id="quotes" role="tabpanel">Test3</div>
                            <div class="tab-pane p-20" id="shipping" role="tabpanel">Test25</div>
                            <div class="tab-pane p-20" id="orders" role="tabpanel">Test13</div>
                            <div class="tab-pane p-20" id="invoices" role="tabpanel">invo25</div>
                            <div class="tab-pane p-20 @if( request()->get('tab') == 'comment' ){{'active'}}@endif"
                                 id="comments" role="tabpanel">
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
                                                            <textarea
                                                                class="form-control @error('comments') is-invalid @enderror"
                                                                rows="5"
                                                                name="comments">{{isset($editComment) && ($editComment->comments) ? $editComment->comments :''}}</textarea>
                                                            @error('comments')
                                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                            @enderror
                                                        </div>
                                                        @if(isset($editComment) && ($editComment->pk_customers))
                                                            )
                                                            <input type="hidden" name="pk_customers"
                                                                   value="{{isset($editComment) && ($editComment->pk_customers)?$editComment->pk_customers:$customer->pk_customers}}">
                                                        @else
                                                            <input type="hidden" name="pk_customers"
                                                                   value="{{isset($customer) && ($customer->pk_customers)?$customer->pk_customers:''}}">
                                                        @endif
                                                        <input type="hidden" name="pk_comments"
                                                               value="{{isset($editComment) && ($editComment->pk_comment)?$editComment->pk_comment:''}}">
                                                        <input type="hidden" class="form-control" name="contact_name"
                                                               value="{{auth()->user()->first_name}} {{auth()->user()->last_name}}">
                                                        <input class="btn btn-primary" type="button" value="Reset">
                                                        <input class="btn btn-primary" type="submit"
                                                               value="{{isset($editComment) && ($editComment->contact_name) ? 'Update' :'Submit'}}">
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
                                                            <!-- <th>User Name</th> -->
                                                            <th>Comments</th>
                                                            <th style="text-align:center;">Actions</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @if(!empty($comments))
                                                            @foreach ($comments as $comment)
                                                                <tr>
                                                                    <td>{{$comment->created_at->format('m/d/Y')}}
                                                                        at {{$comment->created_at->format('H:i:s')}}
                                                                        <br><span>{{$comment->contact_name}}</span></td>
                                                                    <td>{{$comment->comments}}</td>
                                                                    <td style="text-align:center;">
                                                                        <a href="/accountadmin/customers/comments/customers/{{$comment->pk_customers}}/edit/{{$comment->pk_comment}}">
                                                                            <button class="btn btn-danger text-white">
                                                                                Edit
                                                                            </button>
                                                                        </a>
                                                                        <a href="/accountadmin/customers/comments/delete/{{$comment->pk_comment}}">
                                                                            <button class="btn btn-danger text-white">
                                                                                Delete
                                                                            </button>
                                                                        </a>
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
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAB80hPTftX9xYXqy6_NcooDtW53kiIH3A&libraries=places&callback=initAutocomplete"
        async defer></script>
    <script src="/assets/address-auto-complete.js"></script>
@endsection
