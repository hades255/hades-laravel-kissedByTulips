<?php

namespace App\Http\Controllers\Accountadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\LocationTime;
use Auth;
use DB;


class LocationTypeController extends Controller {

 

  public function calendar($pk_locations=null, Request $request){

    $location_times = DB::table('kbt_location_times')->where('pk_locations',$pk_locations)->orderBy('start','ASC')->get()->toArray();
    $location_times_excep = array_map("current", DB::table('kbt_location_times')
                            ->where('pk_locations',$pk_locations)
                            ->where('is_exception', 1)
                            ->select('start')
                            ->orderBy('start','ASC')->get()->toArray());

    $start_date = $request->get('start');
    $end_date   = $request->get('end');

    /*$current_nonths = array();
    for($i = 1; $i <=  date('t'); $i++)
    {
       // add the date to the dates array
       $date = date('Y') . "-" . date('m') . "-" . str_pad($i, 2, '0', STR_PAD_LEFT);
       $current_nonths[$date] = date('l', strtotime($date));
       //echo date('l', strtotime($date));
    }*/

    $current_nonths = array();
    function getBetweenDates($startDate, $endDate)
    {
        $rangArray = [];
            
        $startDate = strtotime($startDate);
        $endDate = strtotime($endDate);
             
        for ($currentDate = $startDate; $currentDate <= $endDate; 
                                        $currentDate += (86400)) {
                                                
            $date = date('Y-m-d', $currentDate);
            $rangArray[$date] = date('l', strtotime($date));
        }
  
        return $rangArray;
    }
    $current_nonths = getBetweenDates($start_date, $end_date);

    $arrayOfDays = array('Monday'=>1, 'Tuesday'=>2, 'Wednesday'=>3, 'Thursday'=>4, 'Friday'=>5, 'Saturday'=>6, 'Sunday'=>7);

    $keyCount = 0;
    $newArrayRet = array();
    if(!empty($location_times)) {
        foreach($location_times as $key=>$value) {

          $location_times[$key]->open_time_val = !empty($value->open_time)?date('h:i A',strtotime($value->open_time)):'---';
          $location_times[$key]->close_time_val = !empty($value->close_time)?date('h:i A',strtotime($value->close_time)):'---';

                 
          $location_times[$key]->open_time_edit = !empty($value->open_time)?date('H:i',strtotime($value->open_time)):'';
          $location_times[$key]->close_time_edit = !empty($value->close_time)?date('H:i',strtotime($value->close_time)):'';

          $location_times[$key]->start_val = !empty($value->start)?date('d-m-Y',strtotime($value->start)):'---';
          $location_times[$key]->active_val = !empty($value->active)?'Yes':'No';
          $location_times[$key]->id = $value->pk_location_times;
          $open_status = !empty($value->active)?'Open':'Close';
          $location_times[$key]->open_status = $open_status;

          //=====================================================================================
          if($location_times[$key]->day && $location_times[$key]->is_exception != 1){
            //dd($arrayOfDays[$location_times[$key]->day]);
            $keys = array_keys($current_nonths, $location_times[$key]->day);
            foreach ($keys as $keyNew => $newValue) {
              if(!in_array($newValue, $location_times_excep)){
                  //dd($value);
                  $newArrayRet[$keyCount] = (object)[];
                  //$newArrayRet[$keyNew] = $value;


                  $newArrayRet[$keyCount]->pk_location_times = $value->pk_location_times;
                  $newArrayRet[$keyCount]->pk_locations = $value->pk_locations;
                  $newArrayRet[$keyCount]->start = $value->start;
                  $newArrayRet[$keyCount]->day = $value->day;
                  $newArrayRet[$keyCount]->open_time = $value->open_time;
                  $newArrayRet[$keyCount]->close_time = $value->close_time;
                  $newArrayRet[$keyCount]->is_exception = $value->is_exception;
                  $newArrayRet[$keyCount]->active = $value->active;
                  $newArrayRet[$keyCount]->created_by = $value->created_by;
                  $newArrayRet[$keyCount]->updated_by = $value->updated_by;
                  $newArrayRet[$keyCount]->created_at = $value->created_at;
                  $newArrayRet[$keyCount]->updated_at = $value->updated_at;

                  $newArrayRet[$keyCount]->open_time_val = !empty($value->open_time)?date('h:i A',strtotime($value->open_time)):'---';
                  $newArrayRet[$keyCount]->close_time_val = !empty($value->close_time)?date('h:i A',strtotime($value->close_time)):'---';

                         
                  $newArrayRet[$keyCount]->start = $newValue;

                  $newArrayRet[$keyCount]->open_time_edit = !empty($value->open_time)?date('H:i',strtotime($value->open_time)):'';
                  $newArrayRet[$keyCount]->close_time_edit = !empty($value->close_time)?date('H:i',strtotime($value->close_time)):'';

                  $newArrayRet[$keyCount]->start_val = !empty($value->start)?date('d-m-Y',strtotime($value->start)):'---';
                  $newArrayRet[$keyCount]->active_val = !empty($value->active)?'Yes':'No';
                  $newArrayRet[$keyCount]->id = $value->pk_location_times;
                  $open_status = !empty($value->active)?'Open':'Close';
                  $newArrayRet[$keyCount]->open_status = $open_status;

                  if(!empty($value->active)) {
                    $newArrayRet[$keyCount]->title = $location_times[$key]->open_time_val.' to '.$location_times[$key]->close_time_val;
                  } else {
                    $newArrayRet[$keyCount]->title = $open_status;
                  }
                  //array_push($newArrayRet, $subAry[$keyCount]);
                  $keyCount++;
                }
              }
          }else{
              $newArrayRet[$keyCount] = (object)[];
                //$newArrayRet[$keyNew] = $value;
                $newArrayRet[$keyCount]->pk_location_times = $value->pk_location_times;
                $newArrayRet[$keyCount]->pk_locations = $value->pk_locations;
                $newArrayRet[$keyCount]->start = $value->start;
                $newArrayRet[$keyCount]->day = $value->day;
                $newArrayRet[$keyCount]->open_time = $value->open_time;
                $newArrayRet[$keyCount]->close_time = $value->close_time;
                $newArrayRet[$keyCount]->is_exception = $value->is_exception;
                $newArrayRet[$keyCount]->active = $value->active;
                $newArrayRet[$keyCount]->created_by = $value->created_by;
                $newArrayRet[$keyCount]->updated_by = $value->updated_by;
                $newArrayRet[$keyCount]->created_at = $value->created_at;
                $newArrayRet[$keyCount]->updated_at = $value->updated_at;

                $newArrayRet[$keyCount]->open_time_val = !empty($value->open_time)?date('h:i A',strtotime($value->open_time)):'---';
                $newArrayRet[$keyCount]->close_time_val = !empty($value->close_time)?date('h:i A',strtotime($value->close_time)):'---';

                       
                //$newArrayRet[$keyCount]->start = $newValue;

                $newArrayRet[$keyCount]->open_time_edit = !empty($value->open_time)?date('H:i',strtotime($value->open_time)):'';
                $newArrayRet[$keyCount]->close_time_edit = !empty($value->close_time)?date('H:i',strtotime($value->close_time)):'';

                $newArrayRet[$keyCount]->start_val = !empty($value->start)?date('d-m-Y',strtotime($value->start)):'---';
                $newArrayRet[$keyCount]->active_val = !empty($value->active)?'Yes':'No';
                $newArrayRet[$keyCount]->id = $value->pk_location_times;
                $open_status = !empty($value->active)?'Open':'Close';
                $newArrayRet[$keyCount]->open_status = $open_status;

                if(!empty($value->active)) {
                  $newArrayRet[$keyCount]->title = $location_times[$key]->open_time_val.' to '.$location_times[$key]->close_time_val;
                } else {
                  $newArrayRet[$keyCount]->title = $open_status;
                }
                //array_push($newArrayRet, $subAry[$keyCount]);
                $keyCount++;
            }
          //======================================================================================
          //echo "<pre>"; print_r($newArrayRet); exit;

          /*if($location_times[$key]->is_exception != 1){
            $location_times[$key]->daysOfWeek = [$arrayOfDays[$location_times[$key]->day]];
          }*/

          if(!empty($value->active)) {
            $location_times[$key]->title = $location_times[$key]->open_time_val.' to '.$location_times[$key]->close_time_val;
          } else {
            $location_times[$key]->title = $open_status;
          }

          
        }
    }
    echo json_encode($newArrayRet); 
  }

