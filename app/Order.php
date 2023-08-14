<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;


class Order extends Model
{
    use Userstamps;

    protected $table = 'kbt_orders';
    protected $primaryKey = 'pk_orders';

    protected $guarded = ['pk_orders'];


    public static function validate($input, $id = null)
    {
        $rules = array(
            'first_name'           => 'required|max:50',
            'last_name'            => 'required|max:50',
            'username'             => 'required|max:50|unique:users',
            'email'                => 'required|max:50|unique:users,email',
            'phone'                => 'required|max:50',
            'address'              => 'required',
            'city'                 => 'required',
            'state_name'           => 'required',
            'zip'                  => 'required',
            'country_name'         => 'required',
            'cc_name'              => 'required',
            'cc_number'            => 'required',
            'expiry_month'         => 'required',
            'expiry_year'          => 'required',
            'cvv'                  => 'required',
            'billing_full_name'    => 'required_if:address_type,==,new_address',
            //'billing_mobile' => 'required_if:address_type,==,new_address',
            //'billing_email' => 'required_if:address_type,==,new_address',
            'billing_address'      => 'required_if:address_type,==,new_address',
            'billing_city'         => 'required_if:address_type,==,new_address',
            'billing_state_name'   => 'required_if:address_type,==,new_address',
            'billing_country_name' => 'required_if:address_type,==,new_address',
            'billing_zip'          => 'required_if:address_type,==,new_address',

        );

        $messages = array(
            'first_name.required'   => "First name is required.",
            'last_name.required'    => "Last name is required.",
            'username.required'     => "Username is required.",
            'username.unique'       => "Username is already registered.",
            'email.required'        => "Email is required.",
            'email.email'           => "Invalid Email",
            'email.unique'          => "Email is already registered.",
            'address.required'      => "Address is required.",
            'city.required'         => "City is required.",
            'state_name.required'   => "State is required.",
            'zip.required'          => "Zip is required.",
            'country_name.required' => "Country is required.",
            'cc_name.required'      => "Name is required.",
            'cc_number.required'    => "Card number is required.",
            'expiry_month.required' => "Month is required.",
            'expiry_year.required'  => "Year is required.",
            'cvv.required'          => "CVV is required.",

            'billing_full_name.required_if'    => "Full name is required.",
            'billing_mobile.required_if'       => "Mobile is required.",
            'billing_email.required_if'        => "Email is required.",
            'billing_address.required_if'      => "Address is required.",
            'billing_city.required_if'         => "City is required.",
            'billing_state_name.required_if'   => "State is required.",
            'billing_country_name.required_if' => "Country is required.",
            'billing_zip.required_if'          => "Zip is required.",
        );

        return validator($input, $rules, $messages);
    }


    public static function validate_payment_card($input, $id = null)
    {

        $rules = [
            'cc_name'              => 'required',
            'cc_number'            => 'required',
            'expiry_month'         => 'required',
            'expiry_year'          => 'required',
            'cvv'                  => 'required',
            'billing_full_name'    => 'required_if:address_type,==,new_address',
            //'billing_mobile' => 'required_if:address_type,==,new_address',
            //'billing_email' => 'required_if:address_type,==,new_address',
            'billing_address'      => 'required_if:address_type,==,new_address',
            'billing_city'         => 'required_if:address_type,==,new_address',
            'billing_state_name'   => 'required_if:address_type,==,new_address',
            'billing_country_name' => 'required_if:address_type,==,new_address',
            'billing_zip'          => 'required_if:address_type,==,new_address',
        ];

        $messages = [
            'cc_name.required'      => "Name is required.",
            'cc_number.required'    => "Card number is required.",
            'expiry_month.required' => "Month is required.",
            'expiry_year.required'  => "Year is required.",
            'cvv.required'          => "CVV is required.",

            'billing_full_name.required_if'    => "Full name is required.",
            'billing_mobile.required_if'       => "Mobile is required.",
            'billing_email.required_if'        => "Email is required.",
            'billing_address.required_if'      => "Address is required.",
            'billing_city.required_if'         => "City is required.",
            'billing_state_name.required_if'   => "State is required.",
            'billing_country_name.required_if' => "Country is required.",
            'billing_zip.required_if'          => "Zip is required.",
        ];

        return validator($input, $rules, $messages);
    }

    public function account()
    {
        return $this->belongsTo(Account::class, 'pk_account', 'pk_account');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'pk_users', 'pk_users');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'pk_customers', 'pk_customers');
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class, 'pk_orders', 'pk_orders');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'pk_locations');
    }

    public function location_time()
    {
        return $this->belongsTo(LocationTime::class, 'pk_location_times', 'pk_location_times');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'pk_transactions', 'pk_transactions');
    }

    public function orderStatus()
    {
        return $this->hasOne(OrderStatus::class, 'pk_order_status', 'pk_order_status');
    }

    public function deliveryOption()
    {
        return $this->belongsTo(DeliveryOrPickup::class, 'pk_delivery_or_pickup', 'pk_delivery_or_pickup');
    }
}
