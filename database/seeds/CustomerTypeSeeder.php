<?php

use Illuminate\Database\Seeder;
use App\Customertype;

class CustomerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS=0;');
      Customertype::truncate();
      DB::statement('SET FOREIGN_KEY_CHECKS=1;');
      Customertype::create(['pk_account'=>2 , 'customer_type' =>'Direct Customer','customer_type_code'=>'DC' , 'active'=> 1]);
      Customertype::create(['pk_account'=>2 ,'customer_type' =>'Corporate Customer','customer_type_code'=>'CC' , 'active'=> 1]);
      Customertype::create(['pk_account'=>2 ,'customer_type' =>'Event Planners','customer_type_code'=>'EP' , 'active'=> 1]);
      Customertype::create(['pk_account'=>2 ,'customer_type' =>'Event Venues','customer_type_code'=>' EV' , 'active'=> 1]);
    }
}
