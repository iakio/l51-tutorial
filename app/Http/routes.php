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

Route::get('static_pages/home', function () {
    return view('static_pages.home')->withTitle("Home");
});
Route::get('static_pages/help', function () {
    return view('static_pages.help')->withTitle("Help");
});
Route::get('static_pages/about', function () {
    return view('static_pages.about')->withTitle("About Us");
});
