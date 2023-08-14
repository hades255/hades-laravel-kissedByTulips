<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class CustomerContact extends Model
{
    protected $table = 'kbt_customer_contacts';
    protected $primaryKey = 'pk_customer_contacts';
    use Userstamps;
}
