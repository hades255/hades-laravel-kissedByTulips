<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class ColorFlower extends Model
{
  protected $table = 'kbt_color_flower';
  protected $primaryKey = 'pk_color_flower';
  use Userstamps;
}
