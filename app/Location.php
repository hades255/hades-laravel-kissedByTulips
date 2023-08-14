<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Location extends Model
{
    protected $table = 'kbt_locations';
    protected $primaryKey = 'pk_locations';
    use Userstamps;

    public function locationTime()
    {
        return $this->hasMany(LocationTime::class, 'pk_locations', 'pk_locations');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'pk_states');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'pk_country');
    }

}
