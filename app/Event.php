<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Event extends Model
{
  protected $table = 'kbt_event';
  protected $primaryKey = 'pk_event';
  use Userstamps;
}
