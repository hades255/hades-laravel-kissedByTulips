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
                            <li class="breadcrumb-item active"><a
                                    href="/accountadmin/customers/edit/{!! $data->pk_customers !!}">Customers</a>
                            </li>
                            <li class="breadcrumb-item active"><a href="/accountadmin/coupons">Add</a></li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ !empty($customer_address->pk_customer_address) ? 'Edit Address':'Create Address'}}</h4>
                            <div class="tab-content br-n pn">
                                <div id="navpills-1" class="tab-pane active">
                                    <div class="row">
                                        @if(Session::has('message'))
                                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                                        @endif
                                        <form class="form-horizontal mt-4" method="post" enctype="multipart/form-data">
                                            @csrf

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="title">Address</label>
                                                        <input type="text" name="address"
                                                               class="form-control @error('address') is-invalid @enderror"
                                                               id="autocomplete"
                                                               value="{{isset($customer_address) && ($customer_address->address) ? $customer_address->address : old('address')}}">
                                                        @error('address')
                                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="code">Ste/Unit #</label>
                                                        <input type="text" name="address_1"
                                                               class="form-control @error('address_1') is-invalid @enderror"
                                                               id="street_number"
                                                               value="{{isset($customer_address) && ($customer_address->address_1) ? $customer_address->address_1 : old('address_1')}}"
                                                               maxlength="10">
                                                        @error('street_number')
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
                                                        <label for="type">City</label>
                                                        <input type="text" name="city" id="locality"
                                                               class="form-control @error('city') is-invalid @enderror"
                                                               value="{{isset($customer_address) && ($customer_address->city) ? $customer_address->city : old('city')}}">
                                                        @error('city')
                                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="discount_amount">State</label>
                                                        <input id="administrative_area_level_1" type="text"
                                                               name="state_name"
                                                               class="form-control @error('state_name') is-invalid @enderror"
                                                               value="{{isset($customer_address) && ($customer_address->state->state_name) ? $customer_address->state->state_name : old('state_name')}}">
                                                        @error('state_name')
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
                                                        <label for="start_at">Zip</label>
                                                        <input type="text" id="postal_code" name="zip"
                                                               class="form-control @error('zip') is-invalid @enderror"
                                                               value="{{isset($customer_address) && ($customer_address->zip) ? $customer_address->zip : old('zip')}}">
                                                        @error('zip')
                                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="expire_at">Country</label>
                                                        <input id="country" type="text" name="country_name"
                                                               class="form-control @error('country_name') is-invalid @enderror"
                                                               value="{{isset($customer_address) && ($customer_address->pk_country) ? $customer_address->country->country_code : old('country_name', 'USA')}}">
                                                        @error('country_name')
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
                                                        <label class="form-label" id="customerlabelLat">Lat: <span
                                                                id="latLab">{{isset($customer_address) && ($customer_address->lat) ? $customer_address->lat : ''}}</span></label>
                                                        {{-- @if(isset($customer_address) && ($customer_address->lat)) --}}
                                                        <input type="hidden" id="lat_value" name="lat"
                                                               value="{{isset($customer_address) && ($customer_address->lat) ? $customer_address->lat : ''}}">
                                                        {{-- @endif --}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" id="customerlabelLng">Lng: <span
                                                                id="lngLab">{{isset($customer_address) && ($customer_address->lng) ? $customer_address->lng : ''}}</span></label>
                                                        {{-- @if(isset($customer_address) && ($customer_address->lng)) --}}
                                                        <input type="hidden" id="lng_value" name="lng"
                                                               value="{{isset($customer_address) && ($customer_address->lng) ? $customer_address->lng : ''}}">
                                                        {{-- @endif --}}
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="hidden" name="pk_customer_address"
                                                   value="{{ !empty($customer_address->pk_customer_address) ?$customer_address->pk_customer_address : ''}}">
                                            <input class="btn btn-primary" type="submit"
                                                   value="{{ !empty($customer_address->pk_customer_address)? "Update" : "Submit" }}">
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

    @section('js')
        <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAB80hPTftX9xYXqy6_NcooDtW53kiIH3A&libraries=places&callback=initAutocomplete"
            async defer></script>
        <script src="/assets/address-auto-complete.js"></script>
    @endsection

@endsection
