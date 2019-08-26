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

Route::group(['middleware' => 'auth'], function()
{
    Route::get('/admin/dashboard', 'Backend\PageController@dashboard')->name('backend.pages.dashboard');

    Route::get('/admin/products', 'Backend\ProductController@index')->name('backend.products.index');
    Route::get('/admin/products/create', 'Backend\ProductController@create')->name('backend.products.create');
    Route::post('/admin/products/store', 'Backend\ProductController@store')->name('backend.products.store');
    Route::get('/admin/products/{id}/edit', 'Backend\ProductController@edit')->name('backend.products.edit');
    Route::post('/admin/products/{id}/update', 'Backend\ProductController@update')->name('backend.products.update');
    Route::delete('/admin/products/{id}', 'Backend\ProductController@destroy')->name('backend.products.destroy');

    Route::get('/admin/categories', 'Backend\CategoryController@index')->name('backend.categories.index');
    Route::get('/admin/categories/create', 'Backend\CategoryController@create')->name('backend.categories.create');
    Route::post('/admin/categories/store', 'Backend\CategoryController@store')->name('backend.categories.store');
    Route::get('/admin/categories/{id}/edit', 'Backend\CategoryController@edit')->name('backend.categories.edit');
    Route::post('/admin/categories/{id}/update', 'Backend\CategoryController@update')->name('backend.categories.update');
    Route::delete('/admin/categories/{id}', 'Backend\CategoryController@destroy')->name('backend.categories.destroy');
    Route::get('/admin/categories/print', 'Backend\CategoryController@print')->name('backend.categories.print');

    // Đơn hàng
    Route::get('/admin/orders', 'Backend\OrderController@index')->name('backend.orders.index');
    Route::get('/admin/orders/create', 'Backend\OrderController@create')->name('backend.orders.create');
    Route::post('/admin/orders/store', 'Backend\OrderController@store')->name('backend.orders.store');
    Route::get('/admin/orders/{id}/edit', 'Backend\OrderController@edit')->name('backend.orders.edit');
    Route::post('/admin/orders/{id}/update', 'Backend\OrderController@update')->name('backend.orders.update');
    Route::delete('/admin/orders/{id}', 'Backend\OrderController@destroy')->name('backend.orders.destroy');
    Route::get('/admin/orders/print', 'Backend\OrderController@print')->name('backend.orders.print');
    
    // AJAX
    Route::get('/admin/api/getProductCount', 'Backend\Api\ApiController@getProductCount')->name('backend.api.getProductCount');
    Route::get('/admin/api/getStatiticsCategoryProductCount', 'Backend\Api\ApiController@getStatiticsCategoryProductCount')->name('backend.api.getStatiticsCategoryProductCount');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/testMail', 'BackEnd\PageController@testMail');