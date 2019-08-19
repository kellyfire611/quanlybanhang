<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Http\Requests\CategoryCreateRequest;
use Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('backend.categories.index')
            ->with('listCategories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryCreateRequest $request)
    {
        $category = new Category();
        $category->category_code = $request->category_code;
        $category->category_name = $request->category_name;
        $category->description   = $request->description;
        $category->image         = $request->image;

        if($request->hasFile('image'))
        {
            $file = $request->image;

            // Lưu tên hình vào column image
            $category->image = $file->getClientOriginalName();
            
            // Chép file vào thư mục "uploads"
            $fileSaved = $file->storeAs('public/uploads', $category->image);
        }
        $category->save();

        return redirect()->route('backend.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id); //SELECT * FROM categories WHERE id = $id;
        return view('backend.categories.edit')
            ->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        $category = Category::find($id);
        if(!empty($request->category_code)) {
            $category->category_code = $request->category_code;
        }
        $category->category_name = $request->category_name;
        $category->description   = $request->description;
        // dd($request->image);
        if(!empty($request->image)) {
            $category->image     = $request->image;
        }
        // dd($category->image);

        if($request->hasFile('image'))
        {
            // Xóa hình cũ để tránh rác
            Storage::delete('public/uploads/' . $category->image);

            $file = $request->image;

            // Lưu tên hình vào column image
            $category->image = $file->getClientOriginalName();
            
            // Chép file vào thư mục "uploads"
            $fileSaved = $file->storeAs('public/uploads', $category->image);
        }
        $category->save();

        return redirect()->route('backend.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect()->route('backend.categories.index');
    }

    public function print()
    {
        $lstCategories = Category::all();
        return view('backend.categories.print')
            ->with('lstCategories', $lstCategories);
    }
}
