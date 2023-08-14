<?php

use App\SaleType;
use Illuminate\Database\Seeder;

class SaleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $saleTypes = [
            [
                'sale_type'  => 'POS',
                'created_at' => now()
            ],
            [
                'sale_type'  => 'Pickup',
                'created_at' => now()
            ],
            [
                'sale_type'  => 'Delivery',
                'created_at' => now()
            ],
            [
                'sale_type'  => 'Event',
                'created_at' => now()
            ]
        ];

        SaleType::insert($saleTypes);

        $this->command->info('Sale types seeded!');
    }
}
