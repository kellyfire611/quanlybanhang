<?php

use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [];
        $types = ["Apple", "Microsoft", "Samsung"];
        sort($types);
        for ($i=1; $i <= count($types); $i++) {
            array_push($list, 
                [
                    'id'                => $i,
                    'supplier_code'     => 'code'.$i,
                    'supplier_name'     => $types[$i-1],
                    'description'       => '',
                    'image'             => ''
                ]);
        }
        // $list: jagged array
        DB::table('suppliers')->insert($list);
    }
}
