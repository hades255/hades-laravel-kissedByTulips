<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Flower extends Model
{
  protected $table = 'kbt_flowers';
  protected $primaryKey = 'pk_flowers';
  use Userstamps;
}
