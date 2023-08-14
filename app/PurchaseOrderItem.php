<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model
{
    protected $primaryKey = 'pk_purchase_order_items';
    protected $table      = 'kbt_purchase_order_items';

    protected $fillable = [
        'pk_purchase_order',
        'name',
        'description',
        'quantity',
        'total',
        'active'
    ];
}
