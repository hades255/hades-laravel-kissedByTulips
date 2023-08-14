@extends('layouts.frontend')

@section('content')
      <div class="row">
      <div class="col-md-2" style="margin-top: 60px;">
        <ul style="margin-left:10px;list-style-type:none;">
        @foreach($products as $k => $v)
        <li class="{{isset($categoryId) && ($v->pk_product_category==$categoryId) ? 'active' : ''}}"><a href="/floral-arrangement/category/{{\Illuminate\Support\Facades\Crypt::encrypt($v->pk_product_category)}}" style="color:black;text-decoration:none;">{{ucfirst($v->product_category)}}</a></li>
        @endforeach
        </ul>
      </div>
       <div class="col-md-10" style="margin-top: 40px;">
       <div class="row">
         @foreach($flowers as $k => $v)
          <div class="col-md-3 text-center">
            <span style="text-align:center;"><b> {{ $v->title }} </b></span>
             <a href="{{ URL::to('floral-arrangement-details/'.$v->pk_floral_arrangements) }}">
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
       </div>

       </div>
      </div>

      <script type="text/javascript">
        $(".subsciptionType").click(function (e) {
            e.preventDefault();
            var ele = $(this);
            ele.siblings('.btn-loading').show();


            $.ajax({
                url: '{{ url('other-add-to-cart') }}',
                method: "post",
                data: {_token: '{{ csrf_token() }}', id: ele.attr("data-sub-id"), type: 3},
                dataType: "json",
                success: function (response) {

                    ele.siblings('.btn-loading').hide();

                    $("span#status").html('<div class="alert alert-success">subscription adding done successfully</div>');
                    $("#header-bar").html(response.data);
                }
            });
        });
    </script>
@endsection
