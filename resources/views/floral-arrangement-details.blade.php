@extends('layouts.frontend')

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

        #custom_price {
            display: none;
            height: 32px;
            margin-top: 38px;
            width: 83px;
            margin-left: 18px;
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* For Firefox */
        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>
    <div class="container">
        <div class="row" style="margin-top: 60px;margin-bottom: 60px;">
            <span id="status"></span>

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
                    <p class="mt-2" data-title="{{ $flower->title}}"><b>{{ $flower->title}}</b></p><br>
                    <h5 style="margin-top: 38px;margin-left: -78px;">
                        $<span id="cng_price">{{ number_format($flower->price,2,'.','') }}</span>

                    </h5>


                    <input type="number" id="custom_price" placeholder="Price"
                           data-max="{{ $aranPrice->maximum_amount}}" data-min="{{ $aranPrice->minimum_amount}}"/>
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
                    @if(!empty($category) && ($category==9))
                        <div class="form-group" style="margin-top: 20px;">
                            <label for="product_category">Style</label>
                            <select class="form-select col-8 category-cls " name="style" id="style"
                                    style="margin-left: 180px;margin-top: -66px;width:130px;">
                                @foreach($styles as $style)
                                    <option value="{{$style->pk_styles}}">{{$style->styles}}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <br>
                    <div class="form-group" style="margin-top: 20px;">
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
    </div>


    <script type="text/javascript">
        var price = parseFloat({{ $flower->price }});
        $(".subsciptionType").click(function (e) {
            e.preventDefault();
            var ele = $(this);
            ele.siblings('.btn-loading').show();

            $.ajax({
                url     : '{{ url('floral-arrangement-addCard') }}',
                method  : "POST",
                data    : {
                    _token         : '{{ csrf_token() }}',
                    id             : ele.attr("data-sub-id"),
                    color          : $('#color').val(),
                    title          : ele.attr("data-title"),
                    style          : $('#style').val(),
                    arrangementType: $('#arrangementType').val(),
                    custom_price   : $('#custom_price').val(),
                    flower_id      : $('#flower').val(),
                    quantity       : $('#quantity').val(),
                    type           : 3
                },
                dataType: "json",
                success : function (response) {

                    ele.siblings('.btn-loading').hide();

                    $("span#status").html('<div class="alert alert-success">Floral arrangement adding done successfully</div>');
                    $("#header-bar").html(response.data);
                    location.reload();
                }
            });


        });

        $(document).on("change", "#arrangementType", function () {
            var ele = $(this);
            let agn_price = $('option:selected', this).attr('data-price');

            if ($('option:selected', this).text() == 'Custom') {
                $("#cng_price").css('display', 'none');

                $("#custom_price").css('display', 'inline-block');
                $("#custom_price").attr("data-price", agn_price);
            } else {
                $("#cng_price").css('display', 'inline');
                $("#custom_price").css('display', 'none');
            }
            $("#cng_price").text(agn_price);
        })
        var input = $("#custom_price");
        var minValue = parseFloat(input.attr("data-min"));
        var maxValue = parseFloat(input.attr("data-max"));

        input.on("change", function () {
            var value = parseFloat(input.val());

            if (isNaN(value)) {
                alert("Please enter a valid number.");
                input.val(""); // Clear the input if it's not a valid number
            } else if (value < minValue || value > maxValue) {
                alert("Value should be between " + minValue + " and " + maxValue + ".");
                input.val(""); // Clear the input if it's outside the range
            }
        });

        $(".addMinues").on("click", function () {

            var $button = $(this);
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
