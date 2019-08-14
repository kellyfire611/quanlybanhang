<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
use App\Supplier;

class ProductController extends Controller
{
    public function index() {
        $list = Product::all();
        return view('backend.products.index')
            ->with('listProducts', $list);
    }

    public function create()
    {
        $lstCategories = Category::all();
        $lstSuppliers = Supplier::all();

        return view('backend.products.create')
            ->with('lstCategories', $lstCategories)
            ->with('lstSuppliers', $lstSuppliers);
    }
}
