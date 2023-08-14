@extends('layouts.frontend')

@section('title', 'Cart')

@section('content')

    <style>
        .loader {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 60px;
            height: 60px;
            -webkit-animation: spin 2s linear infinite;
            /* Safari */
            animation: spin 2s linear infinite;
        }

        /* Safari */
        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .loader1 {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 20px;
            height: 20px;
            -webkit-animation: spin 2s linear infinite;
            /* Safari */
            animation: spin1 2s linear infinite;
        }

        /* Safari */
        @-webkit-keyframes spin1 {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin1 {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    <div class="container">
        <div class="py-3 text-center">
            <h2>Checkout</h2>
        </div>
        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your Cart</span>
                    <span
                        class="badge badge-secondary badge-pill">{{ session('oth_total_quantity') ? session('oth_total_quantity') : 0 }}</span>
                </h4>
                <?php $total = 0;
                $total_qty   = 0; ?>
                <ul class="list-group mb-3 sticky-top">
                    @if (session('oth_cart'))
                        @foreach ((array) session('oth_cart') as $id => $details)
                                <?php
                                $total     += $details['price'] * $details['quantity'];
                                $total_qty += $details['quantity'];
                                ?>

                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0" id="cart-item-name{{ $id }}">{{ $details['name'] }}</h6>
                                    <small class="text-muted">{{ $details['description'] }}</small>
                                </div>
                                <span class="text-muted">${{ $details['price'] * $details['quantity'] }}</span>
                            </li>
                        @endforeach
                    @endif
                    <li class="list-group-item d-flex justify-content-between lh-condensed dlCast"
                        id="g-delivery-charge">
                        <div class="DeliveryChargeDiv">
                            <h6 class="my-0">Delivery Charge
                                <br><small class="stncity"></small>
                            </h6>
                            <small class="estimate_del"></small>
                        </div>
                        <!-- <span class=""></span> -->
                        <span class="text-muted deleveryCast loade DeliveryChargeDiv">$0</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed dlCast">
                        <div class="taxR">

                        </div>
                        <span class="text-muted taxRa loade"></span>

                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed dlCast">
                        <div class="disc1">

                        </div>
                        <span class="text-muted disc loadeds"></span>

                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (USD)</span>
                        <strong class="totalCast1 loade">${{ $total }}</strong>
                        <input type="hidden" value="{{ $total }}" class="totalCast">

                    </li>
                </ul>

                <ul class="list-group mb-3 sticky-top" id="cart-item-delivery-charges" style="display: none;">
                </ul>

                <form>
                    <label>Apply Coupon (If you have)</label>
                    <input type="text" name="coupon" class="form-control couponApply" onKeyup="couponApply(this.value)"
                           value="{{ old('coupon') }}">
                </form>

            </div>
            <div class="col-md-8 order-md-1">

                <form method="post" id="vendor-customer-form1">
                    @csrf

                    @auth
                        <h4 class="mb-3">User Details</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label
                                    for="first_name">{!! $user_data->first_name . ' ' . $user_data->last_name !!} {{ $user_data->email ? '(' . $user_data->email . ')' : '' }}</label>
                            </div>
                        </div>

                        @if (!count($kbt_address))
                            <strong>Enter location details and choose Store Pickup to see store list
                            </strong>
                            <div class="mb-3">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address"
                                       value="{!! old('address') !!}">
                                @error('address')
                                <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="address_1">Address 2 <span class="text-muted">(Optional)</span></label>
                                <input type="text" class="form-control" id="address_1" name="address_1"
                                       value="{!! old('address_1') !!}">
                                @error('address_1')
                                <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row mb-3">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">City</label>
                                        <input type="text" name="city" class="form-control" value="{{ old('city') }}"
                                               id="locality" onkeypress="return RestrictCommaSemicolon(event);"
                                               ondrop="return false;" onpaste="return false;"/>
                                        @error('city')
                                        <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">State</label>
                                        <input id="administrative_area_level_1" type="text" name="state_name"
                                               class="form-control" value="{{ old('state_name') }}">
                                        @error('state_name')
                                        <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Zip</label>
                                        <input type="text" id="postal_code" name="zip" class="form-control"
                                               value="{{ old('zip') }}">
                                        @error('zip')
                                        <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Country</label>
                                        <input id="country" type="text" name="country_name" class="form-control"
                                               value="{{ old('country_name', 'USA') }}" readonly>
                                        @error('country_name')
                                        <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <h4 class="mb-3">Ordering as Guest User</h4>
                        <label for=""><a href="{{ url('guestLogin') }}">Login</a> if you are already a user , or <a
                                href="{{ url('guestRegister') }}">Register</a> as New User!</label>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name">First name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name"
                                       value="{!! old('first_name') !!}">
                                @error('first_name')
                                <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="lastName">Last name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name"
                                       value="{!! old('last_name') !!}">
                                @error('last_name')
                                <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="username">Username</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="username" name="username"
                                           value="{!! old('username') !!}">
                                    @error('username')
                                    <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone">Mobile No. <span class="text-muted"></span></label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                       value="{!! old('phone') !!}">
                                @error('phone')
                                <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="email">Email <span class="text-muted"></span></label>
                                <input type="email" class="form-control" id="email" name="email"
                                       value="{!! old('email') !!}">
                                @error('email')
                                <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        <div class="mb-3">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="primary_address" name="primary_address"
                                   value="{{ old('primary_address') }}">
                            @error('primary_address')
                            <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="address_1">Address 2 <span class="text-muted">(Optional)</span></label>
                            <input type="text" class="form-control" id="primary_address_1" name="primary_address_1"
                                   value="{!! old('primary_address_1') !!}">
                            @error('primary_address_1')
                            <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">City</label>
                                    <input type="text" name="primary_city" id="primary_city" class="form-control"
                                           value="{{ old('primary_city') }}"
                                           onkeypress="return RestrictCommaSemicolon(event);" ondrop="return false;"
                                           onpaste="return false;">
                                    @error('primary_city')
                                    <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">State</label>
                                    <input id="primary_state_name" type="text"
                                           name="primary_state_name"
                                           class="form-control" value="{{ old('primary_state_name') }}">
                                    @error('primary_state_name')
                                    <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Zip</label>
                                    <input type="text" id="primary_postal_code" name="primary_zip" class="form-control"
                                           value="{{ old('primary_zip') }}">
                                    @error('primary_zip')
                                    <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Country</label>
                                    <input id="primary_country" type="text" name="primary_country_name"
                                           class="form-control" readonly
                                           value="{{ old('primary_country_name', 'USA') }}">
                                    @error('primary_country_name')
                                    <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div id="billing-address-section">
                            <h4 class="mb-3">Billing Address</h4>

                            <div class="form-group">
                                <label for="billing_address">Address</label>
                                <input type="text" class="form-control" id="billing_address"
                                       name="billing_address" value="{{ old('billing_address') }}">
                                @error('billing_address')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="billing_address_1">Address 2 <span
                                        class="text-muted">(Optional)</span></label>
                                <input type="text" class="form-control" id="billing_address_1"
                                       name="billing_address_1" value="{{ old('billing_address_1') }}">
                                @error('billing_address_1')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">City</label>
                                        <input type="text" id="billing_city" name="billing_city"
                                               class="form-control billingCity" value="{{ old('billing_city') }}">
                                        @error('billing_city')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">State</label>
                                        <input type="text" id="billing_state_name" name="billing_state_name"
                                               class="form-control"
                                               value="{{ old('billing_state_name') }}">
                                        @error('billing_state_name')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Zip</label>
                                        <input type="text" id="billing_zip" name="billing_zip" class="form-control"
                                               value="{{ old('billing_zip') }}">
                                        @error('billing_zip')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Country</label>
                                        <input type="text" id="billing_country_name" name="billing_country_name"
                                               class="form-control" readonly
                                               value="{{ old('billing_country_name', 'USA') }}">
                                        @error('billing_country_name')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endauth

                    <hr class="mb-4">

                        <?php $is_existing_address = ''; ?>

                    @if (!empty($kbt_address))

                        @if($deliveryOptions->count())
                            <div class="">
                                @foreach($deliveryOptions as $deliveryOption)
                                    <input type="radio" name="choise_details" onClick="myFun(this);"
                                           value="{{ $deliveryOption->pk_delivery_or_pickup }}"
                                           data-text="{{ $deliveryOption->delivery_or_pickup }}"
                                        {{ $loop->first ? 'checked' : '' }}> {{ Str::title($deliveryOption->delivery_or_pickup) }}
                                @endforeach
                            </div>
                        @endif

                        @auth
                            <br>
                            <div class="radio">
                                <label><input type="radio" checked name="address_type"
                                              onclick="setExisting(this.checked);"
                                              value="existing" id="existing_address">&nbsp;I want to use an existing
                                    address</label>
                                <div class="col-md-12 mb-3 pl-0">
                                    <select class="custom-select d-block w-100" id="existing_address_id"
                                            name="existing_address_id">
                                        @if($kbt_address->count())
                                            @foreach ($kbt_address as $value)
                                                    <?php

                                                    $full_name        = !empty($value->full_name) ? $value->full_name . ' ' : '';
                                                    $address          = !empty($value->full_name) ? $value->address . ', ' : '';
                                                    $address_1        = !empty($value->address_1) ? $value->address_1 . ', ' : '';
                                                    $city             = !empty($value->city) ? $value->city . ', ' : '';
                                                    $state_name       = !empty($value->state_name) ? $value->state_name . ', ' : '';
                                                    $country_name     = !empty($value->country_name) ? $value->country_name . ' ' : '';
                                                    $zip              = !empty($value->zip) ? $value->zip : '';
                                                    $get_full_address = $full_name . $address . $address_1 . $city . $state_name . $country_name . $zip;

                                                    ?>

                                                <option value="{!! $value->pk_address !!}"
                                                        city="{{ !empty($value->city) ? $value->city : '' }}"
                                                        address="{{ !empty($value->address) ? $value->address : '' }}"
                                                        address_1="{{ !empty($value->address_1) ? $value->address_1 : '' }}"
                                                        postal_code="{{ !empty($value->zip) ? $value->zip : '' }}"
                                                        class="abcde"
                                                        selected="">{!! $get_full_address !!}</option>
                                            @endforeach
                                        @else
                                            <option value="">No data found!</option>
                                        @endif
                                    </select>
                                    @error('address_type')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        @endauth

                        @php
                            $is_existing_address = 1;
                        @endphp
                    @endif

                    @if (!empty($kbt_address))
                        <div class="radio">
                            <label>
                                <input
                                    {{ !$is_existing_address && old('address_type') == 'new_address' ? 'checked' : '' }} type="radio"
                                    onclick="setNewAddress(this.checked);" name="address_type" value="new_address">
                                &nbsp;I want to use a new address
                            </label>
                        </div>
                    @else
                        <input type="hidden" name="address_type" class="store_select" value="new_address">
                    @endif
                    @if (empty($kbt_address))
                        @if($deliveryOptions->count())
                            <div class="">
                                @foreach($deliveryOptions as $deliveryOption)
                                    <input type="radio" name="choise_details" onClick="myFun(this);"
                                           value="{{ $deliveryOption->pk_delivery_or_pickup }}"
                                           data-text="{{ $deliveryOption->delivery_or_pickup }}"
                                        {{ $loop->first ? 'checked' : '' }}> {{ Str::title($deliveryOption->delivery_or_pickup) }}
                                @endforeach
                            </div>
                        @endif
                        <br>
                    @endif

                    <hr>


                    <div class="billing"
                         style="<?php echo empty($is_existing_address) || old('address_type') == 'new_address' ? '' : 'display:none;'; ?>"
                         class="full-address-div">

                        <h3 class="mb-3">
                            <strong>
                                Manage Shipping Address for Items&nbsp;
                            </strong>
                        </h3>
                        @php
                            $total = 0;
                            $total_qty   = 0;
                        @endphp
                        @if (session('oth_cart'))
                            @foreach ((array) session('oth_cart') as $id => $details)
                                @php
                                    $total     += $details['price'] * $details['quantity'];
                                    $total_qty += $details['quantity'];
                                @endphp

                                <div>
                                    <h6 class="my-0" data-name="{{ $id }}">
                                        <strong>{{ $details['name'] }}</strong>
                                    </h6>
                                    <h5>{{ $details['description'] }}</h5>
                                </div>

                                <input type="checkbox" checked id="checkbox{{ $id }}" class="item-address-checkbox"
                                       data-id="{{ $id }}">
                                Use same as Billing Address for this item

                                <div id="div{{ $id }}" style="display: none;">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="manage_shipping_full_name{{ $id }}">Name</label>
                                            <input type="text" class="form-control" id="shipping_full_name{{ $id }}"
                                                   name="item_address[{{ $id }}][shipping_full_name]"
                                                   value="{{ old('item_address') &&
                                                        !empty(old('item_address.'.$id.'.shipping_full_name')) ?
                                                        old('item_address.'.$id.'.shipping_full_name') : '' }}">
                                            @error('item_address.'.$id.'.shipping_full_name')
                                            <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="shipping_phone{{ $id }}">Phone</label>
                                            <input type="text" class="form-control" id="shipping_phone{{ $id }}"
                                                   name="item_address[{{ $id }}][shipping_phone]" value="{{ old('item_address') &&
                                                        !empty(old('item_address.'.$id.'.shipping_phone')) ?
                                                        old('item_address.'.$id.'.shipping_phone') : '' }}">
                                            @error('item_address.'.$id.'.shipping_phone')
                                            <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="billing_address{{ $id }}">Address</label>
                                            <input type="text" class="form-control"
                                                   id="billing_address{{ $id }}"
                                                   name="item_address[{{ $id }}][shipping_address]"
                                                   value="{{ old('item_address') &&
                                                        !empty(old('item_address.'.$id.'.shipping_address')) ?
                                                        old('item_address.'.$id.'.shipping_address') : '' }}">
                                            @error('item_address.'.$id.'.shipping_address')
                                            <span class="invalid-feedback d-block" role="alert">
                                                  <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="billing_address_1{{ $id }}">Address 2 <span
                                                    class="text-muted">(Optional)</span></label>
                                            <input type="text" class="form-control"
                                                   id="billing_address_1{{ $id }}"
                                                   name="item_address[{{ $id }}][shipping_address_1]"
                                                   value="{{ old('item_address') &&
                                                        !empty(old('item_address.'.$id.'.shipping_address_1')) ?
                                                        old('item_address.'.$id.'.shipping_address_1') : '' }}">
                                            @error('item_address.'.$id.'.shipping_address_1')
                                            <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">City</label>
                                                <input type="text"
                                                       onkeypress="return RestrictCommaSemicolon(event);"
                                                       ondrop="return false;" onpaste="return false;"
                                                       id="billing_city{{ $id }}"
                                                       name="item_address[{{ $id }}][shipping_city]"
                                                       class="form-control shipping_city"
                                                       value="{{ old('item_address') &&
                                                        !empty(old('item_address.'.$id.'.shipping_city')) ?
                                                        old('item_address.'.$id.'.shipping_city') : '' }}">

                                                @error('item_address.'.$id.'.shipping_city')
                                                <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">State</label>
                                                <input type="text"
                                                       id="billing_state_name{{ $id }}"
                                                       name="item_address[{{ $id }}][shipping_state_name]"
                                                       class="form-control" value="{{ old('item_address') &&
                                                        !empty(old('item_address.'.$id.'.shipping_state_name')) ?
                                                        old('item_address.'.$id.'.shipping_state_name') : '' }}">
                                                @error('item_address.'.$id.'.shipping_state_name')
                                                <span class="invalid-feedback d-block" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Zip</label>
                                                <input type="text"
                                                       id="shipping_zip{{ $id }}"
                                                       name="item_address[{{ $id }}][shipping_zip]"
                                                       class="form-control"
                                                       value="{{ old('item_address') &&
                                                        !empty(old('item_address.'.$id.'.shipping_zip')) ?
                                                        old('item_address.'.$id.'.shipping_zip') : '' }}">
                                                @error('item_address.'.$id.'.shipping_zip')
                                                <span class="invalid-feedback d-block" role="alert">
                                                              <strong>{{ $message }}</strong>
                                                          </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Country</label>
                                                <input type="text"
                                                       id="shipping_country_name{{ $id }}"
                                                       name="item_address[{{ $id }}][shipping_country_name]"
                                                       class="form-control" readonly
                                                       value="{{ old('item_address') &&
                                                        !empty(old('item_address.'.$id.'.shipping_country_name')) ?
                                                        old('item_address.'.$id.'.shipping_country_name', 'USA') : 'USA' }}">
                                                @error('item_address.'.$id.'.shipping_country_name')
                                                <span class="invalid-feedback d-block" role="alert">
                                                              <strong>{{ $message }}</strong>
                                                          </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="is_same_as_billing{{ $id }}"
                                           name="item_address[{{ $id }}][same_as_billing]" value="{{ old('item_address') &&
                                                        !empty(old('item_address.'.$id.'.same_as_billing')) ?
                                                        old('item_address.'.$id.'.same_as_billing') : 1 }}">
                                    <input type="hidden" id="delivery_charge{{ $id }}"
                                           name="item_address[{{ $id }}][delivery_charge]"
                                           value="{{ old('item_address') &&
                                                        !empty(old('item_address.'.$id.'.delivery_charge')) ?
                                                        old('item_address.'.$id.'.delivery_charge') : 0 }}">
                                </div>
                            @endforeach
                        @endif

                        @php
                            $get_address_type = old('address_type');
                        @endphp
                    </div>

                    <div class="store"
                         style="<?php echo empty($is_existing_address) || old('address_type') == 'new_address' ? '' : 'display:none;'; ?>"
                         class="full-address-div">

                        <div class="loder"></div>
                        <div class="row mt-3 abcd">
                        </div>
                        <div
                            style="{!! (!empty($get_address_type) and !empty(old('is_shipping'))) ? '' : 'display:none;' !!}"
                            class="shipping-address-div">
                        </div>
                    </div>
                    <hr class="mb-4">
                    <h4 class="mb-3">Payment</h4>
                    <input type="hidden" class="form-control amountTotal" id="amount" name="amount"
                           value="{{ $total }}">

                    <input type="hidden" class="form-control deleveryCast1" name="deleveryCast1" value="">

                    <input type="hidden" class="form-control shippingCharge" id="tax_rate" name="shippingCharge"
                           value="">

                    <input type="hidden" class="form-control discountCharge" name="discountCharge" value="">

                    <input type="hidden" class="form-control pk_locations" name="pk_locations" value="">

                    <input type="hidden" class="form-control estimated_del" name="estimated_del" value="">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cc-name">Name on card</label>
                            <input type="text" id="cc_name" name="cc_name" class="form-control"
                                   value="{{ old('cc_name') }}">
                            <small class="text-muted">Full name as displayed on card</small>
                            @error('cc_name')
                            <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="cc-number">Credit card number</label>
                            <input type="text" id="cc_number" name="cc_number" class="form-control"
                                   value="{{ old('cc_number') }}">
                            @error('cc_number')
                            <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-2 mb-3">
                            @php
                                $months = [1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec'];
                            @endphp
                            <label for="expiry_month">Expiration Date</label>
                            <select class="custom-select d-block w-100" id="expiry_month" name="expiry_month">
                                <option value="">Month</option>
                                @foreach ($months as $mkey => $mval)
                                    <option value="{!! $mkey !!}"
                                            @if (old('expiry_month') == $mkey) selected @endif>{!! $mval !!}</option>
                                @endforeach
                            </select>
                            @error('expiry_month')
                            <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-2 mb-3">
                            <label for="expiry_year">&nbsp;</label>
                            <select class="custom-select d-block w-100" id="expiry_year" name="expiry_year"
                                    style="margin-top: 28px !important;">
                                <option value="">Year</option>
                                @for ($i = date('Y'); $i <= date('Y') + 15; $i++)
                                    <option value="{!! $i !!}"
                                            @if (old('expiry_year') == $i) selected @endif>{!! $i !!}</option>
                                @endfor
                            </select>
                            @error('expiry_year')
                            <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-2 mb-3">
                            <label for="cc-cvv">CVV</label>
                            <input type="text" id="cvv" name="cvv" class="form-control d-block w-100"
                                   value="{{ old('cvv') }}" style="margin-top: 28px;height: 38px !important;">
                            @error('cvv')
                            <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- <div class="row">
                      <div class="col-md-12 mb-2">
                        <label for="cc-cvv">Card Message</label>
                        <input type="text" name="card_message" class="form-control d-block w-100" value="{{ old('card_message') }}" style="margin-top: 28px;height: 38px !important;">
                        @error('card_message')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                  </div> -->

                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
                </form>

            </div>
        </div>
    </div>

    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAB80hPTftX9xYXqy6_NcooDtW53kiIH3A&libraries=places&callback=initAutocomplete"
        async defer></script>

    <script type="text/javascript">
        $(document).ready(function () {
            // Get references to the checkboxes and the target divs
            const checkboxes = $('input[type="checkbox"]');
            const divs = $('[id^="div"]');

            // Handle the change event of all checkboxes
            checkboxes.on("change", function () {
                // Loop through each checkbox
                checkboxes.each(function (index) {
                    // Get the corresponding div based on the index
                    const div = divs.eq(index);

                    // Check the state of the checkbox
                    if ($(this).is(":checked")) {
                        div.hide(); // Show the div when the checkbox is checked
                    } else {
                        div.show(); // Hide the div when the checkbox is unchecked
                    }
                });
            });
        });

        var ifLogin = '{{ auth()->id() }}';
        if (ifLogin) {
            var aadd = $('#existing_address_id').val();
            getAddreessById(aadd);

            $('#existing_address_id').on('change', function () {
                getAddreessById($(this).val());
            });
        }

        function getAddreessById(id) {
            $.ajax({
                url     : "{{ url('getAddressId') }}",
                type    : 'post',
                dataType: 'json',
                data    : {
                    '_token': '{{ csrf_token() }}',
                    id      : id,
                },
                success : function (data) {
                    $('.loder').text("");
                    if (data) {
                        var city = data.city;
                        var address = data.address;
                        shippingCity(city, address);
                    }

                },
                complete: function () {
                    $('.loder').text("");
                },
            })
        }

        $('.dlCast').hide();

        function couponApply(value) {
            //alert(value);
            if (value.length === 0) {
                location.reload();
            }
            if (value.length !== 0) {
                // this code
                $.ajax({
                    url       : "{{ url('apply-coupon') }}",
                    type      : 'post',
                    dataType  : 'json',
                    data      : {
                        '_token'  : '{{ csrf_token() }}',
                        couponName: value,
                    },
                    beforeSend: function () {
                        $('.loadeds').html(`<div class="loader1"></div>
                    `);

                    },
                    success   : function (data) {
                        var totalcast = parseFloat($('.amountTotal').val());
                        if (data[1] == 'fixed') {
                            //$('.amountTotal').val(totalcast-data[0]);
                            var to = totalcast - data[0].toFixed(2);
                            $('.totalCast1').html('$' + to);
                            $('.disc1').html(`<h6 class="my-0">Discount (-)
                                     </h6>`);

                            $('.disc').html('$' + data[0]);
                            $('.discountCharge').val('$' + ' ' + data[0]);
                        }
                        if (data[1] == 'percent') {
                            var to = totalcast - (totalcast * data[0] / 100).toFixed(2);
                            $('.totalCast1').html('$' + to);
                            $('.disc1').html(`<h6 class="my-0">Discount (-)
                                      </h6>`);

                            $('.disc').html(data[0] + '%');
                            $('.discountCharge').val(data[0] + ' ' + '%');
                        }
                        // // alert(data[0]);
                        // $('.totalCast1').html('$'+to);
                        // $('.disc1').html(`<h6 class="my-0">Discount (-)
                        //             </h6>`);
                        //
                        // $('.disc').html('$'+ data);
                        // $('.discountCharge').val(data);
                    },
                    complete  : function () {
                        $('.loder').text("");
                    },
                })
                //end code
            }


        }

        function addressUpdate(value, fname, city) {
            console.log(value, fname, city);
            $("#" + fname).val(value);
            $('.couponApply').val('');
            $('.disc1').html('');
            $('.disc').html('');
            var totalcast = parseFloat($('.totalCast').val());
            $('.amountTotal').val(totalcast);
            var to = totalcast;
            $('.totalCast1').html('$' + to);
            $('.discountCharge').val('');


            if (fname == 'billing_city') {
                var address = $('#billing_address').val();
                var Shipcity = city;
            }

            if (fname == 'primary_address') {
                var address = value;
                var Shipcity = $('#primary_city').val();
            }


            $.ajax({
                url       : "{{ url('other-checkoutss') }}",
                type      : 'post',
                dataType  : 'json',
                data      : {
                    '_token': '{{ csrf_token() }}',
                    city    : Shipcity,
                    address : address
                },
                beforeSend: function () {
                    $('.loade').html(`<div class="loader1"></div>
                            `);

                },
                success   : function (data) {
                    var totalcast = parseFloat($('.totalCast').val());
                    var de = data.cost;
                    $('.deleveryCast').text('$' + de);

                    if ($('input[name="choise_details"]:checked').val() == 'store') {
                        var to = totalcast + parseFloat(data.taxRate);
                    } else {
                        var to = totalcast + parseFloat(data.cost) + parseFloat(data.taxRate);
                    }
                    $('.totalCast1').text('$' + to);
                    $('.stncity').html('<small> delivering from ' + data.storeCity + ',' + data.storeName + '</small>')
                    $('.estimate_del').html('<small> Estimated Delivery ,' + data.Estimated_Delivery_Time + '</small>')
                    $('.estimated_del').val(data.Estimated_Delivery_Time);

                    $('.dlCast').css("display", "block!important");
                    $('.taxR').html(`<h6 class="my-0">Tax
                                    </h6>`);
                    $('.taxRa').html('$' + data.taxRate);
                    $('.amountTotal').val(to);
                    $('.deleveryCast1').val(de);
                    $('.shippingCharge').val(data.taxRate);
                    $('.pk_locations').val(data.pk_location)

                    if ($('input[name="choise_details"]:checked').val() == 'store') {
                        console.log(6);
                        $('.DeliveryChargeDiv').hide();
                    }

                },
                complete  : function () {
                    // $('.loade').text("");
                },
            })

        }

        function shippingCity(city, address) {
            console.log(city, address)
            var billCity = $('.billingCity').val();
            $('.couponApply').val('');
            $('.disc1').html('');
            $('.disc').html('');

            var totalcast = parseFloat($('.totalCast').val());
            $('.amountTotal').val(totalcast);
            var to = totalcast;
            $('.totalCast1').html('$' + to);
            $('.discountCharge').val('');

            if (city == billCity) {
                // this code
                $.ajax({
                    url       : "{{ url('other-checkoutss') }}",
                    type      : 'post',
                    dataType  : 'json',
                    data      : {
                        '_token': '{{ csrf_token() }}',
                        city    : city,
                        address : address
                    },
                    beforeSend: function () {
                        $('.loade').html(`<div class="loader1"></div>
                            `);

                    },
                    success   : function (data) {
                        var totalcast = parseFloat($('.totalCast').val());
                        var de = data.cost;
                        $('.deleveryCast').text('$' + de);
                        if ($('input[name="choise_details"]:checked').val() == 'store') {
                            de = 0;
                            var to = totalcast + parseFloat(data.taxRate);
                        } else {
                            var to = totalcast + parseFloat(data.cost) + parseFloat(data.taxRate);
                        }

                        $('.totalCast1').text('$' + to);
                        $('.stncity').html('<small> delivering from ' + data.storeCity + ',' + data.storeName + '</small>')
                        $('.estimate_del').html('<small> Estimated Delivery ,' + data.Estimated_Delivery_Time + '</small>')
                        $('.estimated_del').val(data.Estimated_Delivery_Time);

                        $('.dlCast').css("display", "block!important");
                        $('.taxR').html(`<h6 class="my-0">Tax
                                    </h6>`);
                        $('.taxRa').html('$' + data.taxRate);
                        $('.amountTotal').val(to);
                        $('.deleveryCast1').val(de);
                        $('.shippingCharge').val(data.taxRate);
                        $('.pk_locations').val(data.pk_location)

                        if ($('input[name="choise_details"]:checked').val() == 'store') {
                            console.log(1);
                            $('.DeliveryChargeDiv').hide();
                        }

                    },
                    complete  : function () {
                        $('.loder').text("");
                    },
                })
                //end code
            } else {
                // this code
                $.ajax({
                    url       : "{{ url('other-checkoutss') }}",
                    type      : 'post',
                    dataType  : 'json',
                    data      : {
                        '_token': '{{ csrf_token() }}',
                        city    : city,
                        address : address
                    },
                    beforeSend: function () {
                        $('.loade').html(`<div class="loader1"></div>
                            `);

                    },
                    success   : function (data) {
                        var totalcast = parseFloat($('.totalCast').val());
                        var de = data.cost;
                        $('.deleveryCast').text('$' + de);

                        if ($('input[name="choise_details"]:checked').val() == 'store') {
                            de = 0;
                            var to = totalcast + parseFloat(data.taxRate);
                        } else {
                            var to = totalcast + parseFloat(data.cost) + parseFloat(data.taxRate);
                        }
                        $('.totalCast1').text('$' + to);
                        $('.stncity').html('<small> delivering from ' + data.storeCity + ',' + data.storeName + '</small>')
                        $('.estimate_del').html('<small> Estimated Delivery ,' + data.Estimated_Delivery_Time + '</small>')
                        $('.estimated_del').val(data.Estimated_Delivery_Time);
                        $('.dlCast').css("display", "block!important");
                        $('.taxR').html(`<h6 class="my-0">Tax
                                    </h6>`);
                        $('.taxRa').html('$' + data.taxRate);
                        $('.amountTotal').val(to);
                        $('.deleveryCast1').val(de);
                        $('.shippingCharge').val(data.taxRate);
                        $('.pk_locations').val(data.pk_location)

                        if ($('input[name="choise_details"]:checked').val() == 'store') {
                            console.log(2);
                            $('.DeliveryChargeDiv').hide();
                        }

                    },
                    complete  : function () {
                        $('.loder').text("");
                    },
                })
                //end code
            }
        }

        function setNewAddress(value) {
            var city = $('#billing_city').val();
            var address = $('#billing_address').val();
            if (city) {
                shippingCity(city, address);
            }

            $('.billing').show();
            $('.store').hide();
            $('.full-address-div').hide();
            if (value == true) {
                $('.full-address-div').show();
                $('.copyAdrs').addClass('d-none');
            }
        }

        function setExisting(value) {
            var aadd = $('#existing_address_id').val();
            if (aadd) {
                getAddreessById(aadd);
            }

            $('.full-address-div').hide();
            $('.billing').hide();
            $('.store').hide();
        }

        function myFun(item) {
            let value = $(item).data('text');

            console.log('myFun -> ', value);

            if (value == 'Delivery') {
                // $('.billing').show();
                $('.store').hide();

                var order_add = $('.abcde:selected').attr('city');
                if (order_add) {
                    shippingCity('', order_add);
                } else {
                    var city = ($("#billing_city").val());
                    var address = ($("#billing_address").val());
                    if (city) {
                        shippingCity(city, address);
                    }
                }
                $('.DeliveryChargeDiv').show();
            }

            if (value == 'Store Pickup') {
                var order_add = $('.abcde:selected').attr('city');
                var adds = $('.abcde:selected').attr('address');
                var adds1 = $('.abcde:selected').attr('address_1');
                var zip = $('.abcde:selected').attr('postal_code');
                $('.billing').hide();
                $('.store').show();
                if (order_add) {
                    var city = order_add;
                    var address = adds;
                    var address_1 = adds1;
                    var postal_code = zip;

                } else {
                    var city = ($("#billing_city").val());
                    var address = ($("#billing_address").val());
                    var address_1 = ($("#billing_address_1").val());
                    var postal_code = ($("#billing_zip").val());

                }
                if (city) {
                    shippingCity(city, address);
                }
                $.ajax({
                    url       : "{{ url('other-checkouts') }}",
                    type      : 'post',
                    dataType  : 'json',
                    data      : {
                        '_token'   : '{{ csrf_token() }}',
                        city       : city,
                        address    : address,
                        address_1  : address_1,
                        postal_code: postal_code,
                    },
                    beforeSend: function () {
                        $('.loder').html(`<div class="loader"></div>
                    `);

                    },
                    success   : function (data) {
                        $('.abcd').html(data.html);
                        $('.DeliveryChargeDiv').hide();
                        $('.estimate_del').html('');
                        $('.deleveryCast').html('$' + 0);
                        $('.store_select').attr('value', 'existing');
                    },
                    complete  : function () {
                        $('.loder').text("");
                    },

                });


            }
        }
    </script>

    <script type="text/javascript">
        function RestrictCommaSemicolon(e) {
            var theEvent = e || window.event;
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
            var regex = /[^,;]+$/;
            if (!regex.test(key)) {
                theEvent.returnValue = false;
                if (theEvent.preventDefault) {
                    theEvent.preventDefault();
                }
            }
        }
    </script>

    <script type="text/javascript">
        var addresno = 0;
        var autocomplete;
        var autocomplete2;
        var autocomplete3;
        var autocomplete4;
        var componentForm = {
            street_number: 'short_name',
            //route: 'long_name',
            locality                   : 'long_name',
            administrative_area_level_1: 'short_name',
            country                    : 'long_name',
            postal_code                : 'short_name'
        };

        function initAutocomplete() {
            autocomplete = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */
                (document.getElementById('address')), {
                    componentRestrictions: {
                        country: ["us"]
                    },
                    fields               : ["address_components", "geometry"],
                    types                : ['geocode']
                }
            );
            autocomplete.addListener('place_changed', function () {
                fillInAddress.call(autocomplete, 1)
                var city = ($("#locality").val());
                var address = ($("#address").val());
                if (city) {
                    console.log('city')
                    shippingCity(city, address);
                }
            });

            autocomplete2 = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */
                (document.getElementById('billing_address')), {
                    componentRestrictions: {
                        country: ["us"]
                    },
                    fields               : ["address_components", "geometry"],
                    types                : ['geocode']
                }
            );
            autocomplete2.addListener('place_changed', function () {
                fillInAddress.call(autocomplete2, 2)
            });

            autocomplete3 = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */
                (document.getElementById('shipping_address')), {
                    componentRestrictions: {
                        country: ["us"]
                    },
                    fields               : ["address_components", "geometry"],
                    types                : ['geocode']
                }
            );
            autocomplete3.addListener('place_changed', function () {
                fillInAddress.call(autocomplete3, 3)
            });

            autocomplete4 = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */
                (document.getElementById('primary_address')), {
                    componentRestrictions: {
                        country: ["us"]
                    },
                    fields               : ["address_components", "geometry"],
                    types                : ['geocode']
                }
            );
            autocomplete4.addListener('place_changed', function () {
                fillInAddress.call(autocomplete4, 4)
            });
        }

        function fillInAddress(v1) {
            // Get the place details from the autocomplete object.
            if (v1 == 1) {
                var place = autocomplete.getPlace();
            }
            if (v1 == 2) {
                var place = autocomplete2.getPlace();
            }
            if (v1 == 3) {
                var place = autocomplete3.getPlace();
            }

            if (v1 == 4) {
                var place = autocomplete4.getPlace();
            }

            var new_address = '';
            for (var i = 0; i < place.address_components.length; i++) {
                var addressType = place.address_components[i].types[0];

                if (addressType == 'street_number') {
                    new_address += place.address_components[i]['short_name'];
                    if (v1 == 1) {
                        document.getElementById("address").value = new_address;
                    }
                    if (v1 == 2) {
                        document.getElementById("billing_address").value = new_address;
                    }
                    if (v1 == 3) {
                        document.getElementById("shipping_address").value = new_address;
                    }

                    if (v1 == 4) {
                        $('#primary_address').val(new_address);
                    }
                }
                if (addressType == 'route') {
                    if (new_address)
                        new_address += " " + place.address_components[i]['long_name'];
                    else
                        new_address += place.address_components[i]['long_name'];

                    if (v1 == 1) {
                        document.getElementById("address").value = new_address;
                    }
                    if (v1 == 2) {
                        document.getElementById("billing_address").value = new_address;
                    }
                    if (v1 == 3) {
                        document.getElementById("shipping_address").value = new_address;
                    }

                    if (v1 == 4) {
                        $('#primary_address').val(new_address);
                    }
                } else if (new_address == '' && addressType == 'locality') {
                    new_address += place.address_components[i]['long_name'];

                    if (v1 == 1) {
                        document.getElementById("address").value = new_address;
                    }
                    if (v1 == 2) {
                        document.getElementById("billing_address").value = new_address;
                    }
                    if (v1 == 3) {
                        document.getElementById("shipping_address").value = new_address;
                    }

                    if (v1 == 4) {
                        $('#primary_address').val(new_address);
                    }

                }

                if (componentForm[addressType]) {
                    var val = place.address_components[i][componentForm[addressType]];
                    if (v1 == 1) {
                        if (addressType == 'locality') {
                            $('#locality').val(val);
                        }
                        if (addressType == 'administrative_area_level_1') {
                            $('#administrative_area_level_1').val(val);
                        }
                        /*if (addressType == 'country') {
                            $('#country').val(val);
                        }*/
                        if (addressType == 'postal_code') {
                            $('#postal_code').val(val);
                        }
                    }

                    if (v1 == 2) {
                        if (addressType == 'locality') {
                            $('#billing_city').val(val);
                            addressUpdate(val, 'billing_city', val);
                        }
                        if (addressType == 'administrative_area_level_1') {
                            $('#billing_state_name').val(val);
                        }
                        /*if (addressType == 'country') {
                            $('#billing_country_name').val(val);
                        }*/
                        if (addressType == 'postal_code') {
                            $('#billing_zip').val(val);
                        }
                    }

                    if (v1 == 3) {
                        if (addressType == 'locality') {
                            $('#shipping_city').val(val);
                            var address = $('#shipping_address').val();
                            shippingCity(val, address);
                        }
                        if (addressType == 'administrative_area_level_1') {
                            $('#shipping_state_name').val(val);
                        }
                        /*if (addressType == 'country') {
                            $('#shipping_country_name').val(val);
                        }*/
                        if (addressType == 'postal_code') {
                            $('#shipping_zip').val(val);
                        }
                    }

                    if (v1 == 4) {
                        if (addressType == 'locality') {
                            $('#primary_city').val(val);
                        }
                        if (addressType == 'administrative_area_level_1') {
                            $('#primary_state_name').val(val);
                        }
                        /*if (addressType == 'country') {
                            $('#primary_country').val(val);
                        }*/
                        if (addressType == 'postal_code') {
                            $('#primary_postal_code').val(val);
                        }
                    }

                }

            }


        }
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            function cartItemShipAddrCharges(address, city, id) {
                $('.couponApply').val('');
                $('.disc1').html('');
                $('.disc').html('');
                var totalcast = parseFloat($('.totalCast').val());
                $('.amountTotal').val(totalcast);
                var to = totalcast;
                $('.totalCast1').html('$' + to);
                $('.discountCharge').val('');
                let deliveryChargeSection = $('#cart-item-delivery-charges');
                let isSameAsBilling = !!$(`#is_same_as_billing${id}`).val();
                console.log('cartItemShipAddrCharges isSameAsBilling -> ', isSameAsBilling)

                $.ajax({
                    url     : "{{ url('other-checkout-ship-info') }}",
                    type    : 'POST',
                    dataType: 'json',
                    data    : {
                        '_token': '{{ csrf_token() }}',
                        city    : city,
                        address : address
                    },
                    success : function (response) {
                        console.log('cartItemShipAddrCharges response -> ', response)
                        var totalcast = parseFloat($('.totalCast').val());
                        var taxRate = $('#tax_rate').val() || response.taxRate;

                        var deliveryCharge = response.delivery_charge;
                        console.log(totalcast)
                        console.log(taxRate)
                        console.log(deliveryCharge)

                        $(`#delivery_charge${id}`).val(deliveryCharge);

                        if ($('input[name="choise_details"]:checked').val() == 'store') {
                            var to = totalcast + parseFloat(taxRate);
                        } else {
                            var to = totalcast + parseFloat(deliveryCharge) + parseFloat(taxRate);
                        }
                        let cartItemName = $(`#cart-item-name${id}`).text();
                        let chargeHtml = `<li class="list-group-item d-flex justify-content-between lh-condensed" id="delivery-charge-item${id}">
                            <h6 class="my-0">
                                Delivery Charge For <strong>${cartItemName}</strong>
                                <br>
                                <small>
                                    delivering from ${response.storeCity},${response.storeName}
                                </small>
                                <br>
                                <small>Estimdated Delivery, ${response.estimated_delivery_time}</small>
                            </h6>

                            <span class="text-muted">${deliveryCharge}</span>
                    </li>`;
                        console.log('cartItemShipAddrCharges to -> ', chargeHtml)
                        $('.totalCast1').text('$' + to);
                        $('.amountTotal').val(to);
                        $('.totalCast').val(totalcast + parseFloat(deliveryCharge));
                        $(`#delivery-charge-item${id}`).remove();
                        deliveryChargeSection.append(chargeHtml);
                        deliveryChargeSection.show();
                        cartItemAddrIsSame();
                        if (!$('#tax_rate').val()) {
                            $('.taxR').html(`<h6 class="my-0">Tax
                                    </h6>`);
                            $('.taxRa').html('$' + response.taxRate);
                            $('#tax_rate').val(response.taxRate);
                        }

                    }
                })

            }

            function cartItemAddrIsSame() {
                const itemAddresses = $('.item-address-checkbox');
                // check all is checked or not if all is not checked then delivery charge hide else show
                let allChecked = true;
                itemAddresses.each(function () {
                    allChecked = $(this).is(':checked');
                    let id = $(this).data('id');
                });
                console.log('cartItemAddrIsSame allChecked -> ', allChecked)
                if (allChecked) {
                    $('.DeliveryChargeDiv').show();
                } else {
                    $('.DeliveryChargeDiv').hide();
                }
                return allChecked;
            }

            $('.item-address-checkbox').on('change', function () {
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');
                let addressInput = document.getElementById('billing_address' + id);
                $(`#is_same_as_billing${id}`).val(isChecked ? 1 : 0);

                if (!isChecked) {
                    let itemAutocomplete = new google.maps.places.Autocomplete(
                        /** @type {!HTMLInputElement} */
                        (addressInput), {
                            componentRestrictions: {
                                country: ["us"]
                            },
                            fields               : ["address_components", "geometry"],
                            types                : ['geocode']
                        }
                    );

                    itemAutocomplete.addListener('place_changed', async function () {
                        await fillInItemAddress.call(itemAutocomplete, itemAutocomplete, id);
                        let city = $(`#billing_city${id}`).val();
                        let address = $(`#billing_address${id}`).val();
                        cartItemShipAddrCharges(address, city, id);
                    });
                } else {
                    $(`#delivery_charge${id}`).val(0);
                    $(`#delivery-charge-item${id}`).remove();
                }
                cartItemAddrIsSame();
            });

            function fillInItemAddress(autocomplete, id) {
                // Get the place details from the autocomplete object.
                let place = autocomplete.getPlace();

                var new_address = '';
                for (var i = 0; i < place.address_components.length; i++) {
                    var addressType = place.address_components[i].types[0];

                    if (addressType == 'street_number') {
                        new_address += place.address_components[i]['short_name'];
                        document.getElementById("billing_address" + id).value = new_address;
                    }

                    if (addressType == 'route') {
                        if (new_address)
                            new_address += " " + place.address_components[i]['long_name'];
                        else
                            new_address += place.address_components[i]['long_name'];

                        document.getElementById("billing_address" + id).value = new_address;
                    } else if (new_address == '' && addressType == 'locality') {
                        new_address += place.address_components[i]['long_name'];

                        document.getElementById("billing_address" + id).value = new_address;
                    }

                    if (componentForm[addressType]) {
                        var val = place.address_components[i][componentForm[addressType]];
                        if (addressType == 'locality') {
                            $(`#billing_city${id}`).val(val);
                        }
                        if (addressType == 'administrative_area_level_1') {
                            $(`#billing_state_name${id}`).val(val);
                        }
                        /*if (addressType == 'country') {
                            $(`#shipping_country_name${id}`).val(val);
                        }*/
                        if (addressType == 'postal_code') {
                            $(`#shipping_zip${id}`).val(val);
                        }
                    }

                }

            }
        });
    </script>
@endsection
