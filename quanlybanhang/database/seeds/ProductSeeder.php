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
        $faker    = Faker\Factory::create('vi_VN'); //locate ISO
        $list = [];

        $listCategories = DB::table('categories')->pluck('id'); //SELECT id FROM categories
        $listSuppliers = DB::table('suppliers')->pluck('id');   //SELECT id FROM suppliers

        for ($i=1; $i <= 100; $i++) {
            array_push($list, 
                [
                    'id'                => $i,
                    'product_code'      => $faker->numerify('product_######'),
                    'product_name'      => $faker->text(500),
                    'image'             => $faker->imageUrl(600, 600),
                    'description'       => $faker->text(250),
                    'standard_code'     => $faker->randomFloat(50000, 50000, 100000000),
                    'list_price'        => $faker->randomFloat(50000, 50000, 100000000),
                    'quantity_per_unit' => $faker->numberBetween(1, 100),
                    'discountinued'     => $faker->numberBetween(0, 1),
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
