<?php

use Illuminate\Database\Seeder;
use App\Account;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS=0;');
      Account::truncate();
      DB::statement('SET FOREIGN_KEY_CHECKS=1;');
      $account  = \App\Account::create([
         'business_name' => 'Superadmin',
         'address' => 'CA',
         'address_1' => 'CA1',
         'city' => 'CA',
         'pk_states' => 6,
         'zip' => '11232',
         'pk_country' => 1,
         'business_phone' => '2122122122',
         'fax' => '2122122122',
         'business_email' => 'admin@gmail.com',
         'website' => 'admin.in',
         'active' => 1
     ]);
    }
}
