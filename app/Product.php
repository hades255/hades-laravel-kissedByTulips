<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Product extends Model
{
    //kbt_products
    protected $table = 'kbt_products';
    protected $primaryKey = 'pk_products';
    use Userstamps;
    
    public function images()
    {
        return $this->hasMany(ProductImage::class,'pk_products','pk_products');
    }
    
}