  public function calendar_add(Request $request){ 

    $get_pk_location_times = $request->event_id;
    $get_request_type = $request->request_type;
    if($get_request_type=='deleteCalendar') {
        DB::table('kbt_location_times')->where('pk_location_times',$get_pk_location_times)->delete();
        $output = [ 
          'status' => 1 
        ] ; 
        echo json_encode($output); 
    } else {


      $get_form_data = $request->form_data;
      $open_time = !empty($get_form_data[0])?$get_form_data[0]:'';
      $close_time = !empty($get_form_data[1])?$get_form_data[1]:'';
      if(empty($open_time) || empty($close_time)) {
        echo json_encode(['error' => 'Calendar Add request failed!']); 
      } else { 

        $get_start = $request->start;
        
        $get_pk_locations = $request->pk_locations;
        $get_day = date('l',strtotime($get_start));

        $time_update = LocationTime::where('start',$get_start)
                                    ->where('pk_locations',$get_pk_locations)
                                    ->where('is_exception', 1)
                                    ->first();

        $save_data = array();
        $save_data['pk_locations'] = $get_pk_locations;
        $save_data['start'] = $get_start;
        $save_data['day'] = $get_day;
        $save_data['is_exception'] = 1;
        $save_data['open_time'] = !empty($open_time)?date('H:i:s',strtotime($open_time)):null;
        $save_data['close_time'] = !empty($close_time)?date('H:i:s',strtotime($close_time)):null;
        //$save_data['active'] = !empty($get_form_data[2])?1:0;  
        $save_data['active'] = 1;
        $save_data['all_day'] = 0;
        if(empty($time_update)) {
          LocationTime::create($save_data);
        } else {
          $time_update->update($save_data);
        } 

        $output = [ 
          'status' => 1 
        ]; 
        echo json_encode($output); 
      }
    }
 
  }  

}