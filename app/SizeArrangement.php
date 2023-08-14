<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class SizeArrangement extends Model
{
  protected $table = 'kbt_size_arrangement';
  protected $primaryKey = 'pk_size_arrangement';
  use Userstamps;
}
