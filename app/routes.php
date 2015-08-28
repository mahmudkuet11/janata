<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

/*
*	customer
*/
Route::post('/add/customer', array(
		'as'	=>	'postAddCustomer',
		'uses'	=>	'CustomerController@postAddNewCustomer'
	));
Route::get('/get/customer', array(
		'as'	=>	'getCustomer',
		'uses'	=>	'CustomerController@getCustomer'
	));
Route::post('/edit/customer', array(
		'as'	=>	'postEditCustomer',
		'uses'	=>	'CustomerController@postEditCustomer'
	));
Route::post('/delete/customer', array(
		'as'	=>	'postDeleteCustomer',
		'uses'	=>	'CustomerController@postDeleteCustomer'
	));

/*
*	supplier
*/
Route::post('/add/supplier', array(
		'as'	=>	'postAddSupplier',
		'uses'	=>	'SupplierController@postAddSupplier'
	));
Route::get('/get/supplier', array(
		'as'	=>	'getSupplier',
		'uses'	=>	'SupplierController@getSupplier'
	));
Route::post('/edit/supplier', array(
		'as'	=>	'postEditSupplier',
		'uses'	=>	'SupplierController@postEditSupplier'
	));
Route::post('/delete/supplier', array(
		'as'	=>	'postDeleteSupplier',
		'uses'	=>	'SupplierController@postDeleteSupplier'
	));

/*
*	category
*/
Route::post('/add/category', array(
		'as'	=>	'postAddCategory',
		'uses'	=>	'CategoryController@postAddCategory'
	));
Route::get('/get/category', array(
		'as'	=>	'getAllCategories',
		'uses'	=>	'CategoryController@getAllCategories'
	));
Route::post('/edit/category', array(
		'as'	=>	'postEditCategory',
		'uses'	=>	'CategoryController@postEditCategory'
	));
Route::post('/delete/category', array(
		'as'	=>	'postDeleteCategory',
		'uses'	=>	'CategoryController@postDeleteCategory'
	));

/*
*	expense
*/

Route::post('/add/expense-category', array(
		'as'	=>	'postAddExpenseCategory',
		'uses'	=>	'ExpenseController@postAddExpenseCategory'
	));
Route::get('/get/expense-category', array(
		'as'	=>	'getAllExpenseCategories',
		'uses'	=>	'ExpenseController@getAllExpenseCategories'
	));
Route::post('/edit/expense-category', array(
		'as'	=>	'postEditExpenseCategory',
		'uses'	=>	'ExpenseController@postEditExpenseCategory'
	));
Route::post('/delete/expense-category', array(
		'as'	=>	'postDeleteExpenseCategory',
		'uses'	=>	'ExpenseController@postDeleteExpenseCategory'
	));

/*
*	purchase
*/
Route::post('/add/purchase-voucher', array(
		'as'	=>	'postAddPurchaseVoucher',
		'uses'	=>	'PurchaseController@postAddPurchaseVoucher'
	));
Route::get('/get/purchase-voucher', array(
		'as'	=>	'getPurchaseVoucher',
		'uses'	=>	'PurchaseController@getPurchaseVoucher'
	));

/*
*	Sell
*/
Route::post('/add/sell-voucher', array(
		'as'	=>	'postAddSellVoucher',
		'uses'	=>	'SellController@postAddSellVoucher'
	));
Route::get('/get/sell-voucher', array(
		'as'	=>	'getSellVoucher',
		'uses'	=>	'SellController@getSellVoucher'
	));

/*
*	Due
*/
Route::post('/add/due-voucher', array(
		'as'	=>	'postAddDueVoucher',
		'uses'	=>	'DueController@postAddDueVoucher'
	));
Route::get('/get/due-voucher', array(
		'as'	=>	'getAllDueVouchers',
		'uses'	=>	'DueController@getAllDueVouchers'
	));
Route::get('/get/due-voucher/{id}', array(
		'as'	=>	'getAllDueVouchersByCustomer',
		'uses'	=>	'DueController@getAllDueVouchersByCustomer'
	));

/*
*	Expense
*/
Route::post('/add/expense-voucher', array(
		'as'	=>	'postAddExpenseVoucher',
		'uses'	=>	'ExpenseController@postAddExpenseVoucher'
	));
Route::get('/get/expense-voucher', array(
		'as'	=>	'getAllExpenseVoucher',
		'uses'	=>	'ExpenseController@getAllExpenseVoucher'
	));


/*
*	Report
*/
Route::get('/report/purchase', array(
		'as'	=>	'getPurchaseReport',
		'uses'	=>	'ReportController@getPurchaseReport'
	));
Route::get('/report/purchase/{supplier_id}', array(
		'as'	=>	'getPurchaseReportBySupplier',
		'uses'	=>	'ReportController@getPurchaseReportBySupplier'
	));
Route::get('/report/sell', array(
		'as'	=>	'getSellReport',
		'uses'	=>	'ReportController@getSellReport'
	));
Route::get('/report/sell/{customer_id}', array(
		'as'	=>	'getSellReportByCustomer',
		'uses'	=>	'ReportController@getSellReportByCustomer'
	));
Route::get('/report/profit-loss', array(
		'as'	=>	'getProfitLossReport',
		'uses'	=>	'ReportController@getProfitLossReport'
	));
Route::get('/report/weight-loss', array(
		'as'	=>	'getWeightLossReport',
		'uses'	=>	'ReportController@getWeightLossReport'
	));
Route::get('/report/expense', array(
		'as'	=>	'getExpenseReport',
		'uses'	=>	'ReportController@getExpenseReport'
	));
Route::get('/report/due', array(
		'as'	=>	'getDueReport',
		'uses'	=>	'ReportController@getDueReport'
	));
Route::get('/report/stock', array(
		'as'	=>	'getStockReport',
		'uses'	=>	'ReportController@getStockReport'
	));
Route::get('/report/low-stock', array(
		'as'	=>	'getLowStockReport',
		'uses'	=>	'ReportController@getLowStockReport'
	));

/*
*	Authentication
*/
Route::get('/login', array(
		'as'	=>	'getLogin',
		'uses'	=>	'AccountController@getLogin'
	));