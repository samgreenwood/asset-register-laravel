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

Route::bind('node', function($id) {
    return app(\App\Repositories\NodeRepository::class)->findById($id);
});

Route::bind('member', function($id) {
    return app(\App\Repositories\MemberRepository::class)->findById($id);
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/nodes', 'NodeController@index')->name('nodes.index');
    Route::get('/nodes/{node}', 'NodeController@show')->name('nodes.show');
    Route::get('/members', 'NodeController@index')->name('members.index');
    Route::get('/members/{member}', 'NodeController@show')->name('members.show');
    Route::resource('products', 'ProductController');
    Route::resource('assets', 'AssetController');
});


Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('login/airstream', 'Auth\LoginController@redirectToAirStream')->name('login.airstream');
Route::get('login/airstream/callback', 'Auth\LoginController@handleAirStreamCallback');

Route::post('logout', 'Auth\LoginController@logout')->name('logout');
