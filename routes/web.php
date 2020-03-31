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

Route::get('/callall', 'DBInputController@callAll')->name('callall');
Route::get('/bn/bangladesh', 'MainController@getBanglaBangladesh')->name('bn-bangladesh');
Route::get('/en/bangladesh', 'MainController@getEnglishBangladesh')->name('en-bangladesh');
Route::get('/bn/world', 'MainController@getBanglaWorld')->name('bn-world');
Route::get('/en/world', 'MainController@getEnglishWorld')->name('en-world');
Route::get('/bn/countries', 'MainController@getBanglaAllCountry')->name('bn-countries');
Route::get('/en/countries', 'MainController@getEnglishAllCountry')->name('en-countries');
Route::get('/bn/districts', 'MainController@getBanglaAllDistrict')->name('bn-districts');
Route::get('/en/districts', 'MainController@getEnglishAllDistrict')->name('en-districts');
ROute::get('/bn/country/{name}', 'MainController@getBanglaCountry')->name('bn-country-name');
ROute::get('/en/country/{name}', 'MainController@getEnglishCountry')->name('en-country-name');
ROute::get('/bn/district/{name}', 'MainController@getBanglaDistrict')->name('bn-district-name');
ROute::get('/en/district/{name}', 'MainController@getEnglishDistrict')->name('en-district-name');
Route::get('callf', 'MainController@callFunc');
