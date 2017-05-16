<?php
Route::get('/','HomeController@getIndex');
Route::get('logout', 'LoginController@getLogout');
Route::get('userProfile', 'HomeController@userProfile');
Route::get('restaurant', 'RestaurantController@index');
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
    Route::get('index', 'PostController@index');
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
    Route::get('reset_menu', 'PostController@reset_menu');
    Route::post('reset_menu', 'PostController@reset_menu');
    Route::get('them_hang/{id_post}', 'PostController@them_hang');
    Route::post('them_hang/{id_post}', 'PostController@them_hang');
});
Route::get('map', 'GoogleController@map');
Route::get('google_map', 'GoogleController@google_map');
Route::get('google/buy/{id}', 'GoogleController@buy');
Route::get('bai2', 'GoogleController@bai2');

Route::group(['prefix' => 'restaurant', 'middleware' => 'restaurant'], function () {
    Route::get('index', 'RestaurantController@index');
    Route::post('add_food', 'RestaurantController@add_food');
    Route::post('add_post', 'RestaurantController@add_post');
    Route::post('edit_post/{id}', 'RestaurantController@edit_post');
    Route::post('update_post/{id}', 'RestaurantController@update_post');
    Route::post('delete_post/{id}', 'RestaurantController@delete_post');
    Route::post('edit_food/{id}', 'RestaurantController@edit_food');
    Route::post('update_food/{id}', 'RestaurantController@update_food');
    Route::post('delete_food/{id}', 'RestaurantController@delete_food');
});

