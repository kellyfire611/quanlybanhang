<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

class ProductController extends Controller
{
    public function index() {
        $list = Product::all();
        return view('backend.products.index')
            ->with('listProducts', $list);
    }
}
