<div class="col-lg-12 col-sm-12 col-12 main-section">
    <div class="dropdown">
        <!-- for product -->
        <!-- <button type="button" class="btn btn-info" data-toggle="dropdown" style="float: right;margin-top: -48px;margin-right: 30px">
            <a href="{{ URL::to('cart') }}" style="text-decoration: none; color: #000;">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-danger">{{ session('total_quantity') ? session('total_quantity') : 0 }}</span></a>
        </button> -->

        <button type="button" class="btn btn-info" data-toggle="dropdown" style="float: right;margin-top: -48px;margin-right: 19px">
            <a href="{{ URL::to('other-cart') }}" style="text-decoration: none; color: #000;">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-danger">{{ session('oth_total_quantity') ? session('oth_total_quantity') : 0 }}</span></a>
        </button>
        
        <div class="dropdown-menu">
            <div class="row total-header-section">
                <!-- for product -->
                <!-- <div class="col-lg-6 col-sm-6 col-6">
                    <a href="{{ URL::to('cart') }}" style="text-decoration: none; color: #000;">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">{{ session('total_quantity') ? session('total_quantity') : 0 }}</span>
                    </a>
                </div> -->

                <div class="col-lg-6 col-sm-6 col-6">
                    <a href="{{ URL::to('cart') }}" style="text-decoration: none; color: #000;">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">{{ session('oth_total_quantity') ? session('oth_total_quantity') : 0 }}</span>
                    </a>
                </div>

                <?php $total = 0 ?>
                @foreach((array) session('cart') as $id => $details)
                    <?php $total += $details['price'] * $details['quantity'] ?>
                @endforeach

                <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                    <p>Total: <span class="text-info">$ {{ $total }}</span></p>
                </div>
            </div>

            @if(session('cart'))
                @foreach((array) session('cart') as $id => $details)
                    <div class="row cart-detail">
                        <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                            <img src="{{ $details['photo'] }}" />
                        </div>
                        <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                            <p>{{ $details['name'] }}</p>
                            <span class="price text-info"> ${{ $details['price'] }}</span> <span class="count"> Quantity:{{ $details['quantity'] }}</span>
                        </div>
                    </div>
                @endforeach
            @endif
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                    <a href="{{ url('cart') }}" class="btn btn-primary btn-block">View all</a>
                </div>
            </div>
        </div>
    </div>
</div>
