<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Wildside\Userstamps\Userstamps;

class FloralArrangementPrice extends Model
{
    use Userstamps;


    //kbt_products
    protected $table = 'kbt_floral_arrangement_prices';
    protected $primaryKey = 'pk_floral_arrangement_prices';

    protected $fillable = ['pk_floral_arrangements', 'pk_arrangement_type', 'pk_account', 'price', 'active', 'created_by'];


    public function arrangementType(): BelongsTo
    {
        return $this->belongsTo(ArrangementType::class, 'pk_arrangement_type', 'pk_arrangement_type');
    }

    public function floralArrangement(): BelongsTo
    {
        return $this->belongsTo(FloralArrangement::class, 'pk_floral_arrangements', 'pk_floral_arrangements');
    }
}
