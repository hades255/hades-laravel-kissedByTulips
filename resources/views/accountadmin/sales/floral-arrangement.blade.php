@extends('layouts.backend_new')

@section('content')
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

                <a href="{{ route('accountadmin.sales.create') }}"
                   class="btn btn-info d-none d-lg-block m-l-15 text-white"
                   style="margin-top: -34px;">
                    Go to sale page
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2" style="margin-top: 60px;">
            <ul style="margin-left:10px;list-style-type:none;">
              <li class="active"><a href="{{ route('accountadmin.sales.floral-arrangement-by-category', Crypt::encrypt(100)) }}">All Products</a></li>
                @foreach($products as $k => $v)
                    <li class="{{isset($categoryId) && ($v->pk_product_category==$categoryId) ? 'active' : ''}}">
                        <a
                            href="{{ route('accountadmin.sales.floral-arrangement-by-category', Crypt::encrypt($v->pk_product_category)) }}"
                            style="color:black;text-decoration:none;">
                            {{ucfirst($v->product_category)}}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-10" style="margin-top: 40px;">
            <div class="row">
             @if(isset($allProducts) && !empty($allProducts))
             @foreach($allProducts as $product)
                @if(isset($product->pk_products))
                    <div class="col-md-3 text-center">
                        <span style="text-align:center;"><b> {{ $product->product }} </b></span>
                        <a href="{{ route('accountadmin.sales.productDetails', $product->pk_products) }}">
                            <img
                                src="{!! asset('/products/') !!}"
                                class="w-100 shadow-1-strong rounded mb-4 img"
                                alt="Boat on Calm Water" style="height:380px;"
                            />
                        </a>
                        <br>
                        <span><b>From ${{ $product->price }}</b></span>
                    </div>
                @else
                    <div class="col-md-3 text-center">
                        <span style="text-align:center;"><b> {{ $product->product }} </b></span>
                        <a href="{{ route('accountadmin.sales.floral-arrangement-details', $product->pk_products) }}">
                            <img
                                src="{!! asset('/products/') !!}"
                                class="w-100 shadow-1-strong rounded mb-4 img"
                                alt="Boat on Calm Water" style="height:380px;"
                            />
                        </a>
                        <br>
                        <span><b>From ${{ $product->price }}</b></span>
                    </div>
                @endif
             @endforeach
             @else
                @foreach($flowers as $k => $v)
                    <div class="col-md-3 text-center">
                        <span style="text-align:center;"><b> {{ $v->title }} </b></span>
                        <a href="{{ route('accountadmin.sales.floral-arrangement-details', $v->pk_floral_arrangements) }}">
                            <img
                                src="{!! asset('/flower-subscription/'.$v->path) !!}"
                                class="w-100 shadow-1-strong rounded mb-4 img"
                                alt="Boat on Calm Water" style="height:380px;"
                            />
                        </a>
                        <br>
                        <span><b>From ${{ $v->price }}</b></span>
                    </div>
                @endforeach
             @endif
            </div>

        </div>
    </div>

    <script type="text/javascript">
        $(".subsciptionType").click(function (e) {
            e.preventDefault();
            var ele = $(this);
            ele.siblings('.btn-loading').show();


            $.ajax({
                url     : '{{ url('other-add-to-cart') }}',
                method  : "post",
                data    : {_token: '{{ csrf_token() }}', id: ele.attr("data-sub-id"), type: 3},
                dataType: "json",
                success : function (response) {

                    ele.siblings('.btn-loading').hide();

                    $("span#status").html('<div class="alert alert-success">subscription adding done successfully</div>');
                    $("#header-bar").html(response.data);
                }
            });
        });
    </script>
@endsection
