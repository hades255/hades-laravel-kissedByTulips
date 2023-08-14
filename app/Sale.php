<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $primaryKey = 'pk_sales';
    protected $table      = 'kbt_sales';

    protected $guarded = ['pk_sales'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'pk_orders', 'pk_orders');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'pk_users', 'pk_users');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'pk_customers', 'pk_customers');
    }

    public function account()
    {
        return $this->belongsTo(Account::class, 'pk_account', 'pk_account');
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'pk_transactions', 'pk_transactions');
    }

    public function arrangementType()
    {
        return $this->belongsTo(ArrangementType::class, 'pk_arrangement_type', 'pk_arrangement_type');
    }

    public function saleType()
    {
        return $this->belongsTo(SaleType::class, 'pk_sales_type', 'pk_sales_type');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'pk_locations', 'pk_locations');
    }

    public function locationTime()
    {
        return $this->belongsTo(LocationTime::class, 'pk_location_times', 'pk_location_times');
    }

    public function saleItems()
    {
        return $this->hasMany(SaleItem::class, 'pk_sales', 'pk_sales');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'pk_users');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'pk_users');
    }
}
