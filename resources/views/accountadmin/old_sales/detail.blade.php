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
                                    <th class="text-center">Sale No.</th>
                                    <td class="text-center">{{ $sale->pk_sales }}</td>
                                </tr>

                                <tr>
                                    <th class="text-center">Order No.</th>
                                    <td class="text-center">{{ $sale->pk_order }}</td>
                                </tr>

                                <tr>
                                    <th class="text-center">User</th>
                                    <td class="text-center">
                                        @if($sale->user)
                                            {{ $sale->user->first_name . ' ' . $sale->user->last_name }}
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th class="text-center">Customer Name</th>
                                    <td class="text-center">
                                        {{ $sale->customer_name }}
                                    </td>
                                </tr>

                                <tr>
                                    <th class="text-center">Arrangement Type</th>
                                    <td class="text-center">
                                        @if($sale->arrangementType)
                                            {{ $sale->arrangementType->arrangement_type }}
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th class="text-center">Total</th>
                                    <td class="text-center">
                                        ${{ number_format($sale->total, 2) }}
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
                                <tr>
                                    <th class="text-center">Shipping Address</th>
                                    @if($sale->order)
                                     <td class="text-center">{{ $sale->order->billaddress }}</td>
                                    @endif
                                </tr>

                                <tr>
                                    <th class="text-center">Shipping City</th>
                                    @if($sale->order)
                                     <td class="text-center">{{ $sale->order->billcity }}</td>
                                    @endif
                                </tr>

                                <tr>
                                    <th class="text-center">Shipping State</th>
                                    @if($sale->order)
                                     <td class="text-center">{{ $sale->order->billstate_name }}</td>
                                     @endif
                                </tr>

                                <tr>
                                    <th class="text-center">Shipping Country</th>
                                    @if($sale->order)
                                     <td class="text-center">{{ $sale->order->billcountry_name }}</td>
                                     @endif
                                </tr>

                                <tr>
                                    <th class="text-center">Shipping Zip</th>
                                    @if($sale->order)
                                     <td class="text-center">{{ $sale->order->billzip }}</td>
                                     @endif
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
                                    <th class="text-center">Name on Card</th>
                                    @if($sale->transaction)
                                    <td class="text-center">{{ $sale->transaction->name_on_card }}</td>
                                    @endif
                                </tr>

                                <tr>
                                    <th class="text-center">Card Type</th>
                                    @if($sale->transaction)
                                    <td class="text-center">{{ $sale->transaction->account_type }}</td>
                                    @endif
                                </tr>

                                <tr>
                                    <th class="text-center">Currency</th>
                                    @if($sale->transaction)
                                    <td class="text-center">{{ $sale->transaction->currency }}</td>
                                    @endif
                                </tr>

                                <tr>
                                    <th class="text-center">Shipping Date</th>
                                    @if($sale->transaction)
                                    <td class="text-center">{{ Helper::formatDate($sale->transaction->created_at)  }}</td>
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
                                        <th>SubTotal</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($sale->saleItems as $item)
                                        <tr>
                                            <td>{{ $item->pk_sale_items }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td>
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
                                        <td class="font-weight-bold">Total</td>
                                        <td class="font-weight-bold">${{ number_format($sale->total, 2) }}</td>
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
