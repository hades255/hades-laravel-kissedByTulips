<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Uom extends Model
{
  protected $table = 'kbt_uom';
  protected $primaryKey = 'pk_uom';
  use Userstamps;
}
