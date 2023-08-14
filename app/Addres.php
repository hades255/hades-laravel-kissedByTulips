<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;


class Addres extends Model
{
    use Userstamps;

    protected $table = 'kbt_shipping_address';
    protected $primaryKey = 'pk_shipping_address';

    protected $guarded = ['pk_shipping_address'];

}
