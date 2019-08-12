<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Category;
use App\Supplier;
use App\Product;

Route::get('/', function () {
    return view('welcome');
});

// route Hiển thị màn hình hello  Controller@action
Route::get('/hello', 'ExampleController@hello')->name('example.hello');
Route::get('/xin-chao', 'ViDuController@xinchao')->name('vidu.xinchao');

// Route backend categories
// Closure
Route::get('/backend/categories', function() {
    $list = Category::all();
    dd($list);
});

Route::get('/backend/suppliers', function() {
    $list = Supplier::all();
    dd($list);
});

Route::get('/backend/products', function() {
    $list = Product::all();
    // dd($list);
    return view('backend.products.index')
        ->with('listProducts', $list);
});

Route::get('/admin/dashboard', 'Backend\PageController@dashboard')->name('backend.pages.dashboard');
Route::get('/admin/products', 'Backend\ProductController@index')->name('backend.products.index');

Route::get('/admin/categories', 'Backend\CategoryController@index')->name('backend.categories.index');
Route::get('/admin/categories/create', 'Backend\CategoryController@create')->name('backend.categories.create');
Route::post('/admin/categories/store', 'Backend\CategoryController@store')->name('backend.categories.store');
Route::get('/admin/categories/{id}/edit', 'Backend\CategoryController@edit')->name('backend.categories.edit');
Route::post('/admin/categories/{id}/update', 'Backend\CategoryController@update')->name('backend.categories.update');
Route::delete('/admin/categories/{id}', 'Backend\CategoryController@destroy')->name('backend.categories.destroy');