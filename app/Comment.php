<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Comment extends Model
{
  use Userstamps;

  protected $table = 'kbt_comment';
  protected $primaryKey = 'pk_comment';

  protected $guarded = ['pk_comment'];
}
