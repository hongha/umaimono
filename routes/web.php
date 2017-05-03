<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/','HomeController@getIndex');
Route::get('logout', 'LoginController@getLogout');
Route::get('userProfile', 'HomeController@userProfile');
Route::get('index', 'HomeController@getIndex');
Route::group(['middleware' => 'viewer'], function () {
    Route::get('login', 'LoginController@getLogin');
	Route::post('login', 'LoginController@postLogin');
	Route::get('register', 'RegisterController@create');
	// Route::post('register', 'RegisterController@store');
    Route::post('register', 'RegisterController@store');
});

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('xxx', function ()    {
    	echo "day la admin";
    });
    Route::get('index', 'AdminController@index');

});
Route::group(['prefix' => 'user', 'middleware' => 'user'], function () {
    Route::get('', function ()    {
    	echo "day la user";
    });
    Route::get('index', 'UserController@index');

});
Route::group(['prefix' => 'post'], function () {
    Route::get('create', 'PostController@create');
    Route::post('create', 'PostController@store');
    Route::get('edit/{id}', 'PostController@edit');
    Route::post('edit/{id}', 'PostController@update');
});