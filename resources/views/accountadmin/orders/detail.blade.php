@extends('layouts.backend_new')

@section('content')
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            @if (Session::has('message'))
                <p class="alert alert-{{ Session::get('messageType') }}">{{ Session::get('message') }}</p>
            @endif
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Order Detail </h4>

                </div>
                <div class="col-md-7 align-self-center text-end">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="/accountadmin">Home</a></li>
                            <li class="breadcrumb-item"><a href="/accountadmin/orders">Orders</a></li>
                            <li class="breadcrumb-item active"><a href="/accountadmin/orders">Detail</a></li>
                        </ol>
                        <!-- <a href="/accountadmin/locations/add"> <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i
                                    class="fa fa-plus-circle"></i> Create New</button></a> -->
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <form method="post" action="/accountadmin/orders/status/update">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-hover table-bordered">
                                    <tr>
                                        <th>Order No.</th>
                                        <td>{{ $orders->pk_orders }}</td>
                                    </tr>
                                    <tr>
                                        <th>Customer Name</th>
                                        <td>
                                            {{ @$orders->customer->customer_name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Billing Address</th>
                                        @if($customerAddress)
                                            <td style="width: 365px;">
                                                {{ @$customerAddress->address }} {{ isset($customerAddress->address_1) ?  '#'. @$customerAddress->address_1 : ''}} </br> {{ @$customerAddress->city }} {{ @$customerAddress->state->state_name }} {{ @$customerAddress->zip }}
                                            </td>
                                        @else
                                            <td style="width: 365px;">
                                                N/A
                                            </td>
                                        @endif
                                    </tr>
                                    {{--@if($orders->address == $orders->billaddress)
                                    <tr>
                                        <th style="width:230px;">Shipping Address Same</th>
                                        <td>
                                            <input type="checkbox" value="Shipping Address same as Billing Address" checked>
                                        </td>
                                    </tr>
                                    @else--}}
                                    <!--                                    <tr>
                                        <th>Shipping Address</th>
                                        <td style="width: 365px;">
                                            {{ $orders->billaddress }} {{ isset($orders->billaddress_1) ?  '#'.$orders->billaddress_1 : ''}} </br> {{ $orders->billcity }} {{ $orders->billstate_name }} {{ $orders->billzip }}
                                    </td>
                                </tr>-->
                                    {{-- @endif--}}

                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-hover table-bordered">
                                    <tr>
                                        <th>Order Amount</th>

                                        <td class="text-right">
                                            @php
                                                $orderAmount = 0;
                                                if ($items->count()) {
                                                    foreach ($items as $item) {
                                                        $orderAmount += $item->quantity * $item->price;
                                                    }
                                                }
                                            @endphp
                                            ${{ number_format($orderAmount, 2) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Discount Charge</th>
                                        <td class="text-right">
                                            ${{ number_format($orders->discount_charge, 2) }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Delivery Charge</th>
                                        <td class="text-right">
                                            ${{ number_format($orders->delivery_charge, 2) }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Tax</th>
                                        <td class="text-right">
                                            ${{ number_format($orders->tax_charge, 2) }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Total</th>
                                        <td class="text-right">
                                            ${{ number_format($orders->total, 2) }}
                                        </td>
                                    </tr>

                                </table>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-hover table-bordered">
                                    @foreach ($orders->transactions as $transaction)
                                        <tr>
                                            <th>Name on Card</th>
                                            <td>
                                                {{ $transaction->name_on_card }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Card Type</th>
                                            <td>
                                                {{ $transaction->account_type }}
                                            </td>
                                        </tr>
                                        <!--                                        <tr>
                                            <th>Currency Type</th>
                                            <td>
                                                {{ $transaction->currency }}
                                        </td>
                                    </tr>-->
                                    @endforeach
                                    <tr>
                                        <th>Order Status</th>
                                        <td><select name="pk_order_status" id="pk_order_status">
                                                @foreach($orderStatus as $status)
                                                    <option
                                                        value="{{$status->pk_order_status}}" {{($orders->pk_order_status == $status->pk_order_status) ? 'selected':''}}>{{$status->order_status}}</option>
                                                @endforeach
                                            </select></td>

                                        <input type="hidden" name="pk_prders" value="{{$orders->pk_orders}}">
                                    </tr>
                                    <tr id="reason">
                                        <th>Reason</th>
                                        <td><textarea name="cancel_reason">{{$orders->cancel_reason}}</textarea></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title text-center">
                                    Shipping Address
                                </h4>
                            </div>
                            <div class="card-body">
                                @forelse($items as $item)
                                    <h4 class="h4 text-center">Address - {{ $loop->index + 1 }}</h4>
                                    <table class="table table-hover table-bordered">

                                        <tr>
                                            <th>Full Name</th>
                                            <td>{{ @$item->shippingAddress->shipping_full_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ @$item->shippingAddress->shipping_email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Phone</th>
                                            <td>{{ @$item->shippingAddress->shipping_phone }}</td>
                                        </tr>
                                        <tr>
                                            <th>Address</th>
                                            <td style="width: 365px;">
                                                {{ $item->shippingAddress->shipping_address }}
                                                {{ isset($item->shippingAddress->shipping_address_1) ?
                                                    '#'.$item->shippingAddress->shipping_address_1 : ''}}
                                                </br>
                                                {{ $item->shippingAddress->shipping_city }}
                                                {{ $item->shippingAddress->state->state_name }}
                                                {{ $item->shippingAddress->shipping_zip }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Delivery Charge</th>
                                            <td>
                                                ${{ $item->shippingAddress->same_as_billing ? '0.00' : number_format($item->shippingAddress->delivery_charge, 2) }}
                                            </td>
                                        </tr>
                                    </table>
                                @empty
                                    <table class="table table-hover table-bordered">
                                        <tr>
                                            <td>
                                                No shipping address found!
                                            </td>
                                        </tr>
                                    </table>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-12">
                        <p class="text-center">
                            <a href="{{ route('accountadmin.orders.index') }}">
                                <button type="button" class="btn btn-primary">Back</button>
                            </a>
                            <button type="submit" class="btn btn-primary" style="height: 46px;">
                                Update
                            </button>
                        </p>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-5">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title text-center">
                                    Order Items
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Items</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($items as $item)
                                            <tr>
                                                <td>{{ $item->pk_order_items }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->description }}</td>
                                                <td class="text-right">{{ $item->quantity }}</td>
                                                <td class="text-right">${{ number_format($item->price, 2) }}</td>
                                                <td class="text-right">
                                                    ${{ number_format($item->quantity * $item->price, 2) }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="100%" class="text-center">
                                                    No items found!
                                                </td>
                                            </tr>
                                        @endforelse

                                        <tr>
                                            <td colspan="4"></td>
                                            <td class="font-weight-bold">Grand Total</td>
                                            <td class="font-weight-bold text-right">
                                                ${{ number_format($orders->total, 2) }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- ============================================================== -->
            <!-- End PAge Content -->
            <!-- ============================================================== -->
        </div>
        <script>
            $(document).ready(function () {
                $("#pk_order_status").change(function () {
                    var status = $(this).val();
                    if ((status == 4) || (status == 5)) {
                        $("#reason").show();
                    } else {
                        $("#reason").hide();
                    }
                });
            });
        </script>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
@endsection
