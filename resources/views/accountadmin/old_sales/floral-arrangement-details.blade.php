@extends('layouts.backend_new')

@section('content')
    <style type="text/css">
        .card {
            border-radius: 0px;
        }

        #content-div .card {
            border: 6px solid;
            min-height: 140px;
            width: 240px;

        }

        #content-div .card-body {
            display: flex;
            /* height: 150px; */
            align-items: center;
            justify-content: center;
        }

        #content-div .card h4 {
            /*line-height: 2rem;*/
            color: #000000;
            font-weight: 700;
        }

        #content-div .card a {
            text-decoration: none;
        }

        /**
          qty button css Ruchi - 06-04-2023
        */
        .sp-quantity {
            width: 124px;
            height: 42px;
            margin-left: 14%;
            margin-top: 5%;
        }

        .sp-minus {
            width: 35px;
            height: 35px;
            border: 1px solid #e1e1e1;
            float: left;
            text-align: center;
        }

        .sp-input {
            width: 52px;
            height: 35px;
            border: 1px solid #e1e1e1;
            border-left: 0px solid black;
            float: left;
            text-align: center;
        }

        .sp-plus {
            width: 35px;
            height: 35px;
            border: 1px solid #e1e1e1;
            border-left: 0px solid #e1e1e1;
            float: left;
            text-align: center;
        }

        .sp-input input {
            width: 45px;
            height: 35px;
            text-align: center;
            border: none;
        }

        .sp-input input:focus {
            border: 1px solid #e1e1e1;
            border: none;
        }

        .sp-minus a, .sp-plus a {
            display: block;
            width: 100%;
            height: 100%;
            padding-top: 10%;
            font-size: 30px;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <span id="status"></span>
            </div>
        </div>
        <div class="row" style="margin-top: 60px;margin-bottom: 60px;">

            <div class="col-md-8" style="">
                <div class="card" style="width: 80%;">
                    <!-- style="background-image: url('{{ asset('assets/images/flower/DE21VALMM04S_1.webp')}}'); background-position: center; height: 100%; background-size: cover;background-repeat: no-repeat;" -->
                    <img class="" src="{!! asset('/flower-subscription/'.$flower->path) !!}">
                </div>
            </div>

            <!-- <div class="col-md-1"></div> -->
            <!-- <div class="col-md-7" style="display: flex; align-items: center;"> -->
            <div class="col-md-4" style="">
                <div class="row" id="content-div">
                    <p class="mt-2"><b>{{ $flower->title}}</b></p><br>
                    <h5 style="margin-top: 38px;margin-left: -78px;">$<span
                            id="cng_price">{{ number_format($flower->price,2,'.','') }}</span></h5>
                    <div class="sp-quantity" style="margin-top: 92px;margin-left: 94px;">
                        <span style="margin-left:-306px;">Items</span>
                        <div class="sp-minus fff"><a class="addMinues" href="javascript:void(0)">-</a>
                        </div>
                        <div class="sp-input">
                            <input type="text" class="quntity-input" name="quantity" id="quantity" max="100" min="1"
                                   value="1" readonly=""/>
                        </div>
                        <div class="sp-plus fff"><a class="addMinues" href="javascript:void(0)">+</a>
                        </div>
                    </div>
                    <hr>

                    <div class="form-group" style="margin-top: 20px;">
                        <label for="product_category">Style</label>
                        <select class="form-select col-8 category-cls " name="style" id="style"
                                style="margin-left: 180px;margin-top: -66px;width:130px;">
                            @foreach($styles as $style)
                                <option value="{{$style->pk_styles}}">{{$style->styles}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="product_category">Arrangement Type</label>
                        <select class="form-select col-8 category-cls " name="arrangementType" id="arrangementType"
                                style="margin-left: 182px;margin-top: -56px;width: 130px;">
                            @foreach($arrangementTypes as $arrangementType)
                                <option value="{{$arrangementType->pk_arrangement_type}}"
                                        data-price="{{number_format($arrangementType->price,2,'.','')}}">{{$arrangementType->arrangement_type}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row" style="margin-top: 30px;margin-left: 62px;">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-primary btn-lg btn-block subsciptionType"
                                    data-sub-id="{{ $flower->pk_floral_arrangements}}">Add to cart
                            </button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group">
                    <a href="{{ route('accountadmin.sales.floral-arrangement') }}"
                       class="btn btn-info d-none d-lg-block m-l-15 text-white"
                       style="margin-top: -34px;">
                        Continue Shopping
                    </a>
                    <a href="{{ route('accountadmin.sales.create') }}"
                       class="btn btn-info d-none d-lg-block m-l-15 text-white ml-3"
                       style="margin-top: -34px;">
                        Go to sale page
                    </a>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        var price = parseFloat({{ $flower->price }});
        $(".subsciptionType").click(function (e) {
            e.preventDefault();
            var ele = $(this);
            ele.siblings('.btn-loading').show();

            $.ajax({
                url     : '{!! route('accountadmin.sales.floral-arrangement.add-to-cart') !!}',
                method  : "post",
                data    : {
                    _token         : '{{ csrf_token() }}',
                    id             : ele.attr("data-sub-id"),
                    color          : $('#color').val(),
                    style          : $('#style').val(),
                    arrangementType: $('#arrangementType').val(),
                    flower_id      : $('#flower').val(),
                    quantity       : $('#quantity').val(),
                    type           : 3
                },
                dataType: "json",
                success : function (response) {

                    ele.siblings('.btn-loading').hide();

                    $("span#status").html('<div class="alert alert-success">Floral arrangement adding done successfully</div>');
                    location.reload();
                }
            });


        });

        $(document).on("change", "#arrangementType", function () {
            var ele       = $(this);
            let agn_price = $('option:selected', this).attr('data-price');
            $("#cng_price").text(agn_price);
        })

        $(".addMinues").on("click", function () {

            var $button  = $(this);
            var oldValue = $button.closest('.sp-quantity').find("input.quntity-input").val();

            if ($button.text() == "+") {
                if (oldValue <= 100) {
                    var newVal = parseFloat(oldValue) + 1;
                }
            } else {
                // Don't allow decrementing below zero
                if (oldValue > 1) {
                    var newVal = parseFloat(oldValue) - 1;
                } else {
                    newVal = 1;
                }
            }

            let newPrice = price * newVal;
            $('#cng_price').text(newPrice.toFixed(2));
            $button.closest('.sp-quantity').find("input.quntity-input").val(newVal);
        });

    </script>
@endsection
