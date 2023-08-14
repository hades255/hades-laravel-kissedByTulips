<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Department extends Model
{
  protected $table = 'kbt_department';
  protected $primaryKey = 'pk_department';
  use Userstamps;
}
