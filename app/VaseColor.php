<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class VaseColor extends Model
{
  protected $table = 'kbt_vase_colors';
  protected $primaryKey = 'pk_vase_colors';
  use Userstamps;
}
