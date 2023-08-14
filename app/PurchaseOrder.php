<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $primaryKey = 'pk_purchase_order';
    protected $table = 'kbt_purchase_order';

    protected $fillable = [
        'pk_vendors',
        'po_number',
        'delivery_date_request',
        'pk_locations',
        'shipping_address',
        'shipping_address_1',
        'shipping_city',
        'shipping_state',
        'shipping_country',
        'shipping_zip',
        'pk_users',
        'pk_account',
        'active',
        'created_by',
        'updated_by',
        'pk_purchase_order_status'
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'pk_vendors');
    }

    public function items()
    {
        return $this->hasMany(PurchaseOrderItem::class, 'pk_purchase_order');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'pk_users');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'pk_locations');
    }

    public function status()
    {
        return $this->belongsTo(PurchaseOrderStatus::class, 'pk_purchase_order_status');
    }
}
