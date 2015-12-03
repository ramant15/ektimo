<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');
Route::post('home/complete-order', 'HomeController@complete_order');
Route::get('home/edit-order/{id}', 'HomeController@edit_order');
Route::post('home/update-order/{id}', 'HomeController@update_order');
Route::get('home/order-reveiw/{id}', 'HomeController@order_reveiw');
Route::post('home/get-booked', 'HomeController@get_booked');
Route::get('home/cancel-order/{id}', 'HomeController@cancel_order');

Route::get('home', 'HomeController@index');
Route::get('/order', 'OrderController@index');
Route::post('order/getParameter/{id}', 'OrderController@getParameter');
Route::post('order/getState', 'OrderController@getState');
Route::post('order/getMethod', 'OrderController@getMethod');
Route::post('order/getTestMethod', 'OrderController@getTestMethod');
Route::post('order/saveClientOrder', 'OrderController@saveClientOrder');

Route::get('order/customer-orders/{id}', 'OrderController@customerOrders');
Route::get('order/getOrder/{id}', 'OrderController@getOrder');
Route::get('order/getItem/{id}', 'OrderController@getItem');
Route::get('customer/siteDetail', 'CustomersController@siteDetail');
Route::post('customer/addSiteDetail', 'CustomersController@addSiteDetail');
Route::get('customer/testLocation', 'CustomersController@testLocation');
Route::post('customer/addTestLocation', 'CustomersController@addTestLocation');
Route::get('customers/siteTestLocation/{id}', 'CustomersController@siteTestLocation');
Route::get('customers/siteEdit', 'CustomersController@siteEdit');
Route::post('customers/siteUpdate', 'CustomersController@siteUpdate');
Route::get('customers/locationEdit', 'CustomersController@locationEdit');
Route::post('customers/locationUpdate', 'CustomersController@locationUpdate');
Route::resource('customers','CustomersController');

Route::get('technician/jobs', 'TechnicianController@jobs');
Route::get('technician/download_files', 'TechnicianController@download_files');
Route::get('technician/job_detail/{id}', 'TechnicianController@job_detail');
Route::post('technician/job_detail/{id}', 'TechnicianController@job_upload');

Route::get('/work-schedule', function () {
	include (public_path().'/work-schedule/index.php');
});
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

 
Route::group(['namespace' => 'admin', 'prefix' => 'admin','middleware' => 'App\Http\Middleware\AdminMiddleware'], function()
{	
	 
	Route::get('login', 'AuthController@getLogin');
	Route::post('auth/dologin', 'AuthController@dologin');
	Route::get('auth/logout', 'Auth\AuthController@getLogout');
	Route::get('logout', 'AuthController@getLogout');
	Route::get('home', 'HomeController@index');
	Route::get('tests/process_items/{id}', 'TestsController@process_items'); 
	Route::resource('users','UsersController');
	Route::resource('marketplaces','MarketplacesController');
	Route::resource('products','ProductsController');
	Route::resource('processes','ProcessesController');
	//Route::resource('processItems','ProcessItemsController');
	Route::resource('process-items','ProcessItemsController');
	Route::resource('tests','TestsController');
	Route::resource('location-types','LocationTypeController');
	
	
});
 
 
