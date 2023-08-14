<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;
use DB;


class LocationTime extends Model {
  use Userstamps;
  protected $table = 'kbt_location_times';
  protected $primaryKey = 'pk_location_times';
  protected $fillable = ['pk_locations','start','day','open_time','close_time','active','pk_location_types','is_exception','all_day'];

 


	public static function validate($input, $id = null){
			
		$rules = array(
			'day' => 'required', 
		); 
		
		$messages = array(
			'day.required'    => "Day is required.",
			'open_time.required' => "Open time is required.", 
		);
		
		return validator($input, $rules, $messages);
	}


	public static function get_time_data($pk_locations = null,$start = null){ 
		$get_data = DB::table('kbt_location_times')->where('pk_locations',$pk_locations)->where('start',$start)->first(); 
		return $get_data;
	}

 
}
