<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class ArrangementType extends Model
{
    use Userstamps;

    protected $table = 'kbt_arrangement_type';
    protected $primaryKey = 'pk_arrangement_type';

    public function floralArrangements()
    {
        return $this->belongsToMany(
            FloralArrangement::class,
            'kbt_floral_arrangement_prices',
            'pk_arrangement_type',
            'pk_floral_arrangements')
            ->withPivot('price', 'active', 'pk_account')
            ->withTimestamps();
    }
}
