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

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', 'QuickBookingController@index');
    Route::post('/', 'QuickBookingController@book');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::resource('customer', 'CustomerController');
    Route::resource('booking', 'BookingController');
    Route::resource('cleaner', 'CleanerController');
    Route::resource('city', 'CityController');
});
