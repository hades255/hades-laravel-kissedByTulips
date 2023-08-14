<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class OrderStatus extends Model
{
  protected $table = 'kbt_order_status';
  protected $primaryKey = 'pk_order_status';
  use Userstamps;
}
