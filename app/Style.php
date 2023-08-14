<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Style extends Model
{
  protected $table = 'kbt_styles';
  protected $primaryKey = 'pk_styles';
  use Userstamps;
}
