<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Transaction extends Model
{
    use Userstamps;

    protected $table = 'kbt_transactions';
    protected $primaryKey = 'pk_transactions';

    protected $guarded = ['pk_transactions'];
}
