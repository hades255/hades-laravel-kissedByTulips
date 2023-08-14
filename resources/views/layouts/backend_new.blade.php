<!DOCTYPE html>
<html lang="en">
  <head>
    <title>kissedbytulips</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{asset('home/css/animate.css')}}">

    <link rel="stylesheet" href="{{asset('home/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('home/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('home/css/magnific-popup.css')}}">
	<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;200;300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('home/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('home/css/style.css')}}">
	<link rel="stylesheet" href="{{asset('home/font/stylesheet.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
  <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
  @yield('js')
  <!--- calendar !---->

      <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.js'></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.7/index.global.min.js"></script>--}}
{{--<link href="https://demos.codexworld.com/3rd-party/fullcalendar-5.11.0/lib/main.css" rel="stylesheet" />--}}

   <link rel="stylesheet" type="text/css"
        href="{{asset('assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" type="text/css"
        href="{{asset('assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css')}}">
    <!-- Custom CSS -->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/node_modules/jsgrid/jsgrid.min.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('assets/node_modules/jsgrid/jsgrid-theme.min.css')}}" />
    <link href="{{asset('dist/css/pages/tab-page.css')}}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  $('select').selectpicker();

  </script>



  </head>
  <body>
  @include('common.backend-header')

    <!-- END nav -->
  @yield('content')
@include('common.backend-footer')
<script defer src="{!! asset('assets/js/bootstrap-notify.js') !!}"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

<script type="text/javascript">

@if(session()->has('message'))
  var placementFrom = "top";
  var placementAlign = "right";
  var animateEnter = '';
  var animateExit = '';
  var colorName = "{{ (session()->get('level') == 'danger') ? 'bg-red' : 'bg-green' }}";
  showNotification(colorName, "{{ session()->get('message') }}", placementFrom, placementAlign, animateEnter, animateExit);
@endif

    function showNotification(t, e, o, a, n, s) {
        (null !== t && "" !== t) || (t = "bg-black"), (null !== e && "" !== e) || (e = "Turning standard Bootstrap alerts"), (null !== n && "" !== n) || (n = "animated fadeInDown"), (null !== s && "" !== s) || (s = "animated fadeOutUp");
        $.notify(
            { message: e },
            {
                type: t,
                allow_dismiss: !0,
                newest_on_top: !0,
                timer: 1e3,
                placement: { from: o, align: a },
                animate: { enter: n, exit: s },
                template:
                '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible {0} p-r-35" role="alert"><span data-notify="icon"></span> <span data-notify="title">{1}</span> <span data-notify="message">{2}</span><div class="progress" data-notify="progressbar"><div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div></div><a href="{3}" target="{4}" data-notify="url"></a></div>',
            }
        );
    }

     $(".homePage").click(function (e) {
        window.localStorage.setItem('location', 'home');
    });
</script>
<script>
AOS.init({
duration: 1200,
})

</script>

  <script>
  $(document).ready(function(){
$(".b").click(function(){
  $(this).toggleClass("b");
  $(this).toggleClass("b-selected");
});
});

$(document).ready(function(){
$(".account_admin_user_roles").change(function(){
  if( ($(this).val() == '6')  || ( $(this).val() == '7') || ( $(this).val() == '3')  ||  ( $(this).val() == '5')){
    $(".location-users").css("display","block");
  }
  else{
    $(".location-users").css("display","none");
  }
});
});

var elem = document.querySelector('.carousel');
var flkty = new Flickity( elem, {
// options
cellalign: 'right',
pageDots: true,
groupCells: '40%',
selectedAttraction: 0.03,
prevNextButtons: false,
freeScroll: true



});
var flkty = new Flickity( '.carousel', {
// options
});
</script>


<script>
$(document).ready(function(){
  $(".searchItem").click(function(){
  $("p:first").addClass("intro");
  });


  $('.t-top').click(function(){
$('.top').toggleClass('showemenu');
});

$('#SearchClose').click(function(){
$('.navbar').removeClass('showemenu');
});

$(".zapiet-delivery-validator__close").click(function(){
  $(".topForm").addClass("hide");
  });

  $(".topVar .close").click(function(){
  $(".topVar").addClass("closed");
  });

});


        function form_alert(id, message) {
        swal({
            title: '{{"Are you sure?"}}',
            text: message,
            type: 'warning',
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $('#'+id).submit()
            }
        })
    }

</script>



<!-- Notify Messages -->

  <script src="{{asset('home/js/jquery-migrate-3.0.1.min.js')}}"></script>
  <script src="{{asset('home/js/popper.min.js')}}"></script>
  <script src="{{asset('home/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('home/js/jquery.easing.1.3.js')}}"></script>
  <script src="{{asset('home/js/jquery.waypoints.min.js')}}"></script>
  <script src="{{asset('home/js/jquery.stellar.min.js')}}"></script>
  <script src="{{asset('home/js/jquery.animateNumber.min.js')}}"></script>
  <script src="{{asset('home/js/owl.carousel.min.js')}}"></script>
  <script src="{{asset('home/js/jquery.magnific-popup.min.js')}}"></script>
  <script src="{{asset('home/js/scrollax.min.js')}}"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="{{asset('home/js/google-map.js')}}"></script>
  <script src="{{asset('home/js/main.js')}}"></script>
    <script src="{{asset('assets/custom.js')}}"></script>


  <script src="https://unpkg.com/aos@2.3.0/dist/aos.js"></script>

  </body>
</html>
