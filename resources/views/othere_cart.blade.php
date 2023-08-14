@extends('layouts.frontend')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<style>
    .modal-backdrop.show {
        display: none !important;
    }
</style>
@section('title', 'Cart')

@section('content')
    <span id="status"></span>
    <table id="cart" class="table table-hover table-condensed" style="margin-top: 60px;margin-bottom:60px;">
        <thead>
        <tr>
            <th style="width:40%">Item</th>
            <th style="width:20%" class="text-center">Card Message</th>
            <th style="width:10%" class="text-center">Price</th>
            <th style="width:8%" class="text-center">Quantity</th>
            <th style="width:22%" class="text-center">Subtotal</th>
            <th style="width:10%"></th>
        </tr>
        </thead>
        <tbody>

        <?php $total = 0;
        $total_qty   = 0; ?>

        @if (session('oth_cart'))
            @foreach ((array) session('oth_cart') as $id => $details)
                    <?php
                    $total     += $details['price'] * $details['quantity'];
                    $total_qty += $details['quantity'];
                    ?>

                <tr data-id="{{ $id }}" class="cart-items">
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs"><?php
                                                            if (empty($details['photo'])) { ?>
                                <img alt="Item Photo" src="{!! asset('assets/images/flower/cart-empty.png') !!}"
                                     width="80" height="80"
                                     class="img-responsive"/><?php
                                                             } else { ?>
                                <img alt="Item Photo" src="flower-subscription/{{ $details['photo'] }}" width="80"
                                     height="80" class="img-responsive"/><?php
                                                                         } ?>
                            </div>
                            <div class="col-sm-9">
                                <h4 class="nomargin" class="item-name"
                                    data-name="{{ $details['name'] }}">{{ $details['name'] }}</h4>
                            </div>
                        </div>
                    </td>
                    <td class="text-center" data-th="Message">
                        <textarea name="card_message" class="card_message"
                                  data-id="{{ $id }}">{{ @$details['card_message'] }}</textarea>
                    </td>
                    <td class="text-center" data-th="Price">${{ $details['price'] }}</td>
                    <td class="text-center" data-th="Quantity">
                        <input type="number" min="1" value="{{ $details['quantity'] }}"
                               class="form-control quantity" data-id="{{ $id }}"/>
                    </td>
                    <td data-th="Subtotal" class="text-center">$<span
                            class="product-subtotal">{{ $details['price'] * $details['quantity'] }}</span></td>
                    <td class="actions" data-th="">

                        <button class="btn btn-info btn-sm update-cart" data-id="{{ $id }}"
                                data-prev-qty="{{ $details['quantity'] }}"><i class="fa fa-refresh"></i></button>
                        <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><i
                                class="fa fa-trash-o"></i></button>

                        <i class="fa fa-circle-o-notch fa-spin btn-loading" style="font-size:24px; display: none"></i>
                    </td>
                </tr>
            @endforeach
        @endif

        </tbody>
        <tfoot>
        <tr>
            <td colspan="1"></td>
            <td class="text-center" colspan="2"><strong>Total Quantity <span
                        class="cart-quantity">{{ $total_qty }}</span></strong></td>
        </tr>
        <tr>
            <td><a href="{{ url('/') }}" class="btn btn-warning">
                    <i class="fa fa-angle-left"></i> Continue Shopping</a>
                @if (Auth::id())
                    <a href="{{ url('/other-checkout') }}" class="btn btn-success" id="checkout-href checkout-button">
                        Checkout
                    </a>
                @else
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#checkout"
                            id="checkout-button">
                        Checkout
                    </button>
                @endif
            </td>
            <td colspan="2" class="hidden-xs"></td>
            <td class="hidden-xs text-center"><strong>Total $<span
                        class="cart-total">{{ $total }}</span></strong></td>
            <td class="hidden-xs"></td>
        </tr>
        </tfoot>
    </table>

    <!-- The Modal -->
    <div class="modal" id="checkout">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="margin-top: 130px;">

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-2 text-center">
                            <a href="{{ url('/login') }}" class="btn btn-success">Login</a>
                        </div>
                        <div class="col-md-2 text-center">
                            <a href="{{ url('/register') }}" class="btn btn-success">Register</a>
                        </div>
                        <div class="col-md-2 text-center">
                            <a href="{{ url('/other-checkout') }}" class="btn btn-success" id="checkout-pass">Guest</a>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <script type="text/javascript">
        function updateAllCartItems() {
            let cart_items = $('.cart-items');
            cart_items.each(function (index, item) {
                let cart_item = $(item);
                let cart_item_id = cart_item.data('id');
                let cart_item_card_message = cart_item.find('.card_message').val();
                let cart_item_quantity = cart_item.find('.quantity').val();
                let cart_item_product_subtotal = cart_item.find('.product-subtotal');
                let cart_item_btn_loading = cart_item.find('.btn-loading');

                cart_item_btn_loading.show();

                $.ajax({
                    url     : '{{ url('other-update-cart') }}',
                    method  : "patch",
                    data    : {
                        _token      : '{{ csrf_token() }}',
                        id          : cart_item_id,
                        quantity    : cart_item_quantity,
                        card_message: cart_item_card_message
                    },
                    dataType: "json",
                    success : function (response) {
                        cart_item_btn_loading.hide();
                        $("#header-bar").html(response.data);
                        cart_item_product_subtotal.text(response.subTotal);
                        $('.cart-total').text(response.total);
                        $('.cart-quantity').text(response.totalQty);
                    }
                });

            });

        }

        $(document).ready(function () {
            $(".quantity").change(function () {
                var ele = $(this);
                var parent_row = ele.parent().parent();
                var quantity = parent_row.find(".quantity").val();
                var product_subtotal = parent_row.find("span.product-subtotal");
                var cart_total = $(".cart-total");
                var cart_quantity = $(".cart-quantity");
                var loading = parent_row.find(".btn-loading");

                $.ajax({
                    url     : '{{ url('other-update-cart') }}',
                    method  : "patch",
                    data    : {
                        _token  : '{{ csrf_token() }}',
                        id      : ele.data("id"),
                        quantity: quantity
                    },
                    dataType: "json",
                    success : function (response) {
                        loading.hide();
                        $("span#status").html('<div class="alert alert-success">' + response.msg + '</div>');
                        $("#header-bar").html(response.data);
                        product_subtotal.text(response.subTotal);
                        cart_total.text(response.total);
                        cart_quantity.text(response.totalQty);
                    }
                });
            });

            $(".update-cart").click(function (e) {
                var ele = $(this);
                var parent_row = ele.parent().parent();
                var quantity = parent_row.find(".quantity").val();
                var product_subtotal = parent_row.find("span.product-subtotal");
                var cart_total = $(".cart-total");
                var cart_quantity = $(".cart-quantity");
                var card_message = parent_row.find('.card_message').val();
                var loading = parent_row.find(".btn-loading");
                loading.show();

                $.ajax({
                    url     : '{{ url('other-update-cart') }}',
                    method  : "patch",
                    data    : {
                        _token       : '{{ csrf_token() }}',
                        id           : ele.data("id"),
                        quantity     : quantity,
                        data_prev_qty: ele.attr("data-prev-qty"),
                        card_message : card_message
                    },
                    dataType: "json",
                    success : function (response) {
                        $("span#status").html('<div class="alert alert-success">' + response.msg + '</div>');
                        $("#header-bar").html(response.data);
                        product_subtotal.text(response.subTotal);
                        cart_total.text(response.total);
                        cart_quantity.text(response.totalQty);
                        loading.hide();
                    }
                });
            });

            $(".remove-from-cart").click(function (e) {
                e.preventDefault();
                var ele = $(this);
                var parent_row = ele.parents("tr");
                var cart_total = $(".cart-total");
                var cart_quantity = $(".cart-quantity");
                if (confirm("Are you sure")) {
                    $.ajax({
                        url     : '{{ url('other-remove-from-cart') }}',
                        method  : "DELETE",
                        data    : {
                            _token: '{{ csrf_token() }}',
                            id    : ele.attr("data-id")
                        },
                        dataType: "json",
                        success : function (response) {
                            parent_row.remove();
                            $("span#status").html('<div class="alert alert-success">' + response.msg +
                                '</div>');
                            $("#header-bar").html(response.data);
                            cart_total.text(response.total);
                            cart_quantity.text(response.totalQty);
                        }
                    });
                }
            });

            $('#checkout-button').on('click', function (e) {
                e.preventDefault();

                updateAllCartItems();
            });
        });
    </script>
@endsection
