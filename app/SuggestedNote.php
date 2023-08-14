<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class SuggestedNote extends Model
{
  protected $table = 'kbt_suggested_note';
  protected $primaryKey = 'pk_suggested_note';
  use Userstamps;
}
