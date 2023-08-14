@extends('layouts.backend_new')

@section('content')
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Dashboard</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="/accountadmin">Home</a></li>
                        <li class="breadcrumb-item active"><a href="/accountadmin/products">Products</a></li>
                    </ol>
                    <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white" style="margin-top:-34px;"><i class="fa fa-plus-circle"></i>{{ isset($product) && ($product->pk_products) ? 'Edit Product':'Create New Product'}} </button>
                </div>
            </div>
        </div>
        <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title" style="text-align: center;">{{ isset($product) && ($product->pk_products) ? 'Edit Product':'Create New Product'}}</h4>
                                <div class="tab-content br-n pn">
                                    <div id="navpills-1" class="tab-pane active">
                                        <div class="row">
                                          @if(Session::has('message'))
                                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                                          @endif
                                          <form style="margin-left: 540px;" class="form-horizontal mt-4 " method="post" action="/accountadmin/products/submit" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="product_location">Location</label>
                                                <select class="form-control form-select col-12" name="location" class="form-control @error('pk_product_category') is-invalid @enderror">
                                                    <option value="">Select Location</option>
                                                    @foreach($locations as $location)
                                                        <option value="{{ $location->pk_locations }}" {{ old('location') == $location->pk_locations || isset($product) && ($product->pk_locations == $location->pk_locations)? 'selected':''}}>{{$location->location_name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('location')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="product">Product Name</label>
                                                <input type="text" name="product" class="form-control @error('product') is-invalid @enderror" value="{{ isset($product) && ($product->product) ?$product->product: old('product')}}">
                                                @error('product')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            @if(!isset($product) && empty($product->location_bar_code))
                                            <div class="form-group">
                                                <label for="product">Location Bar Code</label>
                                                <input type="text" name="location_bar_code" class="form-control @error('location_bar_code') is-invalid @enderror" value="{{ isset($product) && ($product->location_bar_code) ?$product->location_bar_code: old('location_bar_code')}}">
                                                @error('location_bar_code')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            @endif
                                            @if(isset($product) && ($product->location_bar_code))
                                            <h4>Product Bar Code </h4>
                                            {!! DNS1D::getBarcodeHTML($product->location_bar_code, 'CODABAR') !!}
                                            <div><span style="margin-left: 76px;">{{$product->location_bar_code}}</span></div>
                                            @endif
                                           </br>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ isset($product) && ($product->description) ?$product->description: old('description')}}">
                                                @error('description')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="product_category">Product Category</label>
                                                <select class="form-control form-select col-12" name="product_category" class="form-control @error('pk_product_category') is-invalid @enderror">
                                                    <option value="">Select Product Category</option>
                                                    @foreach($product_categoies as $product_category)
                                                        <option value="{{ $product_category->pk_product_category }}" {{ old('product_category') == $product_category->pk_product_category || isset($product) && ($product->pk_product_category == $product_category->pk_product_category)? 'selected':''}}>{{$product_category->product_category}}</option>
                                                    @endforeach
                                                </select>
                                                @error('product_category')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="flowers">Flowers</label>
                                                <select class="form-control form-select col-12" name="flowers" class="form-control @error('flowers') is-invalid @enderror">
                                                    <option value="">Select Flowers</option>
                                                    @foreach($flowers as $flower)
                                                        <option value="{{ $flower->pk_flowers }}" {{ old('flowers') == $flower->pk_flowers || isset($product) && ($product->pk_flowers == $flower->pk_flowers)? 'selected':''}}>{{$flower->flowers}}</option>
                                                    @endforeach
                                                </select>
                                                @error('flowers')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="color-flowers">Color Flowers</label>
                                                <select class="form-control form-select col-12" name="color_flowers" class="form-control @error('color_flowers') is-invalid @enderror">
                                                    <option value="">Select Color Flowers</option>
                                                    @foreach($colorflowers as $colorflower)
                                                        <option value="{{ $colorflower->pk_color_flower }}" {{ old('color_flowers') == $colorflower->pk_color_flower || isset($product) && ($product->pk_color_flower == $colorflower->pk_color_flower)? 'selected':''}}>{{$colorflower->color_flower}}</option>
                                                    @endforeach
                                                </select>
                                                @error('color_flowers')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Price</label>
                                                <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ isset($product) && ($product->price) ?$product->price: old('price')}}">
                                                @error('price')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="images">Images</label>
                                                <input type="file" name="images[]" multiple class="form-control @error('images') is-invalid @enderror">
                                                @error('images')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                                @if(isset($product) && ($product->images))
                                                 @foreach ($product->images as $image)
                                                  <img src="/products/{{$image->path}}" alt="{{ $image->name }}" height="40" width="40">
                                                  <a href="{{ route('accountadmin.products.image.delete', ['id' => $image->pk_product_images]) }}" class="delete-image">
                                                      <i class="fa fa-times-circle"></i>
                                                  </a>
                                                 @endforeach
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Active</label>
                                                    <input type="radio" name="active"  value="1" checked="checked" class="form-check-input" >
                                                    <label class="form-check-label" for="customRadio11" style="margin-left: 20px;">Yes</label>
                                                    <input type="radio" name="active" value="0" {{ isset($product) && ($product->active=="0")? "checked" : "" }}  class="form-check-input" >
                                                    <label class="form-check-label" for="customRadio22" style="margin-left: 20px;">No</label>
                                            </div>
                                            <input type="hidden" name="pk_account" value="{{isset($pk_account) ? $pk_account : ''}}" >
                                            <input type="hidden" name="pk_products" value="{{ isset($product) && ($product->pk_products) ?$product->pk_products : ''}}" >
                                            <a href="/accountadmin/products/back"><input class="btn btn-primary" type="button" value="Cancel"></a>
                                            <input class="btn btn-primary" type="submit" value="{{ isset($product) && ($product->pk_products)? "Update" : "Submit" }}">
                                          </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
</div>

@endsection
