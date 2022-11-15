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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();


Route::group(['middleware' => 'auth'],function(){

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/home/delete-multiple', 'HomeController@deleteMultiple')->name('home.delete-multiple');
    Route::get('/home/change-multiple-status', 'HomeController@changeMultipleStatus')->name('home.change-multiple-status');

    Route::resource('user','UserController');

    Route::resource('category','CategoryController');

    Route::resource('product','ProductController');
    Route::get('product_export', 'ProductController@product_export')->name('product.export');
    Route::post('product_import', 'ProductController@product_import')->name('product.import');
    
    Route::resource('stock','StockController');
    Route::post('get/product','StockController@geteproduct')->name('stock.product');
    
    Route::get('inventory','InventoryController@index')->name('inventory');
    
    Route::resource('customer','CustomerController');
    
    Route::resource('salesorder','SoController');
    Route::any('salesorder/get/status','SoController@status')->name('salesorder.status');
    Route::post('get/customer','SoController@getcustomer')->name('getcustomer');
    Route::post('salesorder/get/product','SoController@getproduct')->name('getproduct');
    Route::post('salesorder/get/serial','SoController@getserial')->name('getserial');
    Route::post('salesorder/get/price','SoController@getprice')->name('getprice');
    Route::get('sochild/delete/{id}','SoController@deletesochild')->name('sochild.delate');

    Route::resource('discount','DiscountController');
    
});

