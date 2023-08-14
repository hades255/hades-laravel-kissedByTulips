<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class TextAccount extends Model
{
  protected $table = 'kbt_text_settings';
  protected $primaryKey = 'pk_text_settings';
  use Userstamps;
}
