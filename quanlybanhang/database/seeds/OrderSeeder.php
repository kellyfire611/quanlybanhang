<?php

use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
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

        $lstEmployees = DB::table('employees')->pluck('id'); //SELECT id FROM employees
        $lstCustomers = DB::table('customers')->pluck('id'); //SELECT id FROM customers

        for ($i=1; $i <= 30; $i++) {
            array_push($list, 
                [
                    'id'                => $i,
                    // Khóa ngoại
                    'employee_id'       => $faker->randomElement($lstEmployees),
                    'customer_id'       => $faker->randomElement($lstCustomers),

                    'order_date'        => $faker->dateTimeThisYear(),
                    'shipped_date'      => $faker->dateTimeThisYear(),
                    'ship_name'         => $faker->name(),
                    'ship_address1'     => $faker->address(),
                    'ship_address2'     => $faker->address(),
                    'ship_city'         => $faker->city(),
                    'ship_state'        => $faker->state(),
                    'ship_postal_code'  => $faker->postcode(),
                    'ship_country'      => $faker->country(),
                    'shipping_pee'      => $faker->numberBetween(0, 100),
                    'payment_type'      => $faker->randomElement(['1', '2']),
                    'paid_date'         => $faker->dateTimeThisYear(),
                    'order_status'      => $faker->randomElement(['1', '2']),
                ]);
        }

        // $list: jagged array
        DB::table('orders')->insert($list);
    }
}
