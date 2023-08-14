@extends('layouts.app')

@section('title', 'Cart')

@section('content')
    <span id="status"></span>
    <table id="cart" class="table table-hover table-condensed" style="margin-top: 30px;">
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

        @if(session('cart'))
            @foreach((array) session('cart') as $id => $details)

                <?php 
                    $total += $details['price'] * $details['quantity'];
                    $total_qty += $details['quantity'];
                ?>

                <tr>
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs"><img src="products/{{ $details['photo'] }}" width="100" height="100" class="img-responsive"/></div>
                            <div class="col-sm-9">
                                <h4 class="nomargin">{{ $details['name'] }}</h4>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">${{ $details['price'] }}</td>
                    <td data-th="Quantity">
                        <input type="number" min="1" value="{{ $details['quantity'] }}" class="form-control quantity" />
                    </td>
                    <td data-th="Subtotal" class="text-center">$<span class="product-subtotal">{{ $details['price'] * $details['quantity'] }}</span></td>
                    <td class="actions" data-th="">
                        <button class="btn btn-info btn-sm update-cart" data-id="{{ $id }}" data-prev-qty="{{ $details['quantity'] }}"><i class="fa fa-refresh"></i></button>
                        <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><i class="fa fa-trash-o"></i></button>
                        <i class="fa fa-circle-o-notch fa-spin btn-loading" style="font-size:24px; display: none"></i>
                    </td>
                </tr>
            @endforeach
        @endif

        </tbody>
        <tfoot>
        <tr>
            <!-- <td class="text-center"><strong>Total$<span class="cart-total">{{ $total }}</span></strong></td> -->
            <td colspan="1"></td>
            <td class="text-center" colspan="2"><strong>Total Quantity <span class="cart-total">{{ $total_qty }}</span></strong></td>
        </tr>
        <tr>
            <td><a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a> <a href="{{ url('/checkout') }}" class="btn btn-success"><i class="fa fa-angle-left"></i> Checkout</a></td>
            <td colspan="2" class="hidden-xs"></td>
            <td class="hidden-xs text-center"><strong>Total $<span class="cart-total">{{ $total }}</span></strong></td>
        </tr>
        </tfoot>
    </table>

    <script type="text/javascript">

        

        $(".update-cart").click(function (e) {
            e.preventDefault();
            var ele = $(this);
            var parent_row = ele.parents("tr");
            var quantity = parent_row.find(".quantity").val();
            var product_subtotal = parent_row.find("span.product-subtotal");
            var cart_total = $(".cart-total");
            var loading = parent_row.find(".btn-loading");
            loading.show();

            $.ajax({
                url: '{{ url('update-cart') }}',
                method: "patch",
                data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: quantity, data_prev_qty: ele.attr("data-prev-qty")},
                dataType: "json",
                success: function (response) {
                    loading.hide();
                    $("span#status").html('<div class="alert alert-success">'+response.msg+'</div>');
                    $("#header-bar").html(response.data);
                    product_subtotal.text(response.subTotal);
                    cart_total.text(response.total);
                }
            });
        });

        $(".remove-from-cart").click(function (e) {
            e.preventDefault();
            var ele = $(this);
            var parent_row = ele.parents("tr");
            var cart_total = $(".cart-total");
            if(confirm("Are you sure")) {
                $.ajax({
                    url: '{{ url('remove-from-cart') }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                    dataType: "json",
                    success: function (response) {
                        parent_row.remove();
                        $("span#status").html('<div class="alert alert-success">'+response.msg+'</div>');
                        $("#header-bar").html(response.data);
                        cart_total.text(response.total);
                    }
                });
            }
        });

    </script>
@endsection

