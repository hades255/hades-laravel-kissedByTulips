<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class FlowerSubscription extends Model
{
  protected $table = 'kbt_flower_subscription';
  protected $primaryKey = 'pk_flower_subscription';
  use Userstamps;
}
