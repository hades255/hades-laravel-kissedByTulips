<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;


class Customer extends Model
{
    use Userstamps;

    protected $table = 'kbt_customers';
    protected $primaryKey = 'pk_customers';

    protected $guarded = ['pk_customers'];

    public function customertype()
    {
        return $this->belongsTo(Customertype::class, 'pk_customer_type', 'pk_customer_type');
    }


    public function address()
    {
        return $this->hasMany(CustomerAddres::class, 'pk_customers', 'pk_customers');
    }
}
