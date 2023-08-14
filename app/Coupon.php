<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;


class Coupon extends Model {
  use Userstamps;
  protected $table = 'kbt_coupons';
  protected $primaryKey = 'pk_coupons';
  protected $fillable = ['title','code','discount_amount','quantity','used','type','active','start_at','expire_at','pk_account'];




  public static function validate($input, $id = null){

		$rules = array(
			'type' => 'required',
			'title' => 'required',
			'code'        	=> 'required|unique:kbt_coupons,code,'.$id. ',pk_coupons',
			'discount_amount' => 'required|numeric',
			'start_at' => 'required',
			'expire_at' => 'required',
			'quantity' => 'required',
		);

		$messages = array(
			'type.required'    => "Type is required.",
			'title.required'    => "Title is required.",
			'code.required' => "Code is required.",
			'code.unique' => "Code is already exists.",
			'discount_amount.required' => "Amount is required.",
			'discount_amount.numeric'  => "Invalid amount",
			'start_at.required'  => "Start date is required.",
			'expire_at.required'  => "Expire date is required.",
			'quantity.required'  => "Quantity is required.",
		);

		return validator($input, $rules, $messages);
	}


}
