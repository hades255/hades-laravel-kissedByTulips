@extends('layouts.backend_new')

@section('content')
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Sale Detail</h4>
                </div>
                <div class="col-md-7 align-self-center text-end">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="/accountadmin">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('accountadmin.sales.index') }}">Sales</a></li>
                            <li class="breadcrumb-item active"><a href="/accountadmin/sales">Detail</a></li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover table-bordered">
                                <tr>
                                    <th>Sale No.</th>
                                    <td>{{ $sale->pk_sales }}</td>
                                </tr>

                                <tr>
                                    <th>Order No.</th>
                                    <td>{{ $sale->pk_order }}</td>
                                </tr>

                                <tr>
                                    <th>User</th>
                                    <td>
                                        @if($sale->user)
                                            {{ $sale->user->first_name . ' ' . $sale->user->last_name }}
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th>Customer Name</th>
                                    <td>
                                        {{ $sale->customer_name }}
                                    </td>
                                </tr>

                                <tr>
                                    <th>Arrangement Type</th>
                                    <td>
                                        @if($sale->arrangementType)
                                            {{ $sale->arrangementType->arrangement_type }}
                                        @endif
                                    </td>
                                </tr>

                                    <tr>
                                    <th>Billing Address</th>
                                    @if($sale->order)
                                     <td style="width: 365px;">
                                    {{ $sale->order->address }} {{ isset($sale->order->address_1) ?  '#'.$sale->order->address_1 : ''}} </br> {{ $sale->order->city }} {{ $sale->order->state_name }} {{ $sale->order->zip }}</td>
                                    @endif
                                </tr>
                               
                                @if( isset($sale->order) && ($sale->order->billaddress ==  $sale->order->address))
                                <tr>
                                <th>Shipping Address same as Billing</th>
                                 <td> <input type="checkbox" checked value="Same as Billing Address"></td>
                                 <tr>
                                @else
                                  <tr>
                                    <th>Shipping Address</th>
                                    @if($sale->order)
                                     <td style="width: 365px;">
                                        {{ $sale->order->billaddress }} {{ isset($sale->order->billaddress_1) ?  '#'.$sale->order->billaddress_1 : ''}} </br> {{ $sale->order->billcity }} {{ $sale->order->billstate_name }} {{ $sale->order->billzip }}
                                      </td>
                                    @endif
                                </tr>
                                @endif
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
                               @forelse($sale->saleItems as $item)
                                <td class="text-right">
                                    ${{ number_format($item->quantity * $item->price, 2) }}
                                </td>
                                @empty
                                <td colspan="100%" class="text-right">
                                    N/A
                                </td>
                                @endforelse
                                </tr>
                              <tr>
                               <th>Discount Charge</th>
                                <td class="text-right">${{ $sale->discountCharge }}</td>
                              </tr>
                               <tr>
                               <th>Shipping Charge</th>
                                <td class="text-right">N/A</td>
                              </tr>
                                <tr>
                               <th>Tax</th>
                                <td class="text-right">${{ $sale->tax_total }}</td>
                              </tr>
                              <tr>
                               <th>Total</th>
                                <td class="text-right">${{ $sale->total }}</td>
                              </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover table-bordered">
                                <tr>
                                    <th>Name on Card</th>
                                    @if($sale->transaction)
                                    <td class="text-center">{{ $sale->transaction->name_on_card }}</td>
                                    @endif
                                </tr>
 
                                <tr>
                                    <th>Card Type</th>
                                    @if($sale->transaction)
                                    <td class="text-center">{{ $sale->transaction->account_type }}</td>
                                    @endif
                                </tr>

                                <tr>
                                    <th>Currency</th>
                                    @if($sale->transaction)
                                    <td class="text-center">{{ $sale->transaction->currency }}</td>
                                    @endif
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
             </div>
             </br>
             <div class="row"><div class="col-md-12"> <p class="text-center">
                                <a href="{{ route('accountadmin.sales.index') }}" class="btn btn-primary">
                                    Back
                                </a>
                            </p></div></div>
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
                                        <th>Sale Items</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($sale->saleItems as $item)
                                        <tr>
                                            <td>{{ $item->pk_sale_items }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td class="text-right">{{ $item->quantity }}</td>
                                            <td class="text-right">{{ $item->price }}</td>
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
                                        <td class="font-weight-bold text-right">${{ number_format($sale->total, 2) }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End PAge Content -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
@endsection
