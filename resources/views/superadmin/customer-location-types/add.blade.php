@extends('layouts.dashboard')

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
                        <li class="breadcrumb-item active"><a href="/superadmin/customer-location-types">Customer Location Type</a></li>
                    </ol>
                    <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i class="fa fa-plus-circle"></i>{{ isset($customerlocationtype) && ($customerlocationtype->pk_customer_location_types) ? ' Edit Customer Location Type':' Create Customer Location Type'}} </button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ isset($customerlocationtype) && ($customerlocationtype->pk_customer_location_types) ? 'Edit Customer Location Type':'Create Customer Location Type'}}</h4>
                        <div class="tab-content br-n pn">
                            <div id="navpills-1" class="tab-pane active">
                                <div class="row">
                                    @if(Session::has('message'))
                                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                                    @endif
                                    <form class="form-horizontal mt-4 " method="post" action="/superadmin/customer-location-types/submit">
                                        @csrf
                                        <div class="row">


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="pk_product_sub_category">Location Type</label>
                                                    <select class="form-select col-12 location-types @error('pk_location_types') is-invalid @enderror" name="pk_location_types">
                                                        <option value="">Select Location Type</option>
                                                        @if(!empty($location_types))
                                                            @foreach($location_types as $key=>$value)
                                                                <option value="{!! $key !!}" {!! isset($data) && ($data->pk_location_types == $key)? 'selected':'' !!}>{!! $value !!}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @error('pk_location_types')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="pk_location_times">Location Time</label>
                                                    <select class="form-select col-12 location-times-cls @error('pk_location_times') is-invalid @enderror" name="pk_location_times">
                                                        <option value="">Select Location Time</option>
                                                        @if(!empty($location_times))
                                                            @foreach($location_times as $val)
                                                                <option value="{!! $val->pk_location_times !!}" {{  isset($data) && ($data->pk_location_times == $val->pk_location_times)? 'selected':''}}>{!! $val->day.'- '.date('h:i A',strtotime($val->open_time)).' to '.date('h:i A',strtotime($val->close_time)) !!}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @error('pk_location_times')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>  -->

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="styles">Customer Location Type</label>
                                                    <input type="text" name="customer_location_types" class="form-control @error('customer_location_types') is-invalid @enderror" value="{!! !empty($data->customer_location_types)?$data->customer_location_types:old('customer_location_types') !!}">
                                                    @error('customer_location_types')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="description">Description</label>
                                                    <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{!! !empty($data->description)?$data->description:old('description') !!}">
                                                    @error('description')
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
                                                    <label class="form-label">Active</label>
                                                    <input type="radio" id="customRadio11" name="active"  value="1" checked="checked" class="form-check-input" style="margin-left: 20px;">
                                                    <label class="form-check-label" for="customRadio11">Yes</label>
                                                    <input type="radio" id="customRadio22" name="active" value="0" {{ isset($data) && ($data->active=="0")? "checked" : "" }}  class="form-check-input" style="margin-left: 20px;">
                                                    <label class="form-check-label" for="customRadio22">No</label>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" name="pk_customer_location_types" value="{!! !empty($data->pk_customer_location_types) ?$data->pk_customer_location_types : '' !!}" >
                                        <a href="/superadmin/customer-location-types"><input class="btn btn-primary" type="button" value="Cancel"></a>
                                        <input class="btn btn-primary" type="submit" value="{!! !empty($data->pk_customer_location_types)? "Update" : "Submit" !!}">
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

<script type="text/javascript">

    $(document).ready(function(){

        $(".location-types").change(function(){
            let getval = $( ".location-types option:selected" ).text();
            $.ajax({
                url: "/superadmin/customer-location-types/times?id=" + $(this).val(),
                method: 'GET',
                success: function(data) {
                    $('.location-times-cls').html(data.html);
                }
            });
        });

    });
</script>
@endsection
