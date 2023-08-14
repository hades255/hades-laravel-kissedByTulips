@extends('layouts.app')

@section('content')
            <div class="row">
             <div class="col-md-12">

             <span id="status"></span>
               <form method="POST" action="">
                   @csrf
                   <div class="row">

                    
                       <div data-sub-id="{{ $flowerSubscriptions->pk_flower_subscription}}" class="col-md-3 subsciptionType">
                         <a href="javascript:void(0)">
                           <img
                            src="{!! asset('assets/images/flower/1.jpeg') !!}"
                            class="w-100 shadow-1-strong rounded mb-4 img"
                            alt="Boat on Calm Water" 
                            style="height:100%;"
                          />  
                        </a> 
                       </div> 

                       <div data-sub-id="{{ $flowerSubscriptions->pk_flower_subscription}}" class="col-md-3 subsciptionType">
                         <a href="javascript:void(0)">
                           <img
                            src="{!! asset('assets/images/flower/2.webp') !!}"
                            class="w-100 shadow-1-strong rounded mb-4 img"
                            alt="Boat on Calm Water"
                            style="height:100%;"
                          />  
                        </a> 
                       </div> 

                       
                       <div data-sub-id="{{ $flowerSubscriptions->pk_flower_subscription}}" class="col-md-3 subsciptionType">
                         <a href="javascript:void(0)">
                           <img
                            src="{!! asset('assets/images/flower/3.jpg') !!}"
                            class="w-100 shadow-1-strong rounded mb-4 img"
                            alt="Boat on Calm Water"
                            style="height:100%;"
                          />  
                        </a> 
                       </div> 

                       
                       <div data-sub-id="{{ $flowerSubscriptions->pk_flower_subscription}}" class="col-md-3 subsciptionType">
                         <a href="javascript:void(0)">
                           <img
                            src="{!! asset('assets/images/flower/4.jpeg') !!}"
                            class="w-100 shadow-1-strong rounded mb-4 img"
                            alt="Boat on Calm Water"
                            style="height:100%;"
                          />  
                        </a> 
                       </div> 
 


                   </div>
               </form>
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
