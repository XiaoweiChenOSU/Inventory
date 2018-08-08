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

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'customer'], function () {

	Route::get('/create', 'CustomerController@create');
	Route::post('/store', 'CustomerController@store');
	Route::get('/view', 'CustomerController@view');
	Route::get('/index', 'CustomerController@index');
	Route::get('/show/{id}', 'CustomerController@show');
	Route::get('/edit/{id}', 'CustomerController@edit');
	Route::post('/update/{id}', 'CustomerController@update');
	Route::get('/destroy/{id}', 'CustomerController@destroy');

});

Route::group(['prefix' => 'supplier'], function () {

	Route::get('/create', 'SupplierController@create');
	Route::post('/store', 'SupplierController@store');
	Route::get('/view', 'SupplierController@view');
	Route::get('/index', 'SupplierController@index');
	Route::get('/show/{id}', 'SupplierController@show');
	Route::get('/edit/{id}', 'SupplierController@edit');
	Route::post('/update/{id}', 'SupplierController@update');
	Route::get('/destroy/{id}', 'SupplierController@destroy');

});

Route::group(['prefix' => 'kit'], function () {

	Route::get('/create', 'KitController@create');
	Route::post('/store', 'KitController@store');
	Route::get('/view', 'KitController@view');
	Route::get('/index', 'KitController@index');
	Route::get('/show/{id}', 'KitController@show');
	Route::get('/edit/{id}', 'KitController@edit');
	Route::post('/update/{id}', 'KitController@update');
	Route::get('/destroy/{id}', 'KitController@destroy');

});

Route::group(['prefix' => 'brand'], function () {

	Route::get('/create', 'BrandController@create');
	Route::post('/store', 'BrandController@store');
	Route::get('/view', 'BrandController@view');
	Route::get('/index', 'BrandController@index');
	Route::get('/show/{id}', 'BrandController@show');
	Route::get('/edit/{id}', 'BrandController@edit');
	Route::post('/update/{id}', 'BrandController@update');
	Route::get('/destroy/{id}', 'BrandController@destroy');

});

Route::group(['prefix' => 'status'], function () {

	Route::get('/create', 'StatusController@create');
	Route::post('/store', 'StatusController@store');
	Route::get('/view', 'StatusController@view');
	Route::get('/index', 'StatusController@index');
	Route::get('/show/{id}', 'StatusController@show');
	Route::get('/edit/{id}', 'StatusController@edit');
	Route::post('/update/{id}', 'StatusController@update');
	Route::get('/destroy/{id}', 'StatusController@destroy');

});

Route::group(['prefix' => 'classification'], function () {

	Route::get('/create', 'ClassificationController@create');
	Route::post('/store', 'ClassificationController@store');
	Route::get('/view', 'ClassificationController@view');
	Route::get('/index', 'ClassificationController@index');
	Route::get('/show/{id}', 'ClassificationController@show');
	Route::get('/edit/{id}', 'ClassificationController@edit');
	Route::post('/update/{id}', 'ClassificationController@update');
	Route::get('/destroy/{id}', 'ClassificationController@destroy');

});

Route::group(['prefix' => 'attribute'], function () {

	Route::get('/create', 'AttributeController@create');
	Route::post('/store', 'AttributeController@store');
	Route::get('/view', 'AttributeController@view');
	Route::get('/index', 'AttributeController@index');
	Route::get('/show/{id}', 'AttributeController@show');
	Route::get('/edit/{id}', 'AttributeController@edit');
	Route::post('/update/{id}', 'AttributeController@update');
	Route::get('/destroy/{id}', 'AttributeController@destroy');

});

Route::group(['prefix' => 'product'], function () {

	Route::get('/create', 'ProductController@create');
	Route::post('/store', 'ProductController@store');
	Route::get('/view', 'ProductController@view');
	Route::get('/index', 'ProductController@index');
	Route::get('/show/{id}', 'ProductController@show');
	Route::get('/edit/{id}', 'ProductController@edit');
	Route::post('/update/{id}', 'ProductController@update');
	Route::get('/destroy/{id}', 'ProductController@destroy');
	Route::get('/view/availability', 'ProductController@view_availability');
	Route::get('/get/availability', 'ProductController@get_availability');
	Route::get('/get_stock_count', 'ProductController@get_product_count');

});

