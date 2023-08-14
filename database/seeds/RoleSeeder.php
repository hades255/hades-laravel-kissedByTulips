<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Role;
use Illuminate\Support\Facades\DB;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS=0;');
      DB::table('kbt_roles')->delete();
      DB::statement('SET FOREIGN_KEY_CHECKS=1;');
      $role  = Role::create(['roles' => 'super-admin','created_by'=>1 , 'updated_by'=>1]);
      $role2 = Role::create(['roles' => 'account-admin','created_by'=>1 , 'updated_by'=>1]);
      $role3 = Role::create(['roles' => 'location-manager','created_by'=>1 , 'updated_by'=>1]);
      $role4 = Role::create(['roles' => 'customer','created_by'=>1 , 'updated_by'=>1]);
      $role4 = Role::create(['roles' => 'vendor','created_by'=>1 , 'updated_by'=>1]);
      $user  = \App\User::create([
           'first_name' => 'Ramesh',
           'last_name' => 'Ramesh',
           'pk_account' => 1,
           'email' => 'ramesh@gmail.com',
           'username' => 'ramesh',
           'password' => Hash::make('12345678'),
           'phone' => '2122122122',
           'active' => 1,
           'pk_roles' => 1
       ]);
      $user  = \App\User::create([
           'first_name' => 'Ramesh',
           'last_name' => 'Ramesh',
           'pk_account' => 1,
           'email' => 'admin@gmail.com',
           'username' => 'admin',
           'password' => Hash::make('12345678'),
           'phone' => '2122122122',
           'active' => 1,
           'pk_roles' => 2
       ]);
    }
}
