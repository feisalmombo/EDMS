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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', function () {
	return view('auth.login');
});

//Auth::routes();

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');





// Searching Pages
Route::get('/users/search', 'UsersController@search');
Route::get('/system-management/city/search', 'CityController@search');
Route::get('/system-management/country/search', 'CountryController@search');
Route::get('/system-management/state/search', 'StateController@search');
Route::get('/system-management/division/search', 'DivisionController@search');
Route::get('/system-management/department/search', 'DepartmentController@search');
Route::get('/employee-management/employee/search', 'EmployeeController@search');





Route::group(['middleware' => 'ValidateBackButtonHistory'], function() {


	Route::group(['middleware' => 'auth'], function() {
		
		Route::get('/home', 'HomeController@index')->name('home');
		Route::resource('/users', 'UsersController');
		Route::post('/users/search', 'UsersController@search')->name('/users.search');
		Route::post('/users/{user}/is-admin', 'UsersController@is_admin');

		Route::resource('/system-management/city', 'CityController');
		Route::post('/system-management/city/search', 'CityController@search')->name('/system-management.city.search');

		Route::resource('/system-management/country', 'CountryController');
		Route::post('/system-management/country/search', 'CountryController@search')->name('/system-management.country.search');


		Route::resource('/system-management/state', 'StateController');
		Route::post('/system-management/state/search', 'StateController@search')->name('/system-management.state.search');


		Route::resource('/system-management/division', 'DivisionController');
		Route::post('/system-management/division/search', 'DivisionController@search')->name('/system-management.division.search');


		Route::resource('/system-management/department', 'DepartmentController');
		Route::post('/system-management/department/search', 'DepartmentController@search')->name('/system-management.department.search');


		Route::resource('/employee-management/employee', 'EmployeeController');
		Route::post('/employee-management/employee/search', 'EmployeeController@search')->name('/employee-management.employee.search');

		Route::get('/account/change-password', 'AccountController@change_password');
		Route::post('/account/process_change_password', 'AccountController@process_change_password');

		Route::group(['middleware' => 'isAdmin'], function(){
			Route::post('/users/{user}/is-admin', 'UsersController@is_admin');
			
		});
	});	

});
