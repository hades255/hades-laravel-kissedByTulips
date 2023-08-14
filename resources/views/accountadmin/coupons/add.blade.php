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
                        <li class="breadcrumb-item active"><a href="/accountadmin/coupons">Coupon Code</a></li>
                    </ol>
                    <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white" style="margin-top:-34px;"><i class="fa fa-plus-circle"></i>{{ isset($data) && ($data->pk_coupons) ? 'Edit Coupon Code':'Create Coupon Code'}} </button>
                </div>
            </div>
        </div>
        <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title" style="text-align:center;">{{ isset($data) && ($data->pk_coupons) ? 'Edit Coupon Code':'Create Coupon Code'}}</h4>
                                <div class="tab-content br-n pn">
                                    <div id="navpills-1" class="tab-pane active">
                                        <div class="row">
                                          @if(Session::has('message'))
                                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                                          @endif
                                          <form style="margin-left:500px;" class="form-horizontal mt-4 " method="post" action="/accountadmin/coupons/submit" enctype="multipart/form-data">
                                            @csrf

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="title">Title</label>
                                                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ isset($data) && ($data->title) ?$data->title: old('title')}}">
                                                        @error('title')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="code">Code</label>
                                                        <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" value="{{ isset($data) && ($data->code) ?$data->code: old('code')}}">
                                                        @error('code')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="type">Type</label>
                                                        <select class="form-select col-12 @error('type') is-invalid @enderror" name="type">
                                                            <option value="">Select Type</option>
                                                            <option {{ old('type') == 'fixed' || isset($data) && ($data->type == 'fixed')? 'selected':''}} value="fixed">Fixed</option>
                                                            <option {{ old('type') == 'percent' || isset($data) && ($data->type == 'percent')? 'selected':''}} value="percent">Percent</option>
                                                        </select>
                                                        @error('type')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="discount_amount">Amount</label>
                                                        <input type="text" name="discount_amount" class="form-control @error('discount_amount') is-invalid @enderror" value="{{ isset($data) && ($data->discount_amount) ?$data->discount_amount: old('discount_amount')}}">
                                                        @error('discount_amount')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="start_at">Start Date</label>
                                                        <input type="text" name="start_at" class="form-control start-date @error('start_at') is-invalid @enderror" value="{{ isset($data) && ($data->start_at) ?$data->start_at: old('start_at')}}">
                                                        @error('start_at')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="expire_at">Expire Date</label>
                                                        <input type="text" name="expire_at" class="form-control expire-date @error('expire_at') is-invalid @enderror" value="{{ isset($data) && ($data->expire_at) ?$data->expire_at: old('expire_at')}}">
                                                        @error('expire_at')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>


                                            <div class="row">


                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="quantity">Quantity</label>
                                                        <input type="text" name="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{ isset($data) && ($data->quantity) ?$data->quantity: old('quantity')}}">
                                                        @error('quantity')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <input type="hidden" name="pk_account" value="{{auth()->user()->pk_account}}">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Active</label>
                                                        <input type="radio" name="active"  value="1" id="customRadio11" checked="checked" class="form-check-input">
                                                        <label class="form-check-label" for="customRadio11" style="margin-left: 20px;">Yes</label>
                                                        <input type="radio" name="active" value="0" id="customRadio22" {{ isset($data) && ($data->active=="0")? "checked" : "" }}  class="form-check-input" >
                                                        <label class="form-check-label" for="customRadio22" style="margin-left: 20px;">No</label>
                                                    </div>
                                                </div>
                                            </div>


                                            <input type="hidden" name="pk_coupons" value="{{ isset($data) && ($data->pk_coupons) ?$data->pk_coupons : ''}}" >
                                             <input class="btn btn-primary" type="submit" value="{{ isset($data) && ($data->pk_coupons)? "Update" : "Submit" }}">
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

<!-- Datepicker -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript">
    $(function () {
        $(".start-date").datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd'
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date);
            minDate.setDate(minDate.getDate() + 1);
            $('.expire-date').datepicker('setStartDate', minDate);
        });

        $(".expire-date").datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd'
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date);
            minDate.setDate(minDate.getDate() - 1);
            $('.start-date').datepicker('setEndDate', minDate);
        });
    });
</script>


@endsection
