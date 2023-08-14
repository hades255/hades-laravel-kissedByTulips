<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Customertype extends Model
{
    use Userstamps;

    protected $table = 'kbt_customer_type';
    protected $primaryKey = 'pk_customer_type';

    public function customers()
    {
        return $this->hasMany(Customer::class, 'pk_customer_type', 'pk_customer_type');
    }

}
