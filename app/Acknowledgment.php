<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Acknowledgment extends Model
{
  protected $table = 'kbt_acknowledgments';
  protected $primaryKey = 'pk_acknowledgments';
  use Userstamps;

  protected $fillable = [
    'message_code',
    'message_type',
    'message',
    'created_by',
    'updated_by',
  ];

  public function createdBy()
  {
    return $this->belongsTo(User::class, 'created_by', 'pk_users');
  }

  public function updatedBy()
  {
    return $this->belongsTo(User::class, 'updated_by', 'pk_users');
  }
}
