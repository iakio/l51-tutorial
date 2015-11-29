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
    return view('static_pages.home');
});

Route::get('help', function () {
    return view('static_pages.help');
});

Route::get('about', function () {
    return view('static_pages.about');
});

Route::get('users/{id}',      'UsersController@show');
Route::get('users/{id}/edit', 'UsersController@edit');
Route::post('users/{id}',     'UsersController@update');
Route::get('users',           'UsersController@index');
Route::delete('users/{id}',   'UsersController@destroy');

Route::get('auth/register',  'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
Route::get('auth/login',     'Auth\AuthController@getLogin');
Route::post('auth/login',     'Auth\AuthController@postLogin');
Route::get('auth/logout',     'Auth\AuthController@getLogout');
