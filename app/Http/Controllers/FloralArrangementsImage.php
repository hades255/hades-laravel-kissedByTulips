<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class FloralArrangementsImage extends Model
{
  protected $table = 'kbt_floral_arrangements_images';
  protected $primaryKey = 'pk_floral_arrangements_images';
  use Userstamps;
}
