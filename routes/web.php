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

Route::get('/quarantine', 'MainController@quarantine')->name('quarantine');
Route::get('/world', 'MainController@world')->name('world');
Route::get('/countries', 'MainController@countries')->name('countries');
Route::get('/zilas', 'MainController@zilas')->name('zilas');
Route::get('/test', 'MainController@test')->name('test');
