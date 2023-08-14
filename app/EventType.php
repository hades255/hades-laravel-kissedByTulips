<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class EventType extends Model
{
  protected $table = 'kbt_event_type';
  protected $primaryKey = 'pk_event_type';
  use Userstamps;
}
