<?php

use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS=0;');
      \App\ProductCategory::truncate();
      DB::statement('SET FOREIGN_KEY_CHECKS=1;');
          $prodcutCategory  = \App\ProductCategory::create([
             'pk_account' => 2,
             'product_category' => 'seasonal',
         ]);
         $prodcutCategory2  = \App\ProductCategory::create([
            'pk_account' => 2,
            'product_category' => 'holiday',
        ]);
        $prodcutCategory3  = \App\ProductCategory::create([
           'pk_account' => 2,
           'product_category' => 'neutral',
       ]);
         $prodcutCategory4  = \App\ProductCategory::create([
            'pk_account' => 2,
            'product_category' => 'bright & punchy',
        ]);
          $prodcutCategory5  = \App\ProductCategory::create([
             'pk_account' => 2,
             'product_category' => 'pastels',
         ]);
         $prodcutCategory6  = \App\ProductCategory::create([
            'pk_account' => 2,
            'product_category' => 'monochromatic',
        ]);
        $prodcutCategory7  = \App\ProductCategory::create([
           'pk_account' => 2,
           'product_category' => 'roses',
       ]);
       $prodcutCategory8  = \App\ProductCategory::create([
          'pk_account' => 2,
          'product_category' => 'tropicals',
      ]);
      $prodcutCategory9  = \App\ProductCategory::create([
         'pk_account' => 2,
         'product_category' => 'designers choice',
     ]);
     $prodcutCategory10  = \App\ProductCategory::create([
        'pk_account' => 2,
        'product_category' => 'greeting cards',
    ]);
    $prodcutCategory11  = \App\ProductCategory::create([
       'pk_account' => 2,
       'product_category' => 'gifts',
   ]);
   $prodcutCategory12  = \App\ProductCategory::create([
      'pk_account' => 2,
      'product_category' => 'everything',
  ]);
    }
}
