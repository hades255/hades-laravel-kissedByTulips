<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class FloralArrangementsPrice extends Model
{
  protected $table = 'kbt_floral_arrangement_price';
  protected $primaryKey = 'pk_floral_arrangement_price';
  use Userstamps;
}
