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

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', 'HomeController@index')->name('home');
});


Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('login/airstream', 'Auth\LoginController@redirectToAirStream')->name('login.airstream');
Route::get('login/airstream/callback', 'Auth\LoginController@handleAirStreamCallback');

Route::post('logout', 'Auth\LoginController@logout')->name('logout');
