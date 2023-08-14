<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    protected $primaryKey = 'pk_county';
    protected $table      = 'kbt_county';

    protected $fillable = [
        'pk_states',
        'county',
        'created_by'
    ];

    public function cities()
    {
      return $this->hasMany(Cities::class, 'pk_county');
    }
}
