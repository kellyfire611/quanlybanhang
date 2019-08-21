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
        // return redirect(); -> trả về HTML
        // return view();     -> trả về HTML

        return response()->json(array(
            'code'  => 200, // HTTP status code 200, 201, 301, 302, 303, 404, 500...
            'data' => $data,
        ));
    }
}
