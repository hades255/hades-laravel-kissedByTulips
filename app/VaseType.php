<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class VaseType extends Model
{
  protected $table = 'kbt_vase_type';
  protected $primaryKey = 'pk_vase_type';
  use Userstamps;
}
