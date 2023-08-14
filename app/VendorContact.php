<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class VendorContact extends Model
{
  protected $table = 'kbt_vendor_contacts';
  protected $primaryKey = 'pk_vendor_contacts';
  use Userstamps;
}
