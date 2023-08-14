<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;


class CustomerAddres extends Model
{

    use Userstamps;

    protected $table = 'kbt_customer_address';
    protected $primaryKey = 'pk_customer_address';

    protected $guarded = ['pk_customer_address'];


    public static function validate($input)
    {

        $rules = array(
            'address'      => 'required',
            'city'         => 'required',
            'state_name'   => 'required',
            'country_name' => 'required',
            'zip'          => 'required',
        );

        $messages = array(
            'address.required'      => "Address is required.",
            'city.required'         => "City is required.",
            'state_name.required'   => "State is required.",
            'country_name.required' => "Country is required.",
            'zip.required'          => "Zip is required.",
        );

        return validator($input, $rules, $messages);
    }


    public function customer()
    {
        return $this->belongsTo(Customer::class, 'pk_customers', 'pk_customers');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'pk_states', 'pk_states');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'pk_country', 'pk_country');
    }
}
