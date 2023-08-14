<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;


class OrderItem extends Model
{
    use Userstamps;

    protected $table = 'kbt_order_items';
    protected $primaryKey = 'pk_order_items';
    protected $guarded = ['pk_order_items'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'pk_orders', 'pk_orders');
    }

    public function shippingAddress()
    {
        return $this->hasOne(ShippingAddress::class, 'pk_order_items', 'pk_order_items');
    }
}
