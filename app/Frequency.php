<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Frequency extends Model
{
  protected $table = 'kbt_frequency';
  protected $primaryKey = 'pk_frequency';
  use Userstamps;
}
