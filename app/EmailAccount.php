<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class EmailAccount extends Model
{
  protected $table = 'kbt_email_account';
  protected $primaryKey = 'pk_email_account';
  use Userstamps;
}
