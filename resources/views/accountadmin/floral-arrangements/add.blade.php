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
                        <li class="breadcrumb-item active"><a href="/accountadmin/floral-arrangements">Floral Arrangements</a></li>
                    </ol>
                    <button type="button" style="margin-top:-34px;" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i class="fa fa-plus-circle"></i>{{ isset($floralArrangement) && ($floralArrangement->pk_floral_arrangements) ? ' Edit Floral Arrangement':' Create Floral Arrangement'}} </button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                @endif

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ isset($floralArrangement) && ($floralArrangement->pk_floral_arrangements) ? 'Edit Floral Arrangement':'Create Floral Arrangement'}}</h4>

                        <ul class="nav nav-tabs customtab" role="tablist">
                           <li class="nav-item"> <a class="nav-link active" data-bs-toggle="tab" href="#customerinfo" role="tab" aria-selected="true"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Info</span></a> </li>
                           <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#pricetab" role="tab" aria-selected="false"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Price</span></a> </li>
                        </ul>

                        <form class="form-horizontal mt-4 " method="post" action="/accountadmin/floral-arrangements/submit" enctype="multipart/form-data">
                            @csrf
                            <div class="tab-content br-n pn">

                                <div class="tab-pane p-20 active" id="customerinfo" role="tabpanel">
                                    <div class="row">

                                        <div class="col-md-6">
                                          <div class="form-group">
                                              <label for="title">Title</label>
                                              <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ isset($floralArrangement) && ($floralArrangement->title) ?$floralArrangement->title: old('title')}}">
                                              @error('title')
                                                  <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                  </span>
                                              @enderror
                                          </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ isset($floralArrangement) && ($floralArrangement->description) ?$floralArrangement->description: old('description')}}">
                                                @error('description')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        </div>
                                        <div class ="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="product_category">Product Category</label>
                                                <select class="form-select col-12 category-cls @error('product_category') is-invalid @enderror" name="product_category">
                                                    <option value="">Select Product Category</option>
                                                    @foreach($product_categoies as $product_category)
                                                        <option value="{{ $product_category->pk_product_category }}" {{  isset($floralArrangement) && ($floralArrangement->pk_product_category == $product_category->pk_product_category)? 'selected':''}}>{{$product_category->product_category}}</option>
                                                    @endforeach
                                                </select>
                                                @error('product_category')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pk_product_sub_category">Product Sub Category</label>
                                                <select class="form-select col-12 sub-category-cls @error('pk_product_sub_category') is-invalid @enderror" name="pk_product_sub_category">
                                                    <option value="">Select Sub Category</option>
                                                    @if(!empty($sub_category))
                                                        @foreach($sub_category as $key=>$value)
                                                            <option value="{{ $key }}" {{  isset($floralArrangement) && ($floralArrangement->pk_product_sub_category == $key)? 'selected':''}}>{{$value}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('pk_product_sub_category')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                        <!-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="flowers">Flowers</label>
                                                <select class="form-select col-12 @error('flowers') is-invalid @enderror" name="flowers">
                                                    <option value="">Select Flowers</option>
                                                    @foreach($flowers as $flower)
                                                        <option value="{{ $flower->pk_flowers }}" {{ old('pk_flowers') == $flower->pk_flowers || isset($floralArrangement) && ($floralArrangement->pk_flowers == $flower->pk_flowers)? 'selected':''}}>{{$flower->flowers}}</option>
                                                    @endforeach
                                                </select>
                                                @error('flowers')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div> -->

                                        <!-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="description">Price</label>
                                                <input type="text" name="price" class="form-control price-val @error('price') is-invalid @enderror" value="{{ isset($floralArrangement) && ($floralArrangement->price) ?$floralArrangement->price: old('price')}}">
                                                @error('price')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div> -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="images">Images</label>
                                                <input type="file" multiple name="images[]" accept="image/png, image/jpeg" class="form-control @error('images') is-invalid @enderror">
                                                <small for="files">To select multiple images, hold down the CTRL or SHIFT key while selecting</small>
                                                @error('images')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="images">Videos</label>
                                                <input type="file" multiple name="videos[]" accept="video/*" class="form-control @error('videos') is-invalid @enderror">
                                                <small for="files">To select multiple files, hold down the CTRL or SHIFT key while selecting</small>
                                                @error('images')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                     
                                        <div class="col-md-12">
                                                @if(!empty($arrangements_images))
                                                    @foreach($arrangements_images as $img)
                                                        <div class="col-md-2 img-div-{!! $img->pk_floral_arrangements_images !!}">
                                                            <div class="form-group">
                                                            <label for="images">
                                                                <a target="_blank" href="/flower-subscription/{!! $img->path !!}">Click View</a>&nbsp;&nbsp;
                                                                <a class="text-danger" onclick="removeFile({!! $img->pk_floral_arrangements_images !!})"  href="javascript:void(0)">Remove</a>
                                                            </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Active</label>
                                                <input type="radio" name="active"  value="1" checked="checked" class="form-check-input">
                                                <label class="form-check-label" for="customRadio11" style="margin-left: 20px;">Yes</label>
                                                <input type="radio" name="active" value="0" {{ isset($floralArrangement) && ($floralArrangement->active=="0")? "checked" : "" }}  class="form-check-input">
                                                <label class="form-check-label" for="customRadio22" style="margin-left: 20px;">No</label>
                                            </div>
                                        </div>
                                        </div>
                                        </div>
                                        

                                    </div>
                                </div>

                                <div class="tab-pane p-20" id="pricetab" role="tabpanel" style="display:none;">
                                        @foreach($arrangementTypes as $arrayVal)
                                            @if(strtolower($arrayVal->arrangement_type) != strtolower('custom'))
                                            <div class="row multi_price_row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="floral_arrangements{{$arrayVal->pk_arrangement_type}}">Floral Arrangements</label>
                                                        <select class="form-select col-12 floralarrangement-cls @error('floral_arrangements_mul') is-invalid @enderror" name="floral_arrangements_mul[{{$arrayVal->pk_arrangement_type}}]">
                                                            <option value="">Select Arrangement Type</option>
                                                            @foreach($arrangementTypes as $arrangementType)
                                                                @if(strtolower($arrangementType->arrangement_type) != strtolower('custom'))
                                                                <option data-price="" value="{!! $arrangementType->pk_arrangement_type !!}" @if(isset($new_arrayPrice[$arrayVal->pk_arrangement_type]) && $new_arrayPrice[$arrayVal->pk_arrangement_type] == $arrangementType->pk_arrangement_type) selected @else
                                                                {{($arrayVal->pk_arrangement_type == $arrangementType->pk_arrangement_type)? 'selected':''}} @endif >{{$arrangementType->arrangement_type}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="description">Price</label>
                                                        <input type="text" name="price_mul[{{$arrayVal->pk_arrangement_type}}]" class="form-control price-val" value="{!! ( isset($new_arrayPrice[$arrayVal->pk_arrangement_type]) && $new_arrayPrice[$arrayVal->pk_arrangement_type]) ? $new_arrayPrice[$arrayVal->pk_arrangement_type] : number_format($arrayVal->price,2,'.','') !!}">
                                                        @error('price')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>
                                            @endif
                                        @endforeach
                                </div>

                           
                            <div class="row">
                                <div class="col-md-12 m-l-20">
                                    <input type="hidden" name="pk_account" value="{{isset($pk_account) ? $pk_account : ''}}" >
                                    <input type="hidden" name="pk_floral_arrangements" value="{{ isset($floralArrangement) && ($floralArrangement->pk_floral_arrangements) ?$floralArrangement->pk_floral_arrangements : ''}}" >
                                    <a href="/accountadmin/floral-arrangements/back"><input class="btn btn-primary" type="button" value="Cancel"></a>
                                    <input class="btn btn-primary" type="submit" value="{{ isset($floralArrangement) && ($floralArrangement->pk_floral_arrangements)? "Update" : "Submit" }}">
                                </div>
                            </div>
                             </div>


                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    function removeFile(id) {
        $.ajax({
            url: "/accountadmin/floral-arrangements/removefile?id=" + id,
            method: 'GET',
            success: function(data) {
                $('.img-div-'+id).remove();
            }
        });
    }

    $(document).ready(function(){

        $(".floralarrangement-cls").change(function() {
            $('.price-val').val($(this).find(':selected').data('price'));
        });


        $(".category-cls").change(function(){
            let getval = $( ".category-cls option:selected" ).text();
            $.ajax({
                url: "/accountadmin/floral-arrangements/subcategory?id=" + $(this).val(),
                method: 'GET',
                success: function(data) {
                    $('.sub-category-cls').html(data.html);
                }
            });
        });

    });
</script>


@endsection
