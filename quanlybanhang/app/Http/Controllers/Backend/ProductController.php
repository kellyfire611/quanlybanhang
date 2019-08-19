<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
use App\Supplier;
use App\Http\Requests\ProductCreateRequest;
use Storage;

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

    public function store(ProductCreateRequest $request)
    {
        $product = new Product();
        $product->product_code      = $request->product_code;
        $product->product_name      = $request->product_name;
        $product->description       = $request->description;
        $product->image             = $request->image;
        $product->standard_cost     = $request->standard_cost;
        $product->list_price        = $request->list_price;
        $product->quantity_per_unit = $request->quantity_per_unit;
        //$product->discontinued      = $request->discontinued;
        if($request->has('discontinued')) {
            $product->discontinued = 1; // Ngưng bán
        } else {
            $product->discontinued = 0; // Còn sử dụng (bán)
        }

        $product->discount          = $request->discount;
        $product->category_id       = $request->category_id;
        $product->supplier_id       = $request->supplier_id;

        if($request->hasFile('image'))
        {
            $file = $request->image;

            // Lưu tên hình vào column image
            $product->image = $file->getClientOriginalName();
            
            // Chép file vào thư mục "uploads"
            $fileSaved = $file->storeAs('public/uploads', $product->image);
        }
        $product->save();

        return redirect()->route('backend.products.index');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $lstCategories = Category::all();
        $lstSuppliers = Supplier::all();

        return view('backend.products.edit')
            ->with('lstCategories', $lstCategories)
            ->with('lstSuppliers', $lstSuppliers)
            ->with('product', $product);
    }

    public function update(Request $request, $id)
    {
        
        $product = Product::find($id);
        $product->product_code      = $request->product_code;
        $product->product_name      = $request->product_name;
        $product->description       = $request->description;
        $product->image             = $request->image;
        $product->standard_cost     = $request->standard_cost;
        $product->list_price        = $request->list_price;
        $product->quantity_per_unit = $request->quantity_per_unit;
        //$product->discontinued      = $request->discontinued;
        if($request->has('discontinued')) {
            $product->discontinued = 1; // Ngưng bán
        } else {
            $product->discontinued = 0; // Còn sử dụng (bán)
        }

        $product->discount          = $request->discount;
        $product->category_id       = $request->category_id;
        $product->supplier_id       = $request->supplier_id;

        if($request->hasFile('image'))
        {
            // Xóa hình cũ để tránh rác
            Storage::delete('public/uploads/' . $product->image);

            $file = $request->image;

            // Lưu tên hình vào column image
            $product->image = $file->getClientOriginalName();
            
            // Chép file vào thư mục "uploads"
            $fileSaved = $file->storeAs('public/uploads', $product->image);
        }
        $product->save();

        return redirect()->route('backend.products.index');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route('backend.products.index');
    }
}
