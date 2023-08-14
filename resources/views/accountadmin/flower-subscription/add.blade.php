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
                        <li class="breadcrumb-item"><a href="/superadmin">Home</a></li>
                        <li class="breadcrumb-item active"><a href="/accountadmin/flower-subscription">Flower Subscription</a></li>
                    </ol>
                    <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white" style="margin-top:-34px;"><i class="fa fa-plus-circle" ></i> {{isset($flowerSubscription) && ($flowerSubscription->pk_flower_subscription) ? 'Edit Flower Subscription' : 'Create New Flower Subscription'}}</button>
                </div>
            </div>
        </div>
        <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title" style="text-align: center;">{{isset($flowerSubscription) && ($flowerSubscription->pk_flower_subscription) ? 'Edit Flower Subscription' : 'Create New Flower Subscription'}}</h4>
                                <div class="tab-content br-n pn">
                                    <div id="navpills-1" class="tab-pane active">
                                        <div class="row">
                                          @if(Session::has('message'))
                                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                                          @endif
                                          <form class="form-horizontal mt-4 " style="margin-left: 540px;" method="post" action="{{isset($flowerSubscription) && ($flowerSubscription->pk_flower_subscription) ? '/accountadmin/flower-subscription/update' : '/accountadmin/flower-subscription/submit'}}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                            <label for="frequency">Select Frequency</label>
                                              <select class="form-control form-select" name="frequency">
                                                <option value="">--Select--</option>
                                                @foreach($frequencies as $frequency)
                                                <option value="{{$frequency->pk_frequency}}" {{ isset($flowerSubscription) && ($flowerSubscription->pk_frequency  == $frequency->pk_frequency) ? 'selected' : '' }}>{{$frequency->frequency}}</option>
                                                @endforeach
                                               </select>
                                                @error('frequency')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                              </div>
                                            <div class="form-group">
                                                <label for="price">Price</label>
                                                <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" value="{{isset($flowerSubscription) && ($flowerSubscription->price)?$flowerSubscription->price:''}}">
                                                @error('price')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                            <label for="frequency">Select Unit of Measure</label>
                                              <select class="form-control form-select" name="uom">
                                                <option value="">--Select--</option>
                                                @foreach($uoms as $uom)
                                                <option value="{{$uom->pk_uom}}" {{ isset($flowerSubscription) && ($flowerSubscription->pk_uom  == $uom->pk_uom) ? 'selected' : '' }}>{{$uom->uom}}</option>
                                                @endforeach
                                               </select>
                                                @error('uom')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                              </div>
                                            <div class="form-group">
                                                <label for="image">Upload Flower Image</label>
                                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                                @error('image')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                @if(isset($flowerSubscription) && ($flowerSubscription->path))
                                                <img src = "/flower-subscription/{{$flowerSubscription->path}}" height="60" width="60">
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{isset($flowerSubscription) && ($flowerSubscription->description)?$flowerSubscription->description:''}}">
                                                @error('description')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Active</label>
                                                    <input type="radio" name="active"  value="1" checked="checked" class="form-check-input">
                                                    <label class="form-check-label" for="customRadio11" style="margin-left: 20px;">Yes</label>
                                                    <input type="radio" name="active" value="0" {{ isset($flowerSubscription) && ($flowerSubscription->active=="0")? "checked" : "" }} class="form-check-input">
                                                    <label class="form-check-label" for="customRadio22" style="margin-left: 20px;">No</label>
                                            </div>
                                            <input type="hidden" name="pk_flower_subscription" class="form-control" value="{{isset($flowerSubscription) && ($flowerSubscription->pk_flower_subscription)?$flowerSubscription->pk_flower_subscription:''}}">
                                            <a href="/accountadmin/flower-subscription/back"><input class="btn btn-primary" type="button" value="Cancel"></a>
                                            <input class="btn btn-primary" type="submit" value="{{isset($flowerSubscription) && ($flowerSubscription->pk_flower_subscription)?'Update':'Submit'}}">
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
