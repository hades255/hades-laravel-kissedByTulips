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
                            <li class="breadcrumb-item active">
                                <a href="{{ route('accountadmin.sales.index') }}">
                                    Create New Sale
                                </a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    @if(session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('accountadmin.sales.store-from-order') }}" method="POST">
                        @csrf

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title text-center">
                                    Create New Sale
                                </h4>
                                <label for="is-order-sale" class="float-right">
                                    <input type="checkbox" name="is_order_sale" id="is-order-sale" value="1">
                                    Is Order Sale
                                </label>
                            </div>

                            <div class="card-body">
                                <div class="row hide" id="order-select-section">
                                    <div class="col-md-4 mx-auto">
                                        <label for="orders" class="text-center">Order</label>
                                        <select name="pk_order" id="orders" class="form-control">
                                            <option value="">Select Order</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row" id="general-sale-section">
                                    <div class="col-md-12">
                                        <span id="status"></span>
                                        @if(Session::has('pos_cart') && count(session('pos_cart')))
                                            <table id="cart" class="table table-hover table-condensed"
                                                   style="margin-top: 30px;">
                                                <thead>
                                                <tr>
                                                    <th style="width:50%">Product</th>
                                                    <th style="width:10%">Price</th>
                                                    <th style="width:8%">Quantity</th>
                                                    <th style="width:22%" class="text-center">Subtotal</th>
                                                    <th style="width:10%"></th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                    <?php $total = 0; $total_qty = 0; ?>

                                                @if(session('pos_cart'))
                                                    @foreach((array) session('pos_cart') as $id => $details)

                                                            <?php
                                                            $total     += $details['price'] * $details['quantity'];
                                                            $total_qty += $details['quantity'];
                                                            ?>

                                                        <tr>
                                                            <td data-th="Product">
                                                                <div class="row">
                                                                    <div class="col-sm-3 hidden-xs"><img
                                                                            src="products/{{ $details['photo'] }}"
                                                                            width="100" height="100"
                                                                            class="img-responsive"/></div>
                                                                    <div class="col-sm-9">
                                                                        <h4 class="nomargin">{{ $details['name'] }}</h4>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td data-th="Price">${{ $details['price'] }}</td>
                                                            <td data-th="Quantity">
                                                                <input type="number" min="1"
                                                                       value="{{ $details['quantity'] }}"
                                                                       class="form-control quantity"/>
                                                            </td>
                                                            <td data-th="Subtotal" class="text-center">$<span
                                                                    class="product-subtotal">{{ $details['price'] * $details['quantity'] }}</span>
                                                            </td>
                                                            <td class="actions" data-th="">
                                                                <button type="button"
                                                                        class="btn btn-info btn-sm update-cart"
                                                                        data-id="{{ $id }}"
                                                                        data-prev-qty="{{ $details['quantity'] }}"><i
                                                                        class="fa fa-refresh"></i></button>
                                                                <button type="button"
                                                                        class="btn btn-danger btn-sm remove-from-cart"
                                                                        data-id="{{ $id }}"><i
                                                                        class="fa fa-trash-o"></i>
                                                                </button>

                                                                <i class="fa fa-circle-o-notch fa-spin btn-loading"
                                                                   style="font-size:24px; display: none"></i>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif

                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <td colspan="1"></td>
                                                    <td class="text-center" colspan="2">
                                                        <strong>
                                                            Total Quantity
                                                            <span class="total-qty">
                                                            {{ $total_qty }}
                                                        </span>
                                                        </strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" class="hidden-xs">
                                                    </td>
                                                    <td class="hidden-xs text-center"><strong>Total $<span
                                                                class="cart-total">{{ $total }}</span></strong></td>
                                                </tr>
                                                </tfoot>
                                            </table>

                                            <div class="text-center">
                                                <a href="{{ route('accountadmin.sales.floral-arrangement') }}"
                                                   class="btn btn-primary">
                                                    Add more items
                                                </a>
                                            </div>
                                        @else
                                            <div class="text-center">
                                                <p>
                                                    No products in cart!
                                                </p>
                                                <a href="{{ route('accountadmin.sales.floral-arrangement') }}"
                                                   class="btn btn-primary">
                                                    Click here to add some
                                                </a>
                                            </div>

                                        @endif


                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <p class="text-right">
                                    <a href="{{ route('accountadmin.sales.index') }}" class="btn btn-danger">
                                        Cancel
                                    </a>
                                    <a href="{{ route('accountadmin.sales.checkout') }}" class="btn btn-primary"
                                       id="checkoutBtn">
                                        Checkout
                                    </a>

                                    <button type="submit" class="btn btn-primary hide" id="createSaleBtn">
                                        Create Sale
                                    </button>
                                </p>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <link href="//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript">
        function initOrderSelect2() {
            $('#orders').select2({
                placeholder: "Select Order",
                ajax       : {
                    url: '{!! route('accountadmin.sales.select2-orders') !!}',
                },
            });
        }

        $(document).ready(function () {
            initOrderSelect2();

            $('#is-order-sale').on('change', function () {
                let isChecked            = $(this).is(':checked');
                const orderSelectSection = $('#order-select-section');
                const generalSaleSection = $('#general-sale-section');
                const createSaleBtn      = $('#createSaleBtn');
                const checkoutBtn        = $('#checkoutBtn');


                if (isChecked) {
                    orderSelectSection.removeClass('hide');
                    generalSaleSection.addClass('hide');
                    createSaleBtn.removeClass('hide');
                    checkoutBtn.addClass('hide');
                    initOrderSelect2();
                } else {
                    orderSelectSection.addClass('hide');
                    generalSaleSection.removeClass('hide');
                    createSaleBtn.addClass('hide');
                    checkoutBtn.removeClass('hide');
                }
            });

            $(".remove-from-cart").click(function (e) {
                e.preventDefault();
                var ele        = $(this);
                var parent_row = ele.parents("tr");
                var cart_total = $(".cart-total");
                if (confirm("Are you sure")) {
                    $.ajax({
                        url     : '{!! route('accountadmin.sales.floral-arrangement.remove-from-cart') !!}',
                        method  : "POST",
                        data    : {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                        dataType: "json",
                        success : function (response) {
                            parent_row.remove();
                            $("span#status").html('<div class="alert alert-success">' + response.msg + '</div>');
                            cart_total.text(response.total);
                            location.reload();
                        }
                    });
                }
            });

            $(".update-cart").click(function (e) {
                e.preventDefault();
                var ele              = $(this);
                var parent_row       = ele.parents("tr");
                var quantity         = parent_row.find(".quantity").val();
                var product_subtotal = parent_row.find("span.product-subtotal");
                var cart_total       = $(".cart-total");
                var qty_total        = $(".total-qty");
                var loading          = parent_row.find(".btn-loading");
                loading.show();

                $.ajax({
                    url     : '{!! route('accountadmin.sales.floral-arrangement.update-cart-item') !!}',
                    method  : "POST",
                    data    : {
                        _token       : '{{ csrf_token() }}',
                        id           : ele.attr("data-id"),
                        quantity     : quantity,
                        data_prev_qty: ele.attr("data-prev-qty")
                    },
                    dataType: "json",
                    success : function (response) {
                        loading.hide();
                        $("span#status").html('<div class="alert alert-success">' + response.msg + '</div>');
                        product_subtotal.text(response.subTotal);
                        cart_total.text(response.total);
                        qty_total.text(response.totalQty);
                    }
                });
            });

        });
    </script>
@endsection
