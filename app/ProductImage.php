<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class ProductImage extends Model
{
    protected $table = 'kbt_product_images';
    protected $primaryKey = 'pk_product_images';
    use Userstamps;

    protected $fillable = ['path'];
}
