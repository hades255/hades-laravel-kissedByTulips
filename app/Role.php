<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Wildside\Userstamps\Userstamps;

class Role extends Model
{
  protected $table = 'kbt_roles';
  protected $primaryKey = 'pk_roles';
  use Userstamps;

  public function users()
  {
   return $this->hasMany('App\User','pk_roles', 'pk_roles');
  }
}
