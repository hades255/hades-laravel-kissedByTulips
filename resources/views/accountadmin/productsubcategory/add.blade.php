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
                        <li class="breadcrumb-item active"><a href="/accountadmin/products-sub-categories">Product Sub Category</a></li>
                    </ol>
                    <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white" style="margin-top:-34px;"><i class="fa fa-plus-circle"></i>{{ isset($productSubCategory) && ($productSubCategory->pk_product_sub_category) ? 'Edit Product Sub Category':'Create New Product Sub Category'}} </button>
                </div>
            </div>
        </div>
        <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title" style="text-align: center;">{{ isset($productSubCategory) && ($productSubCategory->pk_product_sub_category) ? 'Edit Product Sub Category':'Create New Product Sub Category'}}</h4>
                                <div class="tab-content br-n pn">
                                    <div id="navpills-1" class="tab-pane active">
                                        <div class="row">
                                          @if(Session::has('message'))
                                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                                          @endif
                                          <form class="form-horizontal mt-4 " method="post" action="/accountadmin/product-sub-category/submit" style="margin-left: 540px;">
                                            @csrf
                                            <div class="form-group">
                                                <label for="product_category">Product Category</label>
                                                <select class="form-select col-12" name="product_category" class="form-control @error('pk_product_category') is-invalid @enderror">
                                                    <option value="">Select Product Category</option>
                                                    @foreach($product_categories as $product_category)
                                                        <option value="{{ $product_category->pk_product_category }}" {{ old('pk_product_category') == $product_category->pk_product_category || isset($productCategory) && ($productCategory->pk_product_category == $product_category->pk_product_category)? 'selected':''}}>{{$product_category->product_category}}</option>
                                                    @endforeach
                                                </select>
                                                @error('product_category')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="product_sub_category">Product Sub Category</label>
                                                <input type="text" name="product_sub_category" class="form-control @error('product_sub_category') is-invalid @enderror" value="{{ isset($productCategory) && ($productCategory->product_sub_category) ?$productCategory->product_sub_category: old('product_sub_category')}}">
                                                @error('product_sub_category')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ isset($productCategory) && ($productCategory->description) ?$productCategory->description: old('description')}}">
                                                @error('description')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Active</label>
                                                    <input type="radio" name="active"  value="1" checked="checked" class="form-check-input" >
                                                    <label class="form-check-label" for="customRadio11" style="margin-left: 20px;">Yes</label>
                                                    <input type="radio" name="active" value="0" {{ isset($productCategory) && ($productCategory->active=="0")? "checked" : "" }}  class="form-check-input">
                                                    <label class="form-check-label" for="customRadio22" style="margin-left: 20px;">No</label>
                                            </div>
                                            <input type="hidden" name="pk_account" value="{{isset($account) ? $account : ''}}" >
                                            <input type="hidden" name="pk_product_sub_category" value="{{ isset($productCategory) && ($productCategory->pk_product_sub_category) ?$productCategory->pk_product_sub_category : ''}}" >
                                            <a href="/accountadmin/product-sub-category/back"><input class="btn btn-primary" type="button" value="Cancel"></a>
                                            <input class="btn btn-primary" type="submit" value="{{ isset($productSubCategory) && ($productSubCategory->pk_product_sub_category)? "Update" : "Submit" }}">
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
