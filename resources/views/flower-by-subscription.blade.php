@extends('layouts.frontend')

@section('content')
<style type="text/css">
  .card{
    border-radius: 0px;
  }

  #content-div .card {
    border: 6px solid;
    min-height: 140px;
    width: 240px;

  }

  #content-div .card-body{
    display: flex;
    /* height: 150px; */
    align-items: center;
    justify-content: center;
  }

  #content-div .card h4{
    /*line-height: 2rem;*/
    color: #000000;
    font-weight: 700;
  }

  #content-div .card a{
    text-decoration: none;
  }

</style>
            <div class="container">
              <div class="row" style="margin-top: 40px;margin-bottom: 40px;">

                <div class="col-md-6" style="">
                  <div class="card" style="width: 80%;">
                    <!-- style="background-image: url('{{ asset('assets/images/flower/DE21VALMM04S_1.webp')}}'); background-position: center; height: 100%; background-size: cover;background-repeat: no-repeat;" -->
                    <img class="" src="assets/images/flower/side-img-sub.jpg">
                  </div>
                </div>

                <!-- <div class="col-md-1"></div> -->
                <!-- <div class="col-md-7" style="display: flex; align-items: center;"> -->
                <div class="col-md-6" style="display: flex; align-items: center;">
                  <div class="row" id="content-div">

                    @foreach($flowerSubscriptions as $flowerSubscription)
                      <div class="col-md-6 p-3">
                        <div class="card">
                          <div class="card-body">
                            <a href="{!! url('flower-by-sub/'.$flowerSubscription->pk_flower_subscription) !!}" data-sub-id="{{ $flowerSubscription->pk_flower_subscription}}" class="subsciptionType-1" role="button">
                            <h4 class="card-title text-center">
                              {{ strtoupper($flowerSubscription->frequency) }}<br>
                              {{$flowerSubscription->price}}$ EACH
                            </h4>
                            </a>
                          </div>
                        </div>
                      </div>
                    @endforeach



                  </div>
                </div>

              </div>
            </div>

            <!-- <div class="row">
             <div class="col-md-12">
             <span id="status"></span>
               <form method="POST" action="">
                   @csrf
                   <div class="row">
                     @foreach($flowerSubscriptions as $flowerSubscription)
                       <div class="col-md-3">
                         <a href="#">
                         <?php /*<img
                           src="flower-subscription/{{$flowerSubscription->path}}"
                           class="w-100 shadow-1-strong rounded mb-4 img"
                           alt="Boat on Calm Water"
                         /> */ ?>
                         <h4>Subscription Type : <b>{{$flowerSubscription->frequency}}</b></h4>
                         <h4>Subscription Price : <b>{{$flowerSubscription->price}}$</b></h4>
                       </a>

                       <p class="btn-holder">
                              <a href="{!! url('flower-by-sub/'.$flowerSubscription->pk_flower_subscription) !!}" data-sub-id="{{ $flowerSubscription->pk_flower_subscription}}" class="btn btn-warning btn-block text-center subsciptionType-1" role="button">Select & Next</a>
                                <i class="fa fa-circle-o-notch fa-spin btn-loading" style="font-size: 24px; display: none;"></i>
                            </p>
                       </div>



                       @endforeach
                   </div>
               </form>
             </div>
            </div> -->

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
