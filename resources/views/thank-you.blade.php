@extends('layouts.frontend')

@section('title', 'Cart')

@section('content')

    <div class="container">

        <div class="row">

            <div class="jumbotron text-center" style="width:100%">
                @php
                    $thankYou = Helper::getAcknowledge('CUSTOMER_CREATE_ORDER_THANKYOU');
                    $createOrder = Helper::getAcknowledge('CUSTOMER_CREATE_ORDER');
                @endphp
                <h1 class="display-3 text-{{ @$thankYou['messageType'] }}">{{ @$thankYou['message'] }}</h1>
                <p class="lead"><strong>{{ @$createOrder['message'] }}</strong></p>

                <div class="col-md-6 offset-md-3 mb-4 text-left">
                    @if($order->deliveryOption->delivery_or_pickup == 'Store Pickup')
                        <div
                            style="background-color: #FFF;text-align: center;    margin: 0 0 20px 40px;padding-top: 10px;">
                            <!-- <h6><strong>Pickup Location</strong></h6> -->
                            <p class="lead">{{$store->address}} , {{$store->city}}, {{$store->zip}}</p>
                            <ul>
                                @if(isset($store->locationTime->pk_location_times))
                                    <li class="list-group-item d-flex justify-content-between lh-condensed"
                                        style="border:unset;">{{$store->locationTime->day}}
                                        : {{$store->locationTime->open_time}}
                                        To {{$store->locationTime->close_time}}</li>
                                @endif
                            </ul>
                        </div>
                    @else
                        @foreach($order_items as $order_item)
                            <div
                                style="background-color: #FFF; text-align: center; margin: 0 0 20px 40px; padding-top: 10px; padding-bottom: 1px;">
                                @php
                                    $itemAddr = $order_item->shippingAddress;
                                @endphp
                                <p class="text-wrap">
                                    For {{ $order_item->name }} :
                                    {{ $itemAddr->shipping_address }} , {{ $itemAddr->shipping_city }}
                                    , {{ $itemAddr->shipping_zip }}
                                </p>
                                <p class="text-center font-weight-bold">
                                    Delivery Charge:
                                    ${{ $itemAddr->same_as_billing ? '0.00' : number_format($itemAddr->delivery_charge, 2) }}
                                </p>
                            </div>
                        @endforeach
                    @endif
                    <?php $total = 0; $total_qty = 0; ?>
                    <ul class="list-group mb-3 sticky-top">
                        @if(!empty($order_items))
                            @foreach($order_items as $item_val)
                                    <?php
                                    $total     += $item_val->price * $item_val->quantity;
                                    $total_qty += $item_val->quantity;
                                    ?>

                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div>
                                        <h6 class="my-0">{{ $item_val->name }}</h6>
                                        <small class="text-muted">{{ $item_val->description }}</small>
                                    </div>
                                    <span
                                        class="text-muted">${{ number_format($item_val->price * $item_val->quantity, 2) }}</span>
                                </li>

                            @endforeach
                        @endif

                        @if($order->deliveryOption->delivery_or_pickup != 'Store Pickup')
                            @if(isset($order->delivery_charge))

                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div>
                                        <h6 class="my-0">Delivery Charge</h6>
                                        <small class="text-muted">
                                            delivering from - {{ $store->location_name }}
                                            , {{ $store->city }}
                                        </small><br>
                                        <small class="text-muted">
                                            Estimated Delivery - {{ $order->estimated_del }}
                                        </small>
                                    </div>
                                    <span class="text-muted">${{ number_format($order->delivery_charge, 2) }}</span>
                                </li>
                            @endif
                        @endif
                        @if(isset($order->tax_charge))
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">Tax</h6>

                                </div>
                                <span class="text-muted">${{ $order->tax_charge }}</span>
                            </li>
                        @endif
                        @if(isset($order->discount_charge))
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">Discount (-)</h6>

                                </div>
                                @if(isset($order->coupon_discount_type) && ($order->coupon_discount_type=='fixed'))
                                    <span class="text-muted">${{$order->discount_charge}}</span>
                                @endif
                                @if(isset($order->coupon_discount_type) && ($order->coupon_discount_type=='percent'))
                                    <span class="text-muted">{{$order->discount_charge}}%</span>
                                @endif
                            </li>
                        @endif

                        @if($order->deliveryOption->delivery_or_pickup == 'Store Pickup')
                            @php
                                $total = $order->total;
                            @endphp
                        @endif

                        @if($order->deliveryOption->delivery_or_pickup != 'Store Pickup')
                            @php
                                $total += ($order->tax_charge + $order->delivery_charge);
                            @endphp
                        @endif


                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (USD)</span>
                            @if(!empty($order->discount_charge) && ($order->coupon_discount_type == 'percent') && ($order->deliveryOption->delivery_or_pickup == 'Store Pickup'))
                                <strong>${{ number_format((float)$total-($total*$order->discount_charge/100), 2, '.', '') }}</strong>
                            @endif
                            @if(!empty($order->discount_charge) && ($order->coupon_discount_type == 'fixed') && ($order->deliveryOption->delivery_or_pickup == 'Store Pickup'))
                                <strong>${{number_format((float)$total-($order->discount_charge), 2, '.', '')}}</strong>
                            @endif
                            @if(!empty($order->discount_charge) && ($order->coupon_discount_type == 'percent') && ($order->deliveryOption->delivery_or_pickup != 'Store Pickup'))
                                <strong>${{ number_format((float)$total-($total*$order->discount_charge/100), 2, '.', '')}}</strong>
                            @endif
                            @if(!empty($order->discount_charge) && ($order->coupon_discount_type == 'fixed') && ($order->deliveryOption->delivery_or_pickup != 'Store Pickup'))
                                <strong>${{number_format((float)$total-($order->discount_charge), 2, '.', '')}}</strong>
                            @endif
                            @if(empty($order->discount_charge))
                                <strong>${{number_format($total, 2)}}</strong>
                            @endif
                        </li>
                    </ul>
                    <!--  -->
                </div>

                <hr>
                <p class="lead">
                    <a class="btn btn-success btn-sm" href="{!! route('dashboard.myorderdetails',$pk_orders) !!}"
                       role="button">Track Order</a>
                </p>
            </div>


        </div>
    </div>
@endsection
