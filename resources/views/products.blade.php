@extends('layouts.app')
@section('title', 'Products')
@section('content')
    <div class="container products">
        <span id="status"></span>
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-3">
                    <div class="thumbnail" style="text-align:center;">
                        <img src="products/{{ $product->path }}" width="200" height="200">
                        <div class="caption">
                            <h4>{{ $product->product }}</h4>
                            <p>{{ str_limit(strtolower($product->description), 50) }}</p>
                            <p><strong>Price: </strong> {{ $product->price }}$</p>
                            <p class="btn-holder">
                              <a href="javascript:void(0);" data-id="{{ $product->pk_products }}" class="btn btn-warning btn-block text-center add-to-cart" role="button">Add to cart</a>
                                <i class="fa fa-circle-o-notch fa-spin btn-loading" style="font-size:24px; display:none"></i>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div><!-- End row -->
    </div>
    <script type="text/javascript">
        $(".add-to-cart").click(function (e) {
            e.preventDefault();
            var ele = $(this);
            ele.siblings('.btn-loading').show();
            $.ajax({
                url: '{{ url('add-to-cart') }}' + '/' + ele.attr("data-id"),
                method: "get",
                data: {_token: '{{ csrf_token() }}'},
                dataType: "json",
                success: function (response) {

                    ele.siblings('.btn-loading').hide();

                    $("span#status").html('<div class="alert alert-success">'+response.msg+'</div>');
                    $("#header-bar").html(response.data);
                }
            });
        });
    </script>

@endsection
