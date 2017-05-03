<?php
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
    Route::get('delete/{id}', 'PostController@delete');
    Route::get('view/{id}', 'PostController@view');
    Route::get('add_food/{id_food}', 'PostController@add_food');
    Route::post('add_food/{id_food}', 'PostController@add_food');
    Route::get('minus_food/{id_food}', 'PostController@minus_food');
    Route::post('minus_food/{id_food}', 'PostController@minus_food');
    Route::get('reset_menu/{id_user}', 'PostController@reset_menu');
    Route::post('reset_menu/{id_user}', 'PostController@reset_menu');
});
Route::get('map', 'GoogleController@map');
Route::get('google_map', 'GoogleController@google_map');
Route::get('google/buy/{id}', 'GoogleController@buy');
Route::get('bai2', 'GoogleController@bai2');


