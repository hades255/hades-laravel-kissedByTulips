<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Country extends Model
{
  protected $table = 'kbt_country';
  protected $primaryKey = 'pk_country';
  use Userstamps;
}
