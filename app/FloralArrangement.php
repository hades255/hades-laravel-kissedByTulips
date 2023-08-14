<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Wildside\Userstamps\Userstamps;

class FloralArrangement extends Model
{
    use Userstamps;


    //kbt_products
    protected $table = 'kbt_floral_arrangements';
    protected $primaryKey = 'pk_floral_arrangements';


    public function images(): HasMany
    {
        return $this->hasMany(FloralArrangementsImage::class, 'pk_floral_arrangements', 'pk_floral_arrangements');
    }

    public function arrangementTypes()
    {
        return $this->belongsToMany(
            ArrangementType::class,
            'kbt_floral_arrangement_prices',
            'pk_floral_arrangements',
            'pk_arrangement_type')
            ->withPivot('price', 'active', 'pk_account')
            ->withTimestamps();
    }
}
