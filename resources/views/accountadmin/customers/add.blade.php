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
                        <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"
                                style="margin-top: -34px;"><i
                                class="fa fa-plus-circle"></i>{{isset($customer) && ($customer->pk_customers) ? 'Edit '.$customer->customer_name :'Create New Customer'}}
                        </button>
                    </div>
                </div>
            </div>
            @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body p-b-0">
                            <h4 class="card-title">
                                {{ isset($customer) && ($customer->pk_customers) ? 'Edit ' . $customer->customer_name : 'Create New Customer' }}
                            </h4>
                        </div>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs customtab" role="tablist">
                            <li class="nav-item"><a
                                    class="nav-link {{isset($tab) && ($tab == 'comment-edit') ? '' : 'active'}}"
                                    data-bs-toggle="tab" href="#customerinfo" role="tab" aria-selected="true"><span
                                        class="hidden-sm-up"></span> <span class="hidden-xs-down">Info</span></a></li>
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#addresstab" role="tab"
                                                    aria-selected="false"><span class="hidden-sm-up"></span> <span
                                        class="hidden-xs-down">Address</span></a></li>
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#orders" role="tab"
                                                    aria-selected="false"><span class="hidden-sm-up"></span> <span
                                        class="hidden-xs-down">Orders</span></a></li>
                            <li class="nav-item"><a
                                    class="nav-link {{isset($tab) && ($tab == 'comment-edit') ? 'active' : ''}}"
                                    data-bs-toggle="tab" href="#comments" role="tab"
                                    aria-selected="{{isset($tab) && ($tab == 'comment-edit') ? 'true' : 'false'}}"><span
                                        class="hidden-sm-up"></span> <span class="hidden-xs-down">Comments</span></a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane p-20 active"
                                 id="customerinfo" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="form-body">
                                                <form method="post" id="vendor-customer-form"
                                                      action="{{ isset($customer) && ($customer->pk_customers) ? '/accountadmin/customers/update' : '/accountadmin/customers/submit' }}">
                                                    @csrf
                                                    <div class="card-body">
                                                        <div class="row pt-3">

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="form-label">Customer Name</label>
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

                                                            <div class="col-md-2">
                                                                <div class="form-group" style="margin-top: 36px;">
                                                                    <input type="checkbox" name="login_enable"
                                                                           class="form-check-input @error('login_enable') is-invalid @enderror"
                                                                           id="accountadmincustomerloginform" {{isset($customer) && ($customer->login_enable == 1) || old('login_enable') ? 'checked' : ''}}>
                                                                    <label class="form-check-label" for="customCheck1"
                                                                           style="margin-left:20px;">Enable
                                                                        Login</label>
                                                                    @error('login_enable')
                                                                    <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                                </span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row" id="loginform">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="form-label">User Name</label>
                                                                        <input type="text" name="username"
                                                                               class="form-control @error('username') is-invalid @enderror"
                                                                               value="{{isset($customerUser) && ($customerUser->username) ? $customerUser->username : old('username')}}">
                                                                        @error('username')
                                                                        <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                @if(!isset($customerUser->username))
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Password</label>
                                                                            <input type="password" name="password"
                                                                                   class="form-control @error('password') is-invalid @enderror">
                                                                            @error('password')
                                                                            <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                  </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Confirm
                                                                                Password</label>
                                                                            <input type="password"
                                                                                   name="password_confirmation"
                                                                                   class="form-control @error('password_confirmation') is-invalid @enderror">
                                                                            @error('password_confirmation')
                                                                            <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                  </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="form-label">Office Phone</label>
                                                                    <input type="text" name="office_phone"
                                                                           class="form-control @error('office_phone') is-invalid @enderror "
                                                                           value="{{isset($customer) && ($customer->office_phone) ? $customer->office_phone : ''}}">
                                                                    @error('office_phone')
                                                                    <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                                </span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="form-label">Email</label>
                                                                    <input type="text" name="email" class="form-control"
                                                                           value="{{isset($customer) && ($customer->email) ? $customer->email : ''}}">
                                                                </div>
                                                            </div>

                                                            @if(isset($customer) && ($customer->pk_customers))
                                                                <div class="form-group">
                                                                    <label class="form-label"
                                                                           style="margin-left: 18px;margin-top: 10px;">Active</label>
                                                                    <input type="radio" name="active" value="1"
                                                                           checked="checked" class="form-check-input"
                                                                           style="margin-left: 20px;">
                                                                    <label class="form-check-label" for="customRadio11"
                                                                           style="margin-left: 44px;">Yes</label>
                                                                    <input type="radio" name="active" value="0"
                                                                           {{ isset($customer) && ($customer->active=="0")? "checked" : "" }} class="form-check-input"
                                                                           style="margin-left: 20px;">
                                                                    <label class="form-check-label" for="customRadio22"
                                                                           style="margin-left: 44px;">No</label>
                                                                </div>
                                                            @endif

                                                            <input type="hidden" name="pk_account" class="form-control"
                                                                   value="{{isset($pk_account)?$pk_account:''}}">
                                                            <input type="hidden" name="pk_customer_type"
                                                                   class="form-control" value="1">
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
                                                                       value="{{isset($customer) && ($customer->pk_customers)?'Update':'Submit'}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="tab-pane p-20"
                                 id="addresstab" role="tabpanel">

                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body2">
                                                <!-- <h6 class="card-subtitle">Export Customers to Copy, CSV, Excel, PDF & Print</h6> -->
                                                <div class="table-responsive m-t-40">
                                                    @if(isset($customer) && !empty($customer->pk_customers))
                                                        <a href="/accountadmin/customers/address/add/{{$customer->pk_customers}}">
                                                            <button class="btn btn-danger text-white card-title"
                                                                    style="float: right;margin-right: 36px;margin-left: 20px;margin-top: 4px;">
                                                                Add Address
                                                            </button>
                                                        </a>
                                                    @else
                                                        <a href="javascript:void(0)">
                                                            <button class="btn btn-danger text-white card-title"
                                                                    style="float: right;margin-right: 36px;margin-top: 4px;">
                                                                First Add Customer
                                                            </button>
                                                        </a>
                                                    @endif
                                                    <table id="example23"
                                                           class="display nowrap table table-hover table-striped border"
                                                           cellspacing="0" width="100%">
                                                        <thead>
                                                        <tr>
                                                            <th>Address</th>
                                                            <th>Ste/Unit</th>
                                                            <th>City</th>
                                                            <th>State</th>
                                                            <th style="text-align:center;">Actions</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @if(!empty($customer_address))
                                                            @foreach($customer_address as $addres_val)
                                                                <tr>
                                                                    <td onclick="window.location='{{ route('accountadmin.customers.address_edit', ['id' => $addres_val->pk_customer_address]) }}'">
                                                                        {{ @$addres_val->address }}
                                                                    </td>
                                                                    <td onclick="window.location='{{ route('accountadmin.customers.address_edit', ['id' => $addres_val->pk_customer_address]) }}'">
                                                                        {{ @$addres_val->address_1 }}
                                                                    </td>
                                                                    <td onclick="window.location='{{ route('accountadmin.customers.address_edit', ['id' => $addres_val->pk_customer_address]) }}'">
                                                                        {{ @$addres_val->city }}
                                                                    </td>
                                                                    <td onclick="window.location='{{ route('accountadmin.customers.address_edit', ['id' => $addres_val->pk_customer_address]) }}'">
                                                                        {{ @$addres_val->state->state_code }}
                                                                    </td>
                                                                    <td style="text-align:center;">
                                                                        <a href="/accountadmin/customers/address/edit/{{$addres_val->pk_customer_address}}/">
                                                                            <button class="btn btn-danger text-white">
                                                                                Edit
                                                                            </button>
                                                                        </a>
                                                                        <a href="/accountadmin/customers/address/delete/{{$addres_val->pk_customer_address}}">
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


                            <div class="tab-pane p-20" id="orders" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                @if(isset($orders))
                                                    <div class="table-responsive m-t-40">
                                                        <table id="example23"
                                                               class="display nowrap table table-hover table-striped border"
                                                               cellspacing="0" width="100%">
                                                            <thead>
                                                            <tr>
                                                                <th>Order</th>
                                                                <th class="text-center">Date</th>
                                                                <th>Status</th>
                                                                <th>Total</th>
                                                                <th style="text-align:center;">Actions</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @if($orders->count())
                                                                @foreach($orders as $order)
                                                                    <tr onclick="window.location='/accountadmin/orders/{{ $order->pk_orders }}'"
                                                                        style="cursor: pointer">
                                                                        <td>{{ $order->pk_orders }}</td>
                                                                        <td>{{ date('m/d/Y', strtotime($order->created_at)) }}</td>
                                                                        <td>{{ strtoupper($order->orderStatus->order_status) ?? 'NEW' }}</td>
                                                                        <td>${{ number_format($order->total, 2) }}</td>
                                                                        <td style="width:450px;height:40px;">
                                                                            @if ($order->pk_order_status == 3)
                                                                                <a style="height: 60px;
    width: 167px;"
                                                                                   href="/accountadmin/orders/cancel/{{ $order->pk_orders }}"
                                                                                   class="btn btn-primary">Cancel the
                                                                                    Order </a>
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @else
                                                                <tr>
                                                                    <td class="text-center" colspan="100%">
                                                                        No orders found!
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                @else
                                                    <div class="text-center">
                                                        <a href="{{ route('accountadmin.customers.add') }}"
                                                           class="btn btn-primary">
                                                            First Create Customer
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane p-20" id="comments" role="tabpanel">
                                @if(isset($customer) && isset($comments))
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card card-body">
                                                <h4 class="card-title">Add Comment</h4>
                                                <div class="row">
                                                    <div class="col-sm-4 col-xs-12">
                                                        <form action="/accountadmin/customers/comments/store"
                                                              method="post">
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
                                                                <input type="hidden" name="pk_customers"
                                                                       value="{{isset($editComment) && ($editComment->pk_customers)?$editComment->pk_customers:$customer->pk_customers}}">
                                                            @else
                                                                <input type="hidden" name="pk_customers"
                                                                       value="{{isset($customer) && ($customer->pk_customers)?$customer->pk_customers:''}}">
                                                            @endif
                                                            <input type="hidden" name="pk_comments"
                                                                   value="{{isset($editComment) && ($editComment->pk_comment)?$editComment->pk_comment:''}}">
                                                            <input type="hidden" class="form-control"
                                                                   name="contact_name"
                                                                   value="{{auth()->user()->first_name}} {{auth()->user()->last_name}}">
                                                            <a href="/accountadmin/customers/back"><input
                                                                    class="btn btn-primary" type="button"
                                                                    value="Cancel"></a>
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
                                                            @if($comments->count())
                                                                @foreach ($comments as $comment)
                                                                    <tr>
                                                                        <td>{{$comment->created_at->format('m/d/Y')}}
                                                                            at {{$comment->created_at->format('H:i:s')}}
                                                                            <br><span>{{$comment->contact_name}}</span>
                                                                        </td>
                                                                        <td>{{$comment->comments}}</td>
                                                                        <td style="text-align:center;">
                                                                            <a href="/accountadmin/customers/comments/customers/{{$comment->pk_customers}}/edit/{{$comment->pk_comment}}">
                                                                                <button
                                                                                    class="btn btn-danger text-white">
                                                                                    Edit
                                                                                </button>
                                                                            </a>
                                                                            <a href="/accountadmin/customers/comments/delete/{{$comment->pk_comment}}">
                                                                                <button
                                                                                    class="btn btn-danger text-white">
                                                                                    Delete
                                                                                </button>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @else
                                                                <tr>
                                                                    <td class="text-center" colspan="100%">
                                                                        No comments found!
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <a href="{{ route('accountadmin.customers.add') }}"
                                               class="btn btn-primary">
                                                First Create Customer
                                            </a>
                                        </div>
                                    </div>
                                @endif

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

    @if(isset($tab) && $tab == 'comment-edit')
        <script>
            $(document).ready(function () {
                $('#customerinfo').tab('hide');
                $('#comments').tab('show');
            });
        </script>
    @endif
@endsection


