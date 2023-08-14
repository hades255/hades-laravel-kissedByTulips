@extends('layouts.backend_new')

@section('content')
    <style>
        .store1 .row {
            cursor: pointer;
        }

        .selectTimeItem {
            display: none;
        }

        .store {
            display: none;
        }

        .store1 {
            border: 1px solid #dfdfdf;
            padding: 14px;
        }

        .loader {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 60px;
            height: 60px;
            -webkit-animation: spin 2s linear infinite; /* Safari */
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
            -webkit-animation: spin 2s linear infinite; /* Safari */
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
        <div class="row mt-3">
            <div class="col-md-12">
                @if(session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="py-3 text-center">
            <h2>Checkout</h2>
        </div>
        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your Cart</span>
                    <span class="badge badge-secondary badge-pill">
                        {{ session('pos_total_quantity') ? session('pos_total_quantity') : 0 }}
                    </span>
                </h4>
                <?php $total = 0; $total_qty = 0; ?>
                <ul class="list-group mb-3 sticky-top">
                    @if(session('pos_cart'))
                        @foreach((array) session('pos_cart') as $id => $details)
                                <?php
                                $total                += $details['price'] * $details['quantity'];
                                $total_qty            += $details['quantity'];
                                $arrangementTypesName = $details['arrangementTypesName'];
                                $pk_arrangement_type  = $details['pk_arrangement_type'];
                                ?>

                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">{{ $details['name'] }}</h6>
                                    <small class="text-muted">{{ $details['description'] }}</small>
                                </div>
                                <span
                                    class="text-muted">${{ number_format($details['price'] * $details['quantity'], 2) }}</span>
                            </li>

                        @endforeach
                    @endif

                    @if($location && $location->tax_rate)
                        <li class="list-group-item d-flex justify-content-between lh-condensed dlCast">
                            <div class="taxR">
                                Tax
                            </div>
                            <span class="text-muted taxRa loade">
                                ${{ number_format($location->tax_rate, 2) }}
                            </span>
                        </li>
                    @endif

                    @php
                        if ($location && $location->tax_rate) {
                            $total = $total + $location->tax_rate;
                        }
                    @endphp
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (USD)</span>
                        <strong class="totalCast1 loade">${{ number_format($total, 2) }}</strong>
                        <input type="hidden" value="{{ $total }}" class="totalCast">
                    </li>
                </ul>
            </div>


            <div class="col-md-8 order-md-1">

                <form method="POST" id="vendor-customer-form1" class="mb-5"
                      action="{{ route('accountadmin.sales.store') }}">
                    @csrf

                    <!-- User Details -->
                    <h4 class="mb-3">
                        Customer Details
                    </h4>

                    <input type="hidden" name="pk_arrangement_type" value="{{ $pk_arrangement_type }}">
                    <input type="hidden" name="arrangementTypesName" value="{{ $arrangementTypesName }}">
                    <input type="hidden" name="pk_locations" value="{{ $location->pk_locations }}">

                    <div class="form-group">
                        <label for="customers" class="text-center">
                            Select Customer
                        </label>
                        <select name="pk_customer" id="customers" class="form-control">
                            <option value="">Select Customer</option>
                        </select>
                    </div>

                    <!-- User Details End -->


                    <hr class="mb-4">

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
                                $months = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');
                            @endphp
                            <label for="expiry_month">Expiration Date</label>
                            <select class="custom-select d-block w-100" id="expiry_month" name="expiry_month">
                                <option value="">Month</option>
                                @foreach($months as $mkey=>$mval)
                                    <option value="{!! $mkey !!}"
                                            @if(old('expiry_month') == $mkey) selected @endif>{!! $mval !!}</option>
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
                                @for($i = date('Y'); $i <= (date('Y') + 15); $i++)
                                    <option value="{!! $i !!}"
                                            @if(old('expiry_year') == $i) selected @endif>{!! $i !!}</option>
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

                    <hr class="mb-4">
                    <a href="{{ route('accountadmin.sales.create') }}" class="btn btn-primary">Back to sale</a>
                    <button class="btn btn-primary" type="submit">Create sale</button>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('js')
    <link href="//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#customers').select2({
                placeholder: "Select Customer",
                ajax       : {
                    url: '{!! route('accountadmin.sales.select2-customers') !!}',
                },
                allowClear   : true,
                closeOnSelect: true,
            });
        });
    </script>
@endsection
