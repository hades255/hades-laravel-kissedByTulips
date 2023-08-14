<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleType extends Model
{
    protected $primaryKey = 'pk_sales_type';

    protected $table = 'kbt_sales_type';

    protected $guarded = ['pk_sales_type'];
}
