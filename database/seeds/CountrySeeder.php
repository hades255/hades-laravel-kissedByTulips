<?php

use Illuminate\Database\Seeder;
use App\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS=0;');
      Country::truncate();
      DB::statement('SET FOREIGN_KEY_CHECKS=1;');
      $country  = Country::create(['country_code' =>'USA','country_name'=>'United States']);
    }
}
