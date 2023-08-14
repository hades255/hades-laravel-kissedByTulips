<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;


class LocationTime extends Model {
  use Userstamps;
  protected $table = 'kbt_location_times';
  protected $primaryKey = 'pk_location_times';
  protected $fillable = ['pk_location_types','day','open_time','close_time','active'];

 


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

 
}
