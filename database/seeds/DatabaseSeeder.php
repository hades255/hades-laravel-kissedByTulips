<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AccountSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(StateSeeder::class);
        $this->call(OrderStatusSeeder::class);
        $this->call(ProductCategorySeeder::class);
        $this->call(TimezoneSeeder::class);
        $this->call(CustomerTypeSeeder::class);
    }
}
