@extends('layouts.backend_new')

@section('content')
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->


        <div class="container-fluid">

            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Order Details</h4>
                </div>
                <div class="col-md-7 align-self-center text-end">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="/customer">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{!! route('dashboard.myorders') !!}">My
                                    Orders</a></li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="container">
                <!-- Title -->
                <div class="d-flex justify-content-between align-items-center py-3">
                    <h2 class="h5 mb-0"><a href="#" class="text-muted"></a> Order #{!! $orders->pk_orders !!}</h2>
                </div>

                <!-- Main content -->
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Details -->
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="mb-3 d-flex justify-content-between">
                                    <div>
                                        <span class="me-3">{!! Helper::formatDate($orders->created_at) !!}</span>
                                        <span class="me-3">#{!! $orders->pk_orders !!}</span>
                                        <span
                                            class="badge rounded-pill bg-info">{!! ucfirst($orders->orderStatus->order_status) !!}</span>
                                    </div>
                                </div>
                                <table class="table table-borderless">
                                    <tbody>

                                    @if(!empty($order_items))
                                        @php
                                            $order_total = 0;
                                        @endphp
                                        @foreach($order_items as $item_val)
                                            @php
                                                $order_total += $item_val->price * $item_val->quantity;
                                            @endphp
                                            <tr>
                                                <td>
                                                    <div class="d-flex mb-2">
                                                        <div class="flex-shrink-0"><?php

                                                                                   if (empty($item_val->photo)) { ?>
                                                            <img alt="Item Photo"
                                                                 src="{!! asset('assets/images/flower/cart-empty.png') !!}"
                                                                 width="35" height="35" class="img-fluid"/><?php
                                                                                                           } else { ?>
                                                            <img alt="Item Photo"
                                                                 src="/flower-subscription/{{ $item_val->photo }}"
                                                                 width="35" height="35" class="img-fluid"/><?php
                                                                                                           } ?>
                                                        </div>
                                                        <div class="flex-lg-grow-1 ms-3">
                                                            <h6 class="small mb-0"><a href="javascript:void(0)"
                                                                                      class="text-reset">{!! $item_val->name !!}</a>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{!! $item_val->quantity !!}</td>
                                                <td class="text-end">${!! number_format($item_val->price, 2) !!}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                    <tfoot>

                                    <tr>
                                        <td colspan="2">Subtotal ( Including Extra Charges )</td>
                                        <td class="text-end">
                                            ${{ number_format($order_total, 2) }}</td>
                                    </tr>

                                    @if(isset($orders->discount_charge) && $orders->discount_charge>0)
                                        <tr>
                                            <td colspan="2">Discount</td>
                                            @if(isset($orders->coupon_discount_type) && ($orders->coupon_discount_type=='fixed'))
                                                <td class="text-end">
                                                    -${!! number_format($orders->discount_charge,2) !!}</td>
                                            @endif
                                            @if(isset($orders->coupon_discount_type) && ($orders->coupon_discount_type=='percent'))
                                                <td class="text-end">-{!! number_format($orders->discount_charge,2) !!}
                                                    %
                                                </td>
                                            @endif
                                        </tr>
                                    @endif

                                    <tr class="fw-bold">
                                        <td colspan="2">TOTAL</td>
                                        @if(isset($orders->discount_charge) && !empty($orders->discount_charge))
                                            <td class="text-end">
                                                ${!! number_format($orders->total,2)-number_format($orders->discount_charge,2) !!}</td>
                                        @endif
                                        @if(empty($orders->discount_charge))
                                            <td class="text-end">${!! number_format($orders->total,2) !!}</td>
                                        @endif
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- Payment -->
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h3 class="h6">Payment Method</h3>
                                        <p>Visa -1234 <br>
                                            Total: ${!! number_format($orders->total,2) !!} <span
                                                class="badge bg-success rounded-pill">PAID</span></p>
                                    </div>
                                    <div class="col-lg-6">
                                        <h3 class="h6">Billing address</h3>
                                        @php
                                            $customer = $orders->customer;
                                            $customerAddr = $customer->address[0];
                                        @endphp
                                        <address>
                                            <strong>{{ $customer->customer_name }}</strong><br>
                                            {{ $customerAddr->address }} {{ $customerAddr->address_1 . ', '. $customerAddr->city }}
                                            <br>
                                            {{ $customerAddr->state->state_name .', '. $customerAddr->country->country_name .' '. $customerAddr->zip }}
                                            <br>
                                            <abbr title="Phone">P:</abbr> {!! $customer->office_phone !!}
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <!-- Customer Notes -->
                        @if($orders->deliveryOption->delivery_or_pickup != 'Store Pickup')
                            <div class="card mb-4">
                                <!-- Shipping information -->
                                <div class="card-body">
                                    <h3 class="h6">Shipping Information</h3>
                                    <strong>Order Id</strong>
                                    <span><a href="javascript:void(0)"
                                             class="text-decoration-underline">#{!! $orders->pk_orders !!}</a> <i
                                            class="bi bi-box-arrow-up-right"></i> </span>
                                    <hr>
                                    <h3 class="h6">Address</h3>
                                    @foreach($order_items as $order_item)
                                        @php
                                            $itemAddr = $order_item->shippingAddress;
                                        @endphp
                                        <h5>For {{ $order_item->name }}</h5>
                                        <address>
                                            <strong>{{ $itemAddr->shipping_full_name }}</strong><br>
                                            {{ $itemAddr->shipping_address }} {{ $itemAddr->shipping_address_1 . ', '. $itemAddr->shipping_city }}
                                            <br>
                                            {{ $itemAddr->state->state_name .', '. $itemAddr->country->country_name .' '. $itemAddr->zip }}
                                            <br>
                                            <abbr title="Phone">P:</abbr> {!! $itemAddr->shipping_phone !!}
                                        </address>
                                        <p class="text-wrap font-weight-bold">
                                            Delivery Charge:
                                            ${{ $itemAddr->same_as_billing ? '0.00' : number_format($itemAddr->delivery_charge, 2) }}
                                        </p>
                                        <hr>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @if($orders->deliveryOption->delivery_or_pickup == 'Store Pickup')
                            <div class="card mb-4">
                                <!-- Pickup Information -->
                                <div class="card-body">
                                    <h3 class="h6">Pickup Information</h3>
                                    <h3 class="h6">Address</h3>
                                    <address>
                                        <strong>{{ $account->location_name }}</strong><br>
                                        {{$account->address}} , {{$account->city}}
                                        , {{($account->state) ? $account->state->state_name.',' : ''}} <br/>
                                        {{($account->state) ? $account->country->country_name.',' : '' }}{{$account->zip}}
                                        <br/>
                                        <abbr title="Phone">P:</abbr> {!! $account->business_phone !!}
                                    </address>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->

@endsection
