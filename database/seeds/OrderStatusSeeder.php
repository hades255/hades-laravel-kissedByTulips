<?php

use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS=0;');
      \App\OrderStatus::truncate();
      DB::statement('SET FOREIGN_KEY_CHECKS=1;');
      $OrderStatus = \App\OrderStatus::create(['order_status' => 'new']);
      $OrderStatus = \App\OrderStatus::create(['order_status' => 'in-transit']);
      $OrderStatus = \App\OrderStatus::create(['order_status' => 'delivered']);
      $OrderStatus = \App\OrderStatus::create(['order_status' => 'hold']);
      $OrderStatus = \App\OrderStatus::create(['order_status' => 'canceled']);
    }
}
