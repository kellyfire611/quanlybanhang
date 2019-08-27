<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker    = Faker\Factory::create('en_US'); //locate ISO vi_VN
        $list = [];
        $types = ["Hoa lẻ", "Phụ liệu", "Bó hoa", "Giỏ hoa", "Hoa hộp giấy", "Kệ hoa", "Vòng hoa", "Bình hoa", "Hoa hộp gỗ"];
        
        sort($types);
        for ($i=1; $i <= 10; $i++) {
            array_push($list, 
                [
                    'id'                => $i,
                    'category_code'     => 'code'.$i,
                    'category_name'     => $faker->randomElement($types),
                    'description'       => $faker->text(500),
                    'image'             => $faker->imageUrl(300, 300)
                ]);
        }
        // $list: jagged array
        DB::table('categories')->insert($list);
    }
}
