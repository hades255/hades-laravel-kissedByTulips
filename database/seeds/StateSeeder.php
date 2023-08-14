<?php

use Illuminate\Database\Seeder;
use App\State;
class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS=0;');
      State::truncate();
      DB::statement('SET FOREIGN_KEY_CHECKS=1;');
      $state   = State::create(['pk_country' =>1,'state_name'=>'Alabama' , 'state_code'=>'AL']);
      $state2  = State::create(['pk_country' =>1,'state_name'=>'Alaska' , 'state_code'=>'AK']);
      $state3  = State::create(['pk_country' =>1,'state_name'=>'Arizona' , 'state_code'=>'AZ']);
      $state4  = State::create(['pk_country' =>1,'state_name'=>'Arkansas' , 'state_code'=>'AR']);
      $state5  = State::create(['pk_country' =>1,'state_name'=>'California' , 'state_code'=>'CA']);
      $state6  = State::create(['pk_country' =>1,'state_name'=>'Colorado' , 'state_code'=>'CO']);
      $state7  = State::create(['pk_country' =>1,'state_name'=>'Connecticut' , 'state_code'=>'CT']);
      $state8  = State::create(['pk_country' =>1,'state_name'=>'Delaware' , 'state_code'=>'DE']);
      $state9  = State::create(['pk_country' =>1,'state_name'=>'District of Columbia' , 'state_code'=>'DC']);
      $state10 = State::create(['pk_country' =>1,'state_name'=>'Florida' , 'state_code'=>'FL']);
    }
}
