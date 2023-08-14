<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Vendor extends Model
{
  protected $table = 'kbt_vendors';
  protected $primaryKey = 'pk_vendors';
  use Userstamps;

  public function state()
  {
    return $this->belongsTo(State::class, 'pk_states', 'pk_states');
  }
  public function country()
  {
    return $this->belongsTo(Country::class, 'pk_country', 'pk_country');
  }
}
