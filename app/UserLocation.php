<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class UserLocation extends Model
{
    protected $table = 'kbt_user_locations';
    protected $primaryKey = 'pk_user_locations';
    use Userstamps;

   
}
