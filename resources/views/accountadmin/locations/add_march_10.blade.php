@extends('layouts.dashboard')

@section('content')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>

<!--- calendar !---->

<script src="https://demos.codexworld.com/php-event-calendar-using-fullcalendar-javascript-library/js/sweetalert2.all.min.js"></script>
<link href="https://demos.codexworld.com/3rd-party/fullcalendar-5.11.0/lib/main.css" rel="stylesheet" />
<script src="https://demos.codexworld.com/3rd-party/fullcalendar-5.11.0/lib/main.js"></script>

<?php
$pk_locations = !empty($getLocation->pk_locations)?$getLocation->pk_locations:$session_id; ?>

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
                      <li class="breadcrumb-item active"><a href="/accountadmin/locations">Location</a></li>
                    </ol>
                    <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i class="fa fa-plus-circle"></i> Create New Location</button>
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
                                <h4 class="card-title">{{ isset($getLocation) && ($getLocation->pk_locations) ? 'Edit Location':'Create New Location'}}</h4>

                                <ul class="nav nav-tabs customtab" role="tablist">
                                    <li class="nav-item"> <a class="nav-link active" data-bs-toggle="tab" href="#locationlist" role="tab" aria-selected="true"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Location</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#operationalhours" role="tab" aria-selected="false"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Operational Hours</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#calendarnew" role="tab" aria-selected="false"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Calendar</span></a> </li>
                                </ul>

                                <form class="form-horizontal mt-4 " method="post" action="{{isset($getLocation) && ($getLocation->pk_locations) ? '/accountadmin/locations/update' : '/accountadmin/locations/submit'}}">
                                    @csrf

                                    <div class="tab-content br-n pn">

                                        <div class="tab-pane p-20 active" id="locationlist" role="tabpanel">
                                            <div class="row">

                                                <div class="form-group">
                                                    <label for="location-types">Location Type</label>
                                                    <select class="form-select col-12" name="location_types" class="form-control @error('location_types') is-invalid @enderror">
                                                        <option value="">Select Location Type</option>
                                                        @foreach($locationTypes as $locationType)
                                                            <option value="{{ $locationType->pk_location_types }}" {{ old('pk_location_types') == $locationType->pk_location_types || isset($getLocation) && ($getLocation->pk_location_types == $locationType->pk_location_types)? 'selected':''}}>{{$locationType->location_types}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('location_types')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="location_name">Location Name</label>
                                                    <input type="text" name="location_name" class="form-control @error('location_name') is-invalid @enderror" value="{{ isset($getLocation) && ($getLocation->location_name) ? $getLocation->location_name : old('location_name')}}">
                                                    @error('location_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="location_name">Location Code</label>
                                                    <input type="text" name="location_code" class="form-control @error('location_code') is-invalid @enderror" value="{{ isset($getLocation) && ($getLocation->location_code) ? $getLocation->location_code : old('location_code')}}">
                                                    @error('location_code')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class ="row">
                                                <div class ="col-md-6">
                                                <div class="form-group">
                                                    <label for="location_name">Address</label>
                                                    <input type="text" name="address" id="autocomplete" class="form-control @error('address') is-invalid @enderror" value="{{ isset($getLocation) && ($getLocation->address) ? $getLocation->address : old('address')}}">
                                                    @error('address')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                </div>
                                                <div class ="col-md-6">
                                                <div class="form-group">
                                                    <label for="location_name">Ste#</label>
                                                    <input type="text" name="address_1" id="street_number" class="form-control @error('address_1') is-invalid @enderror" value="{{ isset($getLocation) && ($getLocation->address_1) ? $getLocation->address_1 : old('address_1')}}" maxlength="10">
                                                    @error('address_1')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            </div>
                                            <div class ="row">
                                                <div class ="col-md-4">
                                                <div class="form-group">
                                                    <label for="location_name">City</label>
                                                    <input type="text" name="city" id="locality" class="form-control @error('city') is-invalid @enderror" value="{{ isset($getLocation) && ($getLocation->city) ? $getLocation->city : old('city')}}">
                                                    @error('city')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                </div>
                                                <div class ="col-md-4">
                                                <div class="form-group">
                                                    <label for="location_name">Zip</label>
                                                    <input type="text" name="zip" id="postal_code" class="form-control @error('zip') is-invalid @enderror" value="{{ isset($getLocation) && ($getLocation->zip) ? $getLocation->city : old('zip')}}">
                                                    @error('zip')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                </div>
                                                <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">State</label>
                                                    <input id="administrative_area_level_1" type="text" name="state_name" class="form-control" value ="{{isset($getLocation) && ($getLocation->state_name) ? $getLocation->state_name : old('state_name')}}">
                                                </div>
                                                </div>
                                                <!-- <div class ="col-md-4">
                                                <div class="form-group">
                                                    <label for="role">State</label>
                                                    <select name="pk_states" id="pk_states" class="form-control @error('pk_states') is-invalid @enderror">
                                                        <option value="">Choose...</option>
                                                        @foreach($states as $state)
                                                            <option value="{{ $state->pk_states }}" {{ isset($getLocation) && ($getLocation->pk_states  == $state->pk_states) ? 'selected' : '' }}>{{ $state->state_code }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('pk_states')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div> -->
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label">Country</label>
                                                <input id="country" type="text" name="country_name" class="form-control" value ="{{isset($getLocation) && ($getLocation->country_name) ? $getLocation->country_name : old('country_name')}}">
                                            </div>

                                            <!-- <div class="form-group">
                                                <label for="role">Country</label>
                                                <select name="pk_country" id="pk_country" class="form-control @error('pk_country') is-invalid @enderror" >
                                                    <option value="">Choose...</option>
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->pk_country }}" {{ isset($getLocation) && ($getLocation->pk_country  == $country->pk_country) ? 'selected' : '' }}>{{ $country->country_code }}</option>
                                                    @endforeach
                                                </select>
                                                @error('pk_country')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div> -->
                                            <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="role">Timezone</label>
                                                    <select name="pk_timezone" id="pk_timezone" class="form-control @error('pk_timezone') is-invalid @enderror" >
                                                        <option value="">Choose...</option>
                                                        @foreach($timezones as $timezone)
                                                            <option value="{{ $timezone->pk_timezone }}" {{ isset($getLocation) && ($getLocation->pk_timezone  == $timezone->pk_timezone) ? 'selected' : '' }}>{{ $timezone->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('pk_timezone')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                              </div>
                                                <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="role">Tax Rate</label>
                                                    <input type="number" step=0.01 name="tax_rate" class="form-control" placeholder="Tax Rate" value="{{isset($getLocation) && ($getLocation->tax_rate) ? $getLocation->tax_rate : ''}}">
                                                    @error('tax_rate')
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
                                                        <label class="form-label" id="customerlabelLat">Lat: <span id="latLab">{{isset($getLocation) && ($getLocation->lat) ? $getLocation->lat : ''}}</span></label>
                                                        {{-- @if(isset($getLocation) && ($getLocation->lat)) --}}
                                                        <input type="hidden" id="lat_value" name="lat" value="{{isset($getLocation) && ($getLocation->lat) ? $getLocation->lat : ''}}">
                                                        {{-- @endif --}}
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label class="form-label" id="customerlabelLng">Lng: <span id="lngLab">{{isset($getLocation) && ($getLocation->lng) ? $getLocation->lng : ''}}</span></label>
                                                        {{-- @if(isset($getLocation) && ($getLocation->lng)) --}}
                                                        <input type="hidden" id="lng_value" name="lng" value="{{isset($getLocation) && ($getLocation->lng) ? $getLocation->lng : ''}}">
                                                    {{-- @endif --}}
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Active</label>
                                                        <input type="radio" name="active"  value="1" checked="checked" class="form-check-input" style="margin-left: 20px;">
                                                        <label class="form-check-label" for="customRadio11">Yes</label>
                                                        <input type="radio" name="active" value="0" {{ isset($getLocation) && ($getLocation->active=="0")? "checked" : "" }} class="form-check-input" style="margin-left: 20px;">
                                                        <label class="form-check-label" for="customRadio22">No</label>
                                                </div>
                                                <input type="hidden" name="session_id" value="{{isset($session_id) ? $session_id : ''}}" >
                                                <input type="hidden" name="pk_locations" class="form-control" value="{{isset($getLocation) && ($getLocation->pk_locations)?$getLocation->pk_locations:''}}">
                                                @if(isset($getLocation) && ($getLocation->pk_account))
                                                <input type="hidden" name="pk_account" class="form-control" value="{{isset($getLocation) && ($getLocation->pk_account) ? $getLocation->pk_account :''}}">
                                                @else
                                                <input type="hidden" name="pk_account" class="form-control" value="{{isset($account) && !empty($account) ? $account->pk_account:''}}">
                                                @endif

                                            </div>
                                        </div>

                                        <div class="tab-pane p-20" id="operationalhours" role="tabpanel">
                                            <div class="row">

                                                <div class="table-responsive m-t-40">
                                                    <table class="display nowrap table table-hover table-striped "
                                                        cellspacing="0" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th class="col-md-2 text-center">Day</th>
                                                                <th class="col-md-2 text-center">Open Time</th>
                                                                <th class="col-md-2 text-center">Close Time</th>
                                                                <th class="col-md-3 text-center">All Day</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody><?php



                                                        /*
                                                        $timestamp = strtotime('next Monday');
                                                        $days = array();
                                                        for ($i = 0; $i < 7; $i++) {
                                                            $days[] = strftime('%A', $timestamp);
                                                            $timestamp = strtotime('+1 day', $timestamp);
                                                        } */
                                                        //echo '<pre>'; print_r($days); die; ?>
                                                        @foreach($weekOfdays as $key=>$value) <?php

                                                            $get_setting_data = App\LocationTime::get_time_data($pk_locations,date('Y-m-d',strtotime($value['date'])));
                                                         //echo '<pre>'; print_r($get_setting_data); die; ?>
                                                            <tr>
                                                                <td class="text-center">
                                                                    {{-- {!! $value['name'] !!} --}}
                                                                    {!! date('l',strtotime($value['date'])) !!}
                                                                    <input type="hidden" name="start[]" class="form-control" value="{!! date('Y-m-d',strtotime($value['date'])) !!}">
                                                                    <input type="hidden" name="day[]" class="form-control" value="{!! date('l',strtotime($value['date'])) !!}">
                                                                </td>
                                                                <td class="text-center">

                                                                    <div class="form-group">
                                                                        <div class="input-group date" id="id_startTime{!! $key !!}" data-target-input="nearest">
                                                                            <input value="{!! !empty($get_setting_data->open_time)?date('h:i A',strtotime($get_setting_data->open_time)):'' !!}" type="text" autocomplete="off" name="open_time[]" id="id_startTime{!! $key !!}" data-target="#id_startTime{!! $key !!}" data-toggle="datetimepicker" class="form-control datetimepicker-input class_startTime{!! $key !!}" data-target="#id_startTime{!! $key !!}"/>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="text-center">

                                                                    <div class="form-group">
                                                                        <div class="input-group date" id="id_endTime{!! $key !!}" data-target-input="nearest">
                                                                            <input value="{!! !empty($get_setting_data->close_time)?date('h:i A',strtotime($get_setting_data->close_time)):'' !!}" type="text" autocomplete="off" name="close_time[]" id="id_endTime{!! $key !!}" data-target="#id_endTime{!! $key !!}" data-toggle="datetimepicker" class="form-control datetimepicker-input" data-target="#id_endTime{!! $key !!}"/>

                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="text-center">
                                                                    <input type="checkbox" {!! !empty($get_setting_data->all_day)?'checked':'' !!} value="1" name="all_day[{!! $key !!}]" class="form-check-input">
                                                                </td>
                                                            </tr>

                                                            <script type="text/javascript">

                                                                /*$('.class_startTime{!! $key !!}').click(function(){
                                                                    var get_val = $(this).val();
                                                                    if(get_val == ''){
                                                                        $(this).val("09:00");
                                                                    }
                                                                });*/

                                                                $('#id_startTime{!! $key !!}').datetimepicker({
                                                                    format: 'LT',
                                                                    //useCurrent:false,
                                                                    //useCurrent:false,
                                                                    //todayHighlight: false
                                                                });
                                                                $('#id_endTime{!! $key !!}').datetimepicker({
                                                                    format: 'LT'
                                                                    //useCurrent:false,
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

                                            </div>

                                        </div>

                                        <div class="tab-pane p-20 calendar-cls-a active" id="calendarnew" role="tabpanel">
                                            <div class="row">

                                                <div id="col-md-12">
                                                    <div id="calendar"></div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-12 m-l-20">
                                            <a href="/accountadmin/locations/back"><input class="btn btn-primary" type="button" value="Cancel"></a>
                                            <input class="btn btn-primary" type="submit" value="Submit">
                                        </div>
                                    </div>

                                </form>

                            </div>




                        </div>
                    </div>
                </div>
    </div>
</div>

@endsection

@section('js')


<script>

$(window).on('load', function(){
    setTimeout(function() {
        $('.calendar-cls-a').removeClass('active');
    }, 2000);

});


document.addEventListener('DOMContentLoaded', function() {


  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    height: 650,
    //events: '{!! route('accountadmin.location-types.calendar',$pk_locations) !!}',
    events: function(info, successCallback, failureCallback) {

        var pk_locations = '{!! $pk_locations !!}';
        var date = new Date(info.start);
        /*var dateFormat = date.getFullYear() + "-" + (date.getMonth()+1) + "-" + date.getDate();
        console.log(dateFormat);*/
        var SITEURL = "{{ url('/') }}";
        let dateFormatdate = date.toLocaleString("default", { year: "numeric" })+"-"+date.toLocaleString("default", { month: "2-digit" })+"-"+date.toLocaleString("default", { day: "2-digit" });

        var end_date = new Date(info.end);
        let end_dateFormatdate = end_date.toLocaleString("default", { year: "numeric" })+"-"+end_date.toLocaleString("default", { month: "2-digit" })+"-"+end_date.toLocaleString("default", { day: "2-digit" });
        //console.log(dateFormatdate);
        //console.log(end_dateFormatdate);
        $.ajax({
            type: "GET",
            url: SITEURL + '/accountadmin/location-types/calendars/'+pk_locations+'?start='+dateFormatdate+'&end='+end_dateFormatdate,
            dataType: "json",
            /*data: {
              "pk_locations": pk_locations, //dynamically gets the current value of trotineta each time a request is made
              "start": dateFormatdate, //pass start and end dates to your server to allow filtering by date

            },*/
            success: function(data) {
                successCallback(data);
               //return the event data to fullCalendar
            }
          });
    },

    selectable: true,
    select: async function (start, end, allDay) {
      const { value: formValues } = await Swal.fire({
        title: 'Add New',
        confirmButtonText: 'Submit',
        showCloseButton: true,
		    showCancelButton: true,
        html:
        '<div class="form-group"><label for="styles">Open Time</label><input type="time" id="opentime" name="opentime" class="form-control" value=""></div>' +
        '<div class="form-group"><label for="styles">Close Time</label><input type="time" id="closetime" name="closetime" class="form-control" value=""></div>' +
        '<div class="form-group"><label class="form-label">Active</label>' +
        '<input type="radio" name="activeval" id="customRadio11"  value="1" checked="checked" class="form-check-input" style="margin-left: 20px;">' +
        '<label class="form-check-label" for="customRadio11">Open</label>' +
        /*'<input type="radio" name="activeval" id="customRadio22" value="0" class="form-check-input" style="margin-left: 20px;">' +
        '<label class="form-check-label" for="customRadio22">Close</label>' +*/
        '</div>',
        focusConfirm: false,
        preConfirm: () => {
          return [
            document.getElementById('opentime').value,
            document.getElementById('closetime').value,
            $("input[name=activeval]:checked").val()
          ]
        }
      });

      if (formValues) {
        // Add form
        fetch("{!! route('accountadmin.location-types.calendar_add') !!}", {
          method: "POST",
          headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),"Content-Type": "application/json" },
          body: JSON.stringify({ request_type:'add', start:start.startStr, end:start.endStr, form_data: formValues, pk_locations:'{!! $pk_locations !!}'}),
        })
        .then(response => response.json())
        .then(data => {
          if (data.status == 1) {
            Swal.fire('Calendar added successfully!', '', 'success');
          } else {
            Swal.fire(data.error, '', 'error');
          }

          // Refetch events from all sources and rerender
          calendar.refetchEvents();
        })
        .catch(console.error);
      }
    },

    eventClick: function(info) {
      info.jsEvent.preventDefault();

      var clicked_event_date = info.event.start.toLocaleString("default", { year: "numeric" })+"-"+info.event.start.toLocaleString("default", { month: "2-digit" })+"-"+info.event.start.toLocaleString("default", { day: "2-digit" });

      //console.log(info.event);

      // change the border color
      info.el.style.borderColor = 'red';

      Swal.fire({
        title: info.event.day,
        icon: 'info',
        html:'<p>'+clicked_event_date+' ('+info.event.extendedProps.day+')</p><p>'+info.event.extendedProps.open_time_val+' to '+info.event.extendedProps.close_time_val+'</p><p>'+info.event.extendedProps.open_status+'</p>',
        showCloseButton: true,
        showCancelButton: true,
        showDenyButton: true,
        cancelButtonText: 'Close',
        confirmButtonText: 'Delete',
        denyButtonText: 'Edit',
      }).then((result) => {
        if (result.isConfirmed) {
           // alert(info.event.id);
          // Delete event
          fetch("{!! route('accountadmin.location-types.calendar_add') !!}", {
            method: "POST",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),"Content-Type": "application/json" },
            body: JSON.stringify({ request_type:'deleteCalendar', event_id: info.event.id}),
          })
          .then(response => response.json())
          .then(data => {
            if (data.status == 1) {
              Swal.fire('Calendar deleted successfully!', '', 'success');
            } else {
              Swal.fire(data.error, '', 'error');
            }

            // Refetch events from all sources and rerender
            calendar.refetchEvents();
          })
          .catch(console.error);
        } else if (result.isDenied) {

            let checked_val = '';
            let checked_val_1 = 'checked';
            /*if(info.event.extendedProps.active_val=='No') {
                checked_val = 'checked';
                checked_val_1 = '';
            }*/


          // Edit and update event
          Swal.fire({
            title: 'Edit Calendar',
            html:

            '<div class="form-group"><label for="styles">Open Time</label><input type="time" id="opentime"  value="'+info.event.extendedProps.open_time_edit+'" name="opentime" class="form-control"></div>' +
            '<div class="form-group"><label for="styles">Close Time</label><input type="time" id="closetime"  value="'+info.event.extendedProps.close_time_edit+'" name="closetime" class="form-control"></div>' +
            '<div class="form-group"><label class="form-label">Active</label>' +
            '<input type="radio" name="activeval" id="customRadio11"  value="1" '+checked_val_1+' class="form-check-input" style="margin-left: 20px;">' +
            '<label class="form-check-label" for="customRadio11">Open</label>' +
            /*'<input type="radio" name="activeval" id="customRadio22" value="0" '+checked_val+' class="form-check-input" style="margin-left: 20px;">' +
            '<label class="form-check-label" for="customRadio22">Close</label>' +*/
            '</div>',
            focusConfirm: false,
            confirmButtonText: 'Submit',
            preConfirm: () => {
            return [
                document.getElementById('opentime').value,
                document.getElementById('closetime').value,
                $("input[name=activeval]:checked").val()
            ]
            }
          }).then((result) => {
            if (result.value) {
              // Edit Calendar
              fetch("{!! route('accountadmin.location-types.calendar_add') !!}", {
                method: "POST",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),"Content-Type": "application/json" },
                body: JSON.stringify({ request_type:'editCalendar', start:info.event.startStr, end:info.event.endStr, event_id: info.event.id, form_data: result.value, pk_locations:'{!! $pk_locations !!}'})
              })
              .then(response => response.json())
              .then(data => {
                if (data.status == 1) {
                  Swal.fire('Calendar updated successfully!', '', 'success');
                } else {
                  Swal.fire(data.error, '', 'error');
                }

                // Refetch events from all sources and rerender
                calendar.refetchEvents();
              })
              .catch(console.error);
            }
          });
        } else {
          Swal.close();
        }
      });
    }
  });

  calendar.render();
});

</script>

<style>
.fc-day {
	background: unset !important;
}
    </style>



  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAB80hPTftX9xYXqy6_NcooDtW53kiIH3A&libraries=places&callback=initAutocomplete" async defer></script>
  <script src="/assets/address-auto-complete.js"></script>
@endsection
