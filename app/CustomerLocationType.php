<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class CustomerLocationType extends Model {

  protected $table = 'kbt_customer_location_types';
  protected $primaryKey = 'pk_customer_location_types';

  protected $fillable = ['pk_account','pk_location_types','pk_location_times','customer_location_types','description','active','created_by','updated_by'];
  use Userstamps;
}