<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker    = Faker\Factory::create('en_US'); //locate ISO
        $list = [];

        $listCategories = DB::table('categories')->pluck('id'); //SELECT id FROM categories
        $listSuppliers = DB::table('suppliers')->pluck('id');   //SELECT id FROM suppliers

        for ($i=1; $i <= 10; $i++) {
            array_push($list, 
                [
                    'id'                => $i,
                    'product_code'      => $faker->numerify('product_######'),
                    'product_name'      => $faker->text(20),
                    'image'             => $faker->imageUrl(600, 600),
                    'description'       => $faker->text(250),
                    'standard_cost'     => $faker->randomFloat(50000, 50000, 10000000),
                    'list_price'        => $faker->randomFloat(50000, 50000, 10000000),
                    'quantity_per_unit' => $faker->numberBetween(1, 100),
                    'discontinued'      => $faker->numberBetween(0, 1),
                    'discount'          => $faker->numberBetween(0, 100),

                    // Khóa ngoại
                    'category_id'       => $faker->randomElement($listCategories),
                    'supplier_id'       => $faker->randomElement($listSuppliers),
                ]);
        }

        // $list: jagged array
        DB::table('products')->insert($list);
    }
}
