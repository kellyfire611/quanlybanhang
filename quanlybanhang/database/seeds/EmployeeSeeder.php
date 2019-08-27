<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
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
        
        // Người dùng mặc định
        array_push($list, 
            [
                'id'                => 1,
                'username'          => 'dnpcuong',
                'last_name'         => 'Dương Nguyễn Phú',
                'first_name'        => 'Cường',
                'email'             => 'admin@nentang.vn',
                'avatar'            => 'https://nentang.vn/avatar.jpg',
                'password'          => Hash::make('12345678'),
                'job_title'         => 'Teacher and Developer',
                'manager_id'        => NULL,
                'phone'             => '0915659223',
                'address1'          => '130 Xô Viết Nghệ Tỉnh, Quận Ninh Kiều, TP Cần Thơ',
                'address2'          => NULL,
                'city'              => 'Cần Thơ',
                'state'             => NULL,
                'postal_code'       => '94000',
                'country'           => 'Việt Nam',
                'remember_token'    => NULL,
                'active_code'       => NULL,
                'status'            => '1', //0: chưa kích hoạt, 1: đã kích hoạt
            ]);
        // $list: jagged array
        DB::table('employees')->insert($list);
    }
}
