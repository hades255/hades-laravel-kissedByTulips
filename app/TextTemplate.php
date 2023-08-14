<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class TextTemplate extends Model
{
  protected $table = 'kbt_text_template';
  protected $primaryKey = 'pk_text_template';
  use Userstamps;
}
