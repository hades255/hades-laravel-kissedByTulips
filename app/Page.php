<?php
namespace App;
use Wildside\Userstamps\Userstamps;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
  protected $table = 'kbt_pages';
  protected $primaryKey = 'pk_page';
  use Userstamps;
}
