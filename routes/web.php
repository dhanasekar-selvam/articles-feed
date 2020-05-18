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

Route::get('/', function () {
    return view('welcome');
});


Route::get('index', 'UserController@index')->name('user.index');

Route::get('signup', 'UserController@create')->name('user.create');

Route::post('user/store', 'UserController@store')->name('user.store');

Route::get('user/login', 'UserController@login')->name('user.login');

Route::post('user/edit', 'UserController@edit')->name('user.edit');

Route::post('user/like', 'UserController@like')->name('user.like');

Route::post('user/dislike', 'UserController@dislike')->name('user.dislike');

Route::post('user/block', 'UserController@block')->name('user.block');





//Route::get('dashboard/index', 'DashboardController@index')->name('dashboard.index');

Route::get('dashboard/create', 'DashboardController@create')->name('dashboard.create');

Route::post('dashboard/store', 'DashboardController@store')->name('dashboard.store');


Route::get('dashboard/list', 'DashboardController@list')->name('dashboard.list');

Route::get('dashboard/view', 'DashboardController@view')->name('dashboard.view');


Route::get('dashboard/edit', 'DashboardController@edit')->name('dashboard.edit');

Route::post('dashboard/like', 'DashboardController@like')->name('dashboard.like');

Route::get('dashboard/logout', 'DashboardController@logout')->name('dashboard.logout');







Route::get('/home', 'HomeController@index')->name('home');
