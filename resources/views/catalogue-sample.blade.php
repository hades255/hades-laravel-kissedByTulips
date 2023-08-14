<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>KBT</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- <link href="/dist/css/style.min.css" rel="stylesheet">
        <link href="/dist/css/custom.css" rel="stylesheet"> -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Styles -->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    </head>
    <body>

        <!-- Carousel -->
        <div id="demo" class="carousel slide" data-bs-ride="carousel">

          <!-- Indicators/dots -->
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
          </div>

          <!-- The slideshow/carousel -->
          <div class="carousel-inner" style="height: 400px;">
            <div class="carousel-item active">
              <img src="https://floristsreview.com/wp-content/uploads/2019/09/FLORISTSREVIEW_HitomiGilliamCREATIVEEDGE_SEPT2019-1-of-3-min.jpg" alt="Los Angeles" class="d-block" style="width:100%">
              <!-- <div class="carousel-caption d-none d-md-block" style="bottom: 8rem; color: #262626;">
                <h4>Natur</h4>

              </div> -->
            </div>
            <div class="carousel-item">
              <img src="https://www.proflowers.com/blog/wp-content/uploads/2012/08/jun-birth-flower-hero-1.jpg" alt="Chicago" class="d-block" style="width:100%">
            </div>
            <div class="carousel-item">
              <img src="https://sweetcicelyflowers.com/wp-content/uploads/2015/03/slide-21.jpg" alt="New York" class="d-block" style="width:100%">
            </div>
          </div>

          <!-- Left and right controls/icons -->
          <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
          </button>
        </div>

        <div class="container-fluid mt-5">
          <!-- Gallery -->
            <div class="row">
              <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                <img
                  src="https://cdn.pixabay.com/photo/2015/04/19/08/32/marguerite-729510__340.jpg"
                  class="w-100 shadow-1-strong rounded mb-4 img"
                  alt="Boat on Calm Water"
                />

                <img
                  src="https://images.unsplash.com/photo-1528758054211-22aa4c5300db?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8cHVycGxlJTIwZmxvd2VyfGVufDB8fDB8fA%3D%3D&w=1000&q=80"
                  class="w-100 shadow-1-strong rounded mb-4 img"
                  alt="Wintry Mountain Landscape"
                />
              </div>

              <div class="col-lg-4 mb-4 mb-lg-0">
                <img
                  src="https://images.unsplash.com/photo-1566208541068-ffdb5471e9bf?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8c21hbGwlMjBmbG93ZXJzfGVufDB8fDB8fA%3D%3D&w=1000&q=80"
                  class="w-100 shadow-1-strong rounded mb-4 img"
                  alt="Mountains in the Clouds"
                />

                <img
                  src="https://images.pexels.com/photos/56866/garden-rose-red-pink-56866.jpeg?cs=srgb&dl=pexels-pixabay-56866.jpg&fm=jpg"
                  class="w-100 shadow-1-strong rounded mb-4 img"
                  alt="Boat on Calm Water"
                />
              </div>

              <div class="col-lg-4 mb-4 mb-lg-0">
                <img
                  src="https://cdn.pixabay.com/photo/2018/02/23/12/38/flower-3175428__340.jpg"
                  class="w-100 shadow-1-strong rounded mb-4 img"
                  alt="Waves at Sea"
                />

                <img
                  src="https://www.bhg.com/thmb/Wc9cabpkA_Qaz14ijOIoRpsFXEo=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/oriental-lily-dc691960-bc3f11f018ad468ab326cb01020e82c4.jpg"
                  class="w-100 shadow-1-strong rounded mb-4 img"
                  alt="Yosemite National Park"
                />
              </div>
            </div>
            <!-- Gallery -->
        </div>

        <script src="/assets/node_modules/jquery/dist/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {


              var degrees = 0;
              $('.img').click(function rotateMe(e) {
                degrees += 90;
                //$('.img').addClass('rotated'); // for one time rotation
                    $(this).css({
                      'transform': 'rotate(' + degrees + 'deg)',
                      '-ms-transform': 'rotate(' + degrees + 'deg)',
                      '-moz-transform': 'rotate(' + degrees + 'deg)',
                      '-webkit-transform': 'rotate(' + degrees + 'deg)',
                      '-o-transform': 'rotate(' + degrees + 'deg)'
                    });
                })

            });

        </script>

    </body>
</html>
