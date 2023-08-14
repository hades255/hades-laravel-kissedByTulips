<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class ProductCategory extends Model
{
  protected $table = 'kbt_product_category';
  protected $primaryKey = 'pk_product_category';
  use Userstamps;
}
