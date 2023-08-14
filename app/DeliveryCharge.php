<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;


class DeliveryCharge extends Model {
  use Userstamps;
  protected $table = 'kbt_delivery_charges';
  protected $primaryKey = 'pk_delivery_charges';
  protected $fillable = ['miles_from','miles_to','cost','active','pk_account'];




  public static function validate($input, $id = null){

		$rules = array(
			'miles_from' => 'required',
			'miles_to' => 'required',
			'cost' => 'required|numeric',
		);

		$messages = array(
			'miles_from.required'    => "Miles from is required.",
			'miles_to.required' => "Miles to is required.",
			'cost.required' => "Cost is required.",
			'email.numeric'  		 	 => "Invalid Cost",
		);

		return validator($input, $rules, $messages);
	}


}
