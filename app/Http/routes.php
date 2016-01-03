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
    if (Auth::check()) {
        $feed_items = Auth::user()->feed()->paginate();
    } else {
        $feed_items = [];
    }
    return view('static_pages.home')->with(['feed_items' => $feed_items]);
});

Route::get('help', function () {
    return view('static_pages.help');
});

Route::get('about', function () {
    return view('static_pages.about');
});

Route::resource('user', 'UsersController', ['only' => ['show', 'edit', 'update', 'index', 'destroy']]);

Route::get('user/{id}/following', 'UsersController@following');
Route::get('user/{id}/followers', 'UsersController@followers');
Route::post('user/{id}/follow',   'UsersController@follow');
Route::post('user/{id}/unfollow', 'UsersController@unfollow');

Route::get('auth/register',  'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
Route::get('auth/login',     'Auth\AuthController@getLogin');
Route::post('auth/login',     'Auth\AuthController@postLogin');
Route::get('auth/logout',     'Auth\AuthController@getLogout');

Route::resource('micropost', 'MicropostsController', ['only' => ['store', 'destroy']]);
