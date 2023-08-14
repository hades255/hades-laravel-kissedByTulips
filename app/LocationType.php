<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class LocationType extends Model
{
  protected $table = 'kbt_location_types';
  protected $primaryKey = 'pk_location_types';
  use Userstamps;

  public function locationTime()
  {
      return $this->hasMany(LocationTime::class, 'pk_location_types', 'pk_location_types');
  }
  
}
