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
                                <a href="{{ route('accountadmin.sales.checkout') }}" class="nav-link">
                                    <img class="cart" style="width:30px;" src="./home/images/cart.png">
                                    <span class="cardCounter"
                                          style="top: 3.8rem; left:3.3rem;">
                                        {{ session('pos_total_quantity') ? session('pos_total_quantity') : 0 }}
                                    </span>
                                </a>
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
                                        <div class="form-group">
                                            <label for="category" class="text-center">Category</label>
                                            <select name="pk_category" id="category-select" class="form-control">
                                                <option value="">All Products</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->pk_product_category }}">
                                                        {{ ucfirst($category->product_category) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span id="status"></span>
                                        <table id="cart" class="table table-hover table-condensed"
                                               style="margin-top: 30px;">
                                            <thead>
                                            <tr>
                                                <th style="width:50%">Image</th>
                                                <th style="width:10%">Price</th>
                                                <th style="width:8%">Quantity</th>
                                                <th style="width:22%" class="text-center">Total</th>
                                                <th style="width:10%"></th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php $total = 0; $total_qty = 0; ?>

                                            @foreach($products as $product)
                                                <tr>
                                                    <td data-th="Product">
                                                        @foreach($product->images as $img)
                                                            <img src="/products/{{$img->path}}"
                                                                 width="100" height="100"
                                                                 class="img-responsive"/>
                                                        @endforeach
                                                        {{ $product->product }}
                                                    </td>
                                                    <input type="hidden" name="price" value="{{$product->price}}">
                                                    <input type="hidden" name="color"
                                                           value="{{$product->pk_color_flower}}">
                                                    <td data-th="Price" class="price">${{$product->price}}</td>
                                                    <td data-th="Quantity">
                                                        <input type="number" min="1"
                                                               value="1"
                                                               data-productid="{{ $product->pk_products }}"
                                                               id="quantity_{{ $product->pk_products }}"
                                                               class="form-control quantity"/>
                                                    </td>
                                                    <td data-th="Subtotal" class="text-center">
                                                        $<span
                                                            class="product-subtotal_{{$product->pk_products}}"
                                                            data-productid="{{$product->pk_products}}">
                                                            {{ $product->price }}
                                                        </span>
                                                    </td>
                                                    <td class="actions" data-th="">
                                                        <button type="button"
                                                                class="btn btn-info btn-sm subsciptionType"
                                                                data-productid="{{$product->pk_products}}">Add to Cart
                                                        </button>
                                                        <!--  <button type="button"
                                                                  class="btn btn-danger btn-sm remove-from-cart"
                                                                  data-id=""><i
                                                                  class="fa fa-trash-o"></i>
                                                          </button>-->

                                                        <i class="fa fa-circle-o-notch fa-spin btn-loading"
                                                           style="font-size:24px; display: none"></i>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>


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
            $(".quantity").on('change', function () {
                console.log($(this).val())

                let priceVal = $(this).parents('tr').find("input[name='price']").val();
                let productId = $(this).data("productid");
                let total = priceVal * $(this).val();
                $('.product-subtotal_' + productId).text(total);


                let ele = $(this);
                let parent_row = ele.parents("tr");
                let quantity = parent_row.find(".quantity").val();
                let product_subtotal = total;
                let cart_total = $(".cart-total");
                let qty_total = $(".total-qty");
                let loading = parent_row.find(".btn-loading");
                loading.show();

                $.ajax({
                    url     : '{!! route('accountadmin.sales.floral-arrangement.update-cart-item') !!}',
                    method  : "POST",
                    data    : {
                        _token  : '{{ csrf_token() }}',
                        id      : productId,
                        quantity: quantity,
                        // price: price,
                        data_prev_qty: ele.attr("data-prev-qty")
                    },
                    dataType: "json",
                    success : function (response) {
                        loading.hide();
                        $("span#status").html('<div class="alert alert-success">' + response.msg + '</div>');
                        $('.product-subtotal_' + productId).text(response.subTotal);
                        cart_total.text(response.total);
                        qty_total.text(response.totalQty);
                    }
                });
            });
            $(".subsciptionType").click(function (e) {
                e.preventDefault();
                var ele = $(this);
                ele.siblings('.btn-loading').show();
                let quantity = $(this).parent().parent().find(".quantity").val();
                let color = $(this).parent().parent().find("input[name='color']").val();


                $.ajax({
                    url     : "{{ route('accountadmin.sales.productAddToCart') }}",
                    method  : "post",
                    data    : {
                        _token  : '{{ csrf_token() }}',
                        id      : ele.attr("data-productid"),
                        color   : color,
                        style   : '',
                        quantity: quantity,
                        type    : 3
                    },
                    dataType: "json",
                    success : function (response) {

                        console.log('addTocart', response);
                        ele.siblings('.btn-loading').hide();

                        $("span#status").html('<div class="alert alert-success">' + response.msg + '</div>');
                        $(".cardCounter").html(response.pos_total_quantity);
                    }
                });
            });

            $(".update-cart").click(function (e) {
                e.preventDefault();
                let ele = $(this);
                let parent_row = ele.parents("tr");
                let quantity = parent_row.find(".quantity").val();
                let product_subtotal = total;
                let cart_total = $(".cart-total");
                let qty_total = $(".total-qty");
                let loading = parent_row.find(".btn-loading");
                loading.show();

                $.ajax({
                    url     : '{!! route('accountadmin.sales.floral-arrangement.update-cart-item') !!}',
                    method  : "POST",
                    data    : {
                        _token       : '{{ csrf_token() }}',
                        id           : productId,
                        quantity     : quantity,
                        price        : price,
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


            $('#category-select').on('change', function () {

                console.log('category-select', $(this).val());

                $.ajax({
                    url     : '{!! route('accountadmin.sales.product-by-category') !!}',
                    method  : "POST",
                    data    : {_token: '{{ csrf_token() }}', category_id: $(this).val()},
                    dataType: "json",
                    success : function (response) {
                        $('#cart').find('tbody').html(response.data);
                    }
                });
            });

        });
        $(document).ready(function () {
            initOrderSelect2();

            $('#is-order-sale').on('change', function () {
                let isChecked = $(this).is(':checked');
                const orderSelectSection = $('#order-select-section');
                const generalSaleSection = $('#general-sale-section');
                const createSaleBtn = $('#createSaleBtn');
                const checkoutBtn = $('#checkoutBtn');


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
                var ele = $(this);
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


        });
    </script>
@endsection
