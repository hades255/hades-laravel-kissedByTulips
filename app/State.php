<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class State extends Model
{
    use Userstamps;

    protected $table = 'kbt_states';
    protected $primaryKey = 'pk_states';

    protected $guarded = ['pk_states'];

    public function county()
    {
        return $this->hasMany(Country::class, 'pk_country');
    }
}
