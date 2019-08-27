<?php

use Illuminate\Database\Seeder;

class OrderDetailSeeder extends Seeder
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

        $lstOrders = DB::table('orders')->pluck('id');                    //SELECT id FROM orders
        $lstProducts = DB::table('products')->get(['id', 'list_price']);  //SELECT id, list_price FROM products

        for ($i = 0; $i < count($lstOrders); $i++) {
            $randomOrderDetailCount = $faker->numberBetween(1, 10);
            for ($j = 0; $j < $randomOrderDetailCount; $j++) {
                $randomProduct = $faker->randomElement($lstProducts);
                array_push(
                    $list,
                    [
                        // Khóa ngoại
                        'order_id'              => $lstOrders[$i],
                        'product_id'            => $randomProduct->id,

                        'quantity'              => $faker->numberBetween(1, 20),
                        'unit_price'            => $randomProduct->list_price + $faker->randomFloat(10000000),
                        'discount'              => $faker->randomFloat(1, 0, 1),
                        'order_detail_status'   => $faker->randomElement(['1', '2']),
                        'date_allocated'        => $faker->dateTimeThisYear(),
                    ]
                );
            }
        }

        // $list: jagged array
        DB::table('order_details')->insert($list);
    }
}
