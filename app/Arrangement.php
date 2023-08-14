<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class ArrangementType extends Model
{
  protected $table = 'kbt_arrangement_type';
  protected $primaryKey = 'pk_arrangement_type';
  use Userstamps;
}
