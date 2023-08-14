<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;


class Account extends Model
{
  use Userstamps;
  protected $table = 'kbt_account';
  protected $primaryKey = 'pk_account';
  protected $fillable = ['business_name','address','address_1','city','pk_states','zip','pk_country','business_phone','fax','business_email','website'];

  public function locationType()
  {
      return $this->belongsTo(LocationType::class, 'pk_account', 'pk_account');
  }

  public function state()
  {
      return $this->belongsTo(State::class, 'pk_states', 'pk_states');
  }

  public function country()
  {
      return $this->belongsTo(Country::class, 'pk_country', 'pk_country');
  }
}
