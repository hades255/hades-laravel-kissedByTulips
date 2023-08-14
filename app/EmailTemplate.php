<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class EmailTemplate extends Model
{
  protected $table = 'kbt_email_template';
  protected $primaryKey = 'pk_email_template';
  use Userstamps;
}
