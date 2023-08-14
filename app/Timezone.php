<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;


class Timezone extends Model
{
  protected $table = 'kbt_timezone';
  protected $primaryKey = 'pk_timezone';
  use Userstamps;
}
