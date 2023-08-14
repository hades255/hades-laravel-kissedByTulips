@extends('layouts.backend_new')

@section('content')


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>

<!--- calendar !---->

<script src="https://demos.codexworld.com/php-event-calendar-using-fullcalendar-javascript-library/js/sweetalert2.all.min.js"></script>
<link href="https://demos.codexworld.com/3rd-party/fullcalendar-5.11.0/lib/main.css" rel="stylesheet" />
<script src="https://demos.codexworld.com/3rd-party/fullcalendar-5.11.0/lib/main.js"></script>

<?php
$pk_location_types = !empty($locationtype->pk_location_types)?$locationtype->pk_location_types:$session_id; ?>

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
                    <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i class="fa fa-plus-circle"></i>{{ isset($locationtype) && ($locationtype->pk_location_types) ? 'Edit Location Type':'Create New Location Type'}} </button>
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
                                <h4 class="card-title">{{ isset($locationtype) && ($locationtype->pk_location_types) ? 'Edit Location Type':'Create New Location Type'}}</h4>
                                
                                
                                <ul class="nav nav-tabs customtab" role="tablist">
                                    <li class="nav-item"> <a class="nav-link active" data-bs-toggle="tab" href="#locationlist" role="tab" aria-selected="true"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Location</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#operationalhours" role="tab" aria-selected="false"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Operational Hours</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#calendarnew" role="tab" aria-selected="false"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Calendar</span></a> </li>
                                </ul> 


                                <form class="form-horizontal mt-4 " method="post" action="/accountadmin/location-types/submit">
                                    @csrf
                                
                                    <div class="tab-content"> 

                                        <div class="tab-pane p-20 active" id="locationlist" role="tabpanel">
    
                                            <div class="row">   
                                            
                                                <div class="form-group">
                                                    <label for="styles">Location Type</label>
                                                    <input type="text" name="location_types" class="form-control @error('location_types') is-invalid @enderror" value="{{ isset($locationtype) && ($locationtype->location_types) ?$locationtype->location_types: old('location_types')}}">
                                                    @error('location_types')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="description">Description</label>
                                                    <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ isset($locationtype) && ($locationtype->description) ?$locationtype->description: old('description')}}">
                                                    @error('description')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Active</label>
                                                        <input type="radio" name="active"  value="1" checked="checked" class="form-check-input" style="margin-left: 20px;">
                                                        <label class="form-check-label" for="customRadio11">Yes</label>
                                                        <input type="radio" name="active" value="0" {{ isset($locationtype) && ($locationtype->active=="0")? "checked" : "" }}  class="form-check-input" style="margin-left: 20px;">
                                                        <label class="form-check-label" for="customRadio22">No</label>
                                                </div>
                                                <input type="hidden" name="pk_account" value="{{isset($pk_account) ? $pk_account : ''}}" >
                                                <input type="hidden" name="session_id" value="{{isset($session_id) ? $session_id : ''}}" >
                                                <input type="hidden" name="pk_location_types" value="{{ isset($locationtype) && ($locationtype->pk_location_types) ?$locationtype->pk_location_types : ''}}" >
                                            </div>
                                        </div>


                                        <div class="tab-pane p-20" id="operationalhours" role="tabpanel">
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

                                                        /*
                                                        $timestamp = strtotime('next Monday');
                                                        $days = array();
                                                        for ($i = 0; $i < 7; $i++) {
                                                            $days[] = strftime('%A', $timestamp);
                                                            $timestamp = strtotime('+1 day', $timestamp);
                                                        } */
                                                        //echo '<pre>'; print_r($days); die; ?>
                                                        @foreach($weekOfdays as $key=>$value) <?php
                                                        //echo '<pre>'; print_r($value); die; ?>
                                                            <tr>
                                                                <td class="text-center">
                                                                    {!! $value['name'] !!}
                                                                    <input type="hidden" name="start[]" class="form-control" value="{!! date('Y-m-d',strtotime($value['date'])) !!}">
                                                                    <input type="hidden" name="day[]" class="form-control" value="{!! date('l',strtotime($value['date'])) !!}">
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
                                            <a href="/accountadmin/location-types/back"><input class="btn btn-primary" type="button" value="Cancel"></a>
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
    events: '{!! route('accountadmin.location-types.calendar',$pk_location_types) !!}',
    
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
        '<input type="radio" name="activeval" id="customRadio22" value="0" class="form-check-input" style="margin-left: 20px;">' +
        '<label class="form-check-label" for="customRadio22">Close</label>' +
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
          body: JSON.stringify({ request_type:'add', start:start.startStr, end:start.endStr, form_data: formValues, pk_location_types:'{!! $pk_location_types !!}'}),
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

      //console.log(info.event);
      
      // change the border color
      info.el.style.borderColor = 'red';
      
      Swal.fire({
        title: info.event.day,
        icon: 'info',
        html:'<p>'+info.event.extendedProps.start_val+' ('+info.event.extendedProps.day+')</p><p>'+info.event.extendedProps.open_time_val+' to '+info.event.extendedProps.close_time_val+'</p><p>'+info.event.extendedProps.open_status+'</p>',
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
            if(info.event.extendedProps.active_val=='No') {
                checked_val = 'checked';
                checked_val_1 = '';
            }


          // Edit and update event
          Swal.fire({
            title: 'Edit Calendar',
            html:

            '<div class="form-group"><label for="styles">Open Time</label><input type="time" id="opentime"  value="'+info.event.extendedProps.open_time_edit+'" name="opentime" class="form-control"></div>' +
            '<div class="form-group"><label for="styles">Close Time</label><input type="time" id="closetime"  value="'+info.event.extendedProps.close_time_edit+'" name="closetime" class="form-control"></div>' +
            '<div class="form-group"><label class="form-label">Active</label>' +
            '<input type="radio" name="activeval" id="customRadio11"  value="1" '+checked_val_1+' class="form-check-input" style="margin-left: 20px;">' +
            '<label class="form-check-label" for="customRadio11">Open</label>' +
            '<input type="radio" name="activeval" id="customRadio22" value="0" '+checked_val+' class="form-check-input" style="margin-left: 20px;">' +
            '<label class="form-check-label" for="customRadio22">Close</label>' +
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
                body: JSON.stringify({ request_type:'editCalendar', start:info.event.startStr, end:info.event.endStr, event_id: info.event.id, form_data: result.value, pk_location_types:'{!! $pk_location_types !!}'})
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

@endsection