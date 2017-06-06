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

Route::bind('product', function($id) {
    return app(\App\Repositories\ProductRepository::class)->find($id);
});

Route::bind('asset', function($id) {
    return \LaravelDoctrine\ORM\Facades\EntityManager::getRepository(App\Entities\Asset::class)->findOneBy(['id' => $id]);
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/nodes', 'NodeController@index')->name('nodes.index');
    Route::get('/nodes/{node}', 'NodeController@show')->name('nodes.show');

    Route::get('/members', 'MemberController@index')->name('members.index');
    Route::get('/members/{member}', 'MemberController@show')->name('members.show');

    Route::get('assets', 'AssetController@index')->name('assets.index');
    Route::get('assets/create', 'AssetController@create')->name('assets.create');
    Route::post('assets', 'AssetController@store')->name('assets.store');
    Route::get('assets/{asset}', 'AssetController@show')->name('assets.show');
    Route::get('assets/{asset}/reassign', 'ReassignAssetController@create')->name('assets.reassign');
    Route::post('assets/{asset}/reassign', 'ReassignAssetController@update')->name('assets.doreassign');
});


Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('login/airstream', 'Auth\LoginController@redirectToAirStream')->name('login.airstream');
Route::get('login/airstream/callback', 'Auth\LoginController@handleAirStreamCallback');

Route::post('logout', 'Auth\LoginController@logout')->name('logout');
