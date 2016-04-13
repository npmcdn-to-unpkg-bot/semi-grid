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

Route::get('/', function () {
    return view('welcome');
});

//Admin route
Route::group(['prefix' => 'admin'], function(){
	Route::get('login', 'Auth\AuthController@getLogin');
	Route::get('logout', 'Auth\AuthController@getLogout');
	Route::get('register', 'Auth\AuthController@getRegister');
	Route::post('register', 'Auth\AuthController@postRegister');
	Route::post('login', 'Auth\AuthController@postLogin');
	Route::controllers([
		'/blog' => 'Admin\BlogController',	//This blog route must before the root route.
		'/' => 'Admin\AdminController'		//This is root route.
	]);
});