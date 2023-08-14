<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Wildside\Userstamps\Userstamps;

class FloralArrangementsImage extends Model
{
    use Userstamps;


    protected $table = 'kbt_floral_arrangements_images';
    protected $primaryKey = 'pk_floral_arrangements_images';


    public function floralArrangement(): BelongsTo
    {
        return $this->belongsTo(FloralArrangement::class, 'pk_floral_arrangements', 'pk_floral_arrangements');
    }
}