Route::group(['prefix' => 'category'], function () {

	Route::get('/create', 'CategoryController@create');
	Route::post('/store', 'CategoryController@store');
	Route::get('/view', 'CategoryController@view');
	Route::get('/index', 'CategoryController@index');
	Route::get('/show/{id}', 'CategoryController@show');
	Route::get('/edit/{id}', 'CategoryController@edit');
	Route::post('/update/{id}', 'CategoryController@update');
	Route::get('/destroy/{id}', 'CategoryController@destroy');

});

Route::group(['prefix' => 'stock'], function () {

	Route::get('/create', 'StockController@create');
	Route::post('/store', 'StockController@store');
	Route::get('/view', 'StockController@view');
	Route::get('/index', 'StockController@index');
	Route::get('/show/{id}', 'StockController@show');
	Route::get('/edit/{id}', 'StockController@edit');
	Route::post('/update/{id}', 'StockController@update');
	Route::get('/destroy/{id}', 'StockController@destroy');
	Route::get('/view/availability', 'StockController@view_availability');
	Route::get('/get/availability', 'StockController@get_availability');
	Route::get('/get_stock_count', 'StockController@get_stock_count');
	Route::get('/get_warehouse_location', 'StockController@get_warehouse_location');
});

Route::group(['prefix' => 'item'], function () {

	Route::get('/create', 'ItemController@create');
	Route::post('/store', 'ItemController@store');
	Route::get('/view', 'ItemController@view');
	Route::get('/index', 'ItemController@index');
	Route::get('/audit', 'ItemController@audit');
	Route::get('/get_product', 'ItemController@get_product');
	Route::get('/show/{id}', 'ItemController@show');
	Route::get('/edit/{id}', 'ItemController@edit');
	Route::post('/update/{id}', 'ItemController@update');
	Route::get('/destroy/{id}', 'ItemController@destroy');

});

Route::group(['prefix' => 'purchase'], function () {

	Route::get('/create', 'PurchaseController@create');
	Route::post('/store', 'PurchaseController@store');
	Route::get('/view', 'PurchaseController@view');
	Route::get('/index', 'PurchaseController@index');
	Route::get('/show/{id}', 'PurchaseController@show');
	Route::get('/edit/{id}', 'PurchaseController@edit');
	Route::post('/update/{id}', 'PurchaseController@update');
	Route::get('/destroy/{id}', 'PurchaseController@destroy');

});

Route::group(['prefix' => 'sales'], function () {

	Route::get('/create', 'SalesController@create');
	Route::post('/store', 'SalesController@store');
	Route::get('/view', 'SalesController@view');
	Route::get('/index', 'SalesController@index');
	Route::get('/show/{id}', 'SalesController@show');
	Route::get('/edit/{id}', 'SalesController@edit');
	Route::post('/update/{id}', 'SalesController@update');
	Route::get('/destroy/{id}', 'SalesController@destroy');

});

Route::group(['prefix' => 'transaction'], function () {

	Route::get('/payments', 'TransactionController@payments');
	Route::get('/get_payments', 'TransactionController@get_payments');
	Route::get('/outstandings', 'TransactionController@outstandings');
	Route::get('/get_outstandings', 'TransactionController@get_outstandings');

});

Route::group(['prefix' => 'search'], function () {

	Route::any('/supplier_name', 'SearchController@supplier_name');

	Route::any('/stock_name', 'SearchController@stock_name');

	Route::any('/customer_name', 'SearchController@customer_name');

	Route::any('/category_name', 'SearchController@category_name');

	Route::any('/purchase_category_name', 'SearchController@purchase_category_name');

	Route::any('/product_code', 'SearchController@product_code');

	Route::any('/product_sku', 'SearchController@product_sku');

});


Route::group(['prefix' => 'report'], function () {

	Route::get('/generate', 'ReportController@generate');

	Route::any('/view_report', 'ReportController@view_report');

	Route::any('/pdf_report', 'ReportController@pdf_report');

});