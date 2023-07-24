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
    Route::resource('task','TaskController');
    Route::resource('location','LocationController');
    Route::resource('leave','LeaveController');
    Route::post('leave/getemployee','LeaveController@getemployee')->name('leave.getemployee');

    Route::resource('category','CategoryController');

    Route::resource('product','ProductController');
    Route::get('product_export', 'ProductController@product_export')->name('product.export');
    Route::post('product_import', 'ProductController@product_import')->name('product.import');
    
    Route::resource('stock','StockController');
    Route::post('get/product','StockController@geteproduct')->name('stock.product');
    
    Route::get('inventory','InventoryController@index')->name('inventory');
    
    Route::resource('customer','CustomerController');
    Route::resource('group','GroupController');
    
    Route::resource('salesorder','SoController');
    Route::any('salesorder/get/status','SoController@status')->name('salesorder.status');
    Route::post('get/customer','SoController@getcustomer')->name('getcustomer');
    Route::post('salesorder/get/product','SoController@getproduct')->name('getproduct');
    Route::post('salesorder/new/product','SoController@newproduct')->name('newproduct');
    Route::post('salesorder/get/serial','SoController@getserial')->name('getserial');
    Route::post('salesorder/old/serial','SoController@oldserial')->name('oldserial');
    Route::post('salesorder/get/price','SoController@getprice')->name('getprice');
    Route::get('sochild/delete/{id}','SoController@deletesochild')->name('sochild.delate');
    Route::get('sochild/download/{id}','SoController@download')->name('sochild.download');

    Route::resource('discount','DiscountController');
    
    Route::post('salesorder/pro/get/product','SoController@progetproduct')->name('pro.getproduct');
    Route::post('salesorder/pro/get/serial','SoController@progetserial')->name('pro.getserial');
    Route::post('salesorder/get/dop','SoController@getdop')->name('getdop');
    Route::post('salesorder/get/editdop','SoController@editgetdop')->name('editgetdop');
    Route::post('salesorder/pdf', 'SoController@pdf')->name('pdf');


    Route::get('returnstock/index','ReportsController@returnstock')->name('returnstock');
    Route::get('reportserialno','ReportsController@reportserialno')->name('reportserialno');
    Route::post('reportserialno/getdata','ReportsController@getdata')->name('report.getdata');
    Route::get('returnstock/view/{id}','ReportsController@returnstockview')->name('returnstock.view');
    Route::post('returnstock/get/product','ReportsController@getproduct')->name('returnstock.getproduct');
    Route::get('/bsr/create/{id}', 'SoController@bsr')->name('bsr.create');
    Route::post('/bsr/store/', 'SoController@bsr_store')->name('bsr.store');
    Route::post('/bsr/status/', 'SoController@bsr_status')->name('bsr.status');
    Route::post('bsr/completed','SoController@completed')->name('bsr.completed');


    Route::get('replacestock/','ReportsController@replacestock')->name('replacestock');
    Route::any('/exports/replacestockreport', 'ReportsController@replacereportexcel')->name('replacestock.export');
    Route::any('/exports/returnstockreport', 'ReportsController@returnstockexcel')->name('returnstock.export');
    Route::get('invereport/','ReportsController@invereport')->name('invereport');
    Route::any('/exports/invereport', 'ReportsController@inveeportexcel')->name('investock.export');
    Route::any('attendance/report','ReportsController@attendance')->name('attendance.index');
    Route::any('holidays/month','HolidayController@month')->name('holiday.month');
    Route::post('leave/status','LeaveController@status')->name('leave.status');
    // Route::get('regularize/index','ReportsController@regularizeindex')->name('regularize.index');
    // Route::post('store/regularize/{id}','ReportsController@storeregularize')->name('store.regularize');



    Route::resource('gst','GstController');
    Route::get('gst_export', 'GstController@gst_export')->name('gst_export');
    Route::post('gst_import', 'GstController@gst_import')->name('gst_import');
    
    Route::resource('hsn','HsnController');
    Route::get('hsn_export', 'HsnController@hsn_export')->name('hsn_export');
    Route::post('hsn_import', 'HsnController@hsn_import')->name('hsn_import');

    Route::resource('holiday','HolidayController');
    Route::resource('lead','LeadController');
    // Route::any('/holidays/multiple', 'HolidayController@multiple')->name('holiday.multiple');

    Route::resource('unit','UnitController');
    Route::resource('leavetype','LeaveTypeController');
    Route::resource('leavepolicy','LeavePolicyController');

    Route::resource('weekoff','WeekoffController');

    Route::post('get/employee','TaskController@getemployee')->name('getemployee');
    Route::post('get/status','TaskController@status')->name('task.status');

    // Route::resource('regularize','RegularizeControler');
    Route::get('regularize/','RegularizeControler@index')->name('regularize.index');
    Route::get('regularize/{id}','RegularizeControler@create')->name('regularize.create');
    Route::post('regularize/store','RegularizeControler@store')->name('regularize.store');
    Route::any('regularize/edit/{id}','RegularizeControler@edit')->name('regularize.edit');
    Route::any('regularize/show/{id}','RegularizeControler@show')->name('regularize.show');
    Route::post('regularize/update/{id}','RegularizeControler@update')->name('regularize.update');
    Route::post('regularize/status','RegularizeControler@regularizestatus')->name('regularize.status');
    Route::post('leave/report','LeaveController@leaveemployeereport')->name('leave.getEmployee.report');

    Route::get('punchIn','UserController@punchIn')->name('punch.in');
    Route::get('punchOut','UserController@punchOut')->name('punch.out');

});

