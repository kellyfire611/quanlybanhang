<?php

namespace App\Http\Controllers\Backend\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ApiController extends Controller
{
    public function getProductCount() {
        // raw sql
        $data = DB::select('
            SELECT COUNT(*) as SoLuong FROM products;
        ');
        return response()->json(array(
            'code'  => 200,
            'data' => $data,
        ));
    }
}
