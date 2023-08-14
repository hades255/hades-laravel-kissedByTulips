<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class ShippingAddress extends Model
{
    use Userstamps;

    protected $table = 'kbt_shipping_address';
    protected $primaryKey = 'pk_shipping_address';

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class, 'pk_order_items', 'pk_order_items');
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
