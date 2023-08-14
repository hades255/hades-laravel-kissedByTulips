<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class ProductSubCategory extends Model
{
  protected $table = 'kbt_product_sub_category';
  protected $primaryKey = 'pk_product_sub_category';
  use Userstamps;
}
