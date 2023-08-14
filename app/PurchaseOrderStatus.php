<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class PurchaseOrderStatus extends Model
{
  protected $primaryKey = 'pk_purchase_order_status';
  protected $table      = 'kbt_purchase_order_status';
}
