@extends('layouts.backend_new')

@section('content')



<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
 
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
                        <li class="breadcrumb-item active"><a href="/accountadmin/location-types">Location Type</a></li>
                    </ol> 
                </div>
            </div>
        </div>
        <div class="row">
                    <div class="col-md-12"> 
                                        
                        <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" href="/accountadmin/location-types">Location</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" href="{!! !empty($locationtype->pk_location_types)?'/accountadmin/location-types/time/'.$locationtype->pk_location_types:'javascript:void(0)' !!}">Operational Hours</a>
                            </li> 
                        </ul>  

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Locations ({!! $locationtype->location_types !!})</h4>
                                <div class="tab-content br-n pn">
                                    <div id="navpills-1" class="tab-pane active">
                                        <div class="row">
                                          @if(Session::has('message'))
                                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                                          @endif
                                          <form class="form-horizontal mt-4 " method="post">
                                            @csrf

                                            <div class="row">


                                                <div class="table-responsive m-t-40">
                                                    <table class="display nowrap table table-hover table-striped "
                                                        cellspacing="0" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th class="col-md-3 text-center">Day</th> 
                                                                <th class="col-md-3 text-center">Open Time</th> 
                                                                <th class="col-md-3 text-center">Close Time</th> 
                                                                <th class="col-md-3 text-center">All Day</th> 
                                                            </tr>
                                                        </thead>
                                                        <tbody><?php

                                                        $timestamp = strtotime('next Monday');
                                                        $days = array();
                                                        for ($i = 0; $i < 7; $i++) {
                                                            $days[] = strftime('%A', $timestamp);
                                                            $timestamp = strtotime('+1 day', $timestamp);
                                                        }
                                                        //echo '<pre>'; print_r($days); die; ?>
                                                        @foreach($days as $key=>$value)
                                                            <tr>
                                                                <td class="text-center">
                                                                    {!! $value !!}
                                                                    <input type="hidden" name="day[]" class="form-control" value="{!! $value !!}">
                                                                </td> 
                                                                <td class="text-center">
                                                                        
                                                                    <div class="form-group">
                                                                        <div class="input-group date" id="id_startTime{!! $key !!}" data-target-input="nearest">
                                                                            <input value="{!! !empty($locationtimes[$key]->open_time)?date('h:i A',strtotime($locationtimes[$key]->open_time)):'' !!}" type="text" autocomplete="off" name="open_time[]" id="id_startTime{!! $key !!}" data-target="#id_startTime{!! $key !!}" data-toggle="datetimepicker" class="form-control datetimepicker-input" data-target="#id_startTime{!! $key !!}"/>
                                                                        </div>
                                                                    </div> 
                                                                </td>  
                                                                <td class="text-center">

                                                                    <div class="form-group">
                                                                        <div class="input-group date" id="id_endTime{!! $key !!}" data-target-input="nearest">
                                                                            <input value="{!! !empty($locationtimes[$key]->close_time)?date('h:i A',strtotime($locationtimes[$key]->close_time)):'' !!}" type="text" autocomplete="off" name="close_time[]" id="id_endTime{!! $key !!}" data-target="#id_endTime{!! $key !!}" data-toggle="datetimepicker" class="form-control datetimepicker-input" data-target="#id_endTime{!! $key !!}"/>
                                                                             
                                                                        </div>
                                                                    </div> 
                                                                </td>   
                                                                <td class="text-center"> 
                                                                    <input type="checkbox" {!! !empty($locationtimes[$key]->active)?'checked':'' !!} value="1" name="all_day[{!! $key !!}]" class="form-check-input">
                                                                </td> 
                                                            </tr>

                                                            <script type="text/javascript">

                                                                $('#id_startTime{!! $key !!}').datetimepicker({
                                                                    format: 'LT'
                                                                });
                                                                $('#id_endTime{!! $key !!}').datetimepicker({
                                                                    format: 'LT'
                                                                }); 

                                                                $('#id_startTime{!! $key !!}').on("change.datetimepicker", function (e) {
                                                                    if(e.date){
                                                                        $('#id_endTime{!! $key !!}').datetimepicker(e.date.add(60, 'm'));
                                                                    }
                                                                    $('#id_endTime{!! $key !!}').datetimepicker('minDate', e.date)
                                                                });
                                                            </script>

                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div style="text-align: right;" class="col-md-12">
                                                    <input class="btn btn-primary" type="submit" value="{{ isset($locationtype) && ($locationtype->pk_location_types)? "Update" : "Submit" }}">
                                                </div>
                                            
                                            </div>
                                            
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
