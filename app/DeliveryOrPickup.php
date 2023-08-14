<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class DeliveryOrPickup extends Model
{
    use Userstamps;


    protected $table = 'kbt_delivery_or_pickup';
    protected $primaryKey = 'pk_delivery_or_pickup';

    protected $guarded = ['pk_delivery_or_pickup'];

    public function orders()
    {
        return $this->hasMany(Order::class, 'pk_delivery_or_pickup', 'pk_delivery_or_pickup');
    }
}
