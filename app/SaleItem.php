<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    protected $primaryKey = 'pk_sale_items';
    protected $table      = 'kbt_sale_items';

    protected $guarded = ['pk_sale_items'];

    public function sale()
    {
        return $this->belongsTo(Sale::class, 'pk_sale', 'pk_sales');
    }
}
