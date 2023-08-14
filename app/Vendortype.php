<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Vendortype extends Model
{
  protected $table = 'kbt_vendor_type';
  protected $primaryKey = 'pk_vendor_type';
  use Userstamps;
}
