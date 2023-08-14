<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    protected $primaryKey = 'pk_cities';
    protected $table      = 'kbt_cities';

    protected $fillable = [
        'city',
        'pk_county',
        'pk_states',
        'header',
        'h2_tags',
        'search_tags',
        'keywords',
        'created_by'
    ];
    public function county()
    {
      return $this->belongsTo(County::class, 'pk_county');
    }
}
