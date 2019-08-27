<?php

use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
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

        for ($i=1; $i <= 20; $i++) {
            array_push($list, 
                [
                    'id'                => $i,
                    'last_name'         => $faker->lastName(),
                    'first_name'        => $faker->firstName(),
                    'email'             => $faker->email(),
                    'company'           => $faker->company(),
                    'phone'             => $faker->phoneNumber(),
                    'address1'          => $faker->address(),
                    'address2'          => $faker->address(),
                    'city'              => $faker->city(),
                    'state'             => $faker->state(),
                    'postal_code'       => $faker->postcode(),
                    'country'           => $faker->country(),
                ]);
        }

        // $list: jagged array
        DB::table('customers')->insert($list);
    }
}
