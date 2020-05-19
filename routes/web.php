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





//Route::get('articles/index', 'articlesController@index')->name('articles.index');

Route::get('articles/create', 'ArticlesController@create')->name('articles.create');

Route::post('articles/store', 'ArticlesController@store')->name('articles.store');

Route::post('articles/update', 'ArticlesController@update')->name('articles.update');



Route::get('articles/list', 'ArticlesController@list')->name('articles.list');

Route::get('articles/view', 'ArticlesController@view')->name('articles.view');


Route::get('articles/edit', 'ArticlesController@edit')->name('articles.edit');

Route::get('articles/{id}/edit', 'ArticlesController@editNext')->name('articles.editNext');

Route::get('articles/{id}/delete', 'ArticlesController@delete')->name('articles.delete');



Route::post('articles/like', 'UserController@like')->name('articles.like');



Route::get('articles/logout', 'ArticlesController@logout')->name('articles.logout');







Route::get('/home', 'HomeController@index')->name('home');
