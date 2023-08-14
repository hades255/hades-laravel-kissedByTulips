<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class AccountAdminPaymentGateway extends Model
{
  protected $table = 'kbt_account_admin_payment_gateways';
  protected $primaryKey = 'pk_account_admin_payment_gateways';
  protected $fillable = ['pk_users','pk_account','merchant_login_id','merchant_transaction_key','other_key','active','created_by'];

  use Userstamps;
}
