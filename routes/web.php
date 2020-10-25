<?php

use Illuminate\Support\Facades\Route;

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
    return view('home');
});

// Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => 'element'], function () {
    Route::get('/{id?}', 'ElementController@get');
    Route::post('create', 'ElementController@create');
    Route::post('update', 'ElementController@update');
    Route::post('delete', 'ElementController@delete');
});

Route::group(['prefix' => 'product'], function () {
    Route::get('/{id?}', 'ProductController@get');
    Route::post('create', 'ProductController@create');
    Route::post('update', 'ProductController@update');
    Route::post('delete', 'ProductController@delete');
});

Route::group(['prefix' => 'group'], function () {
    Route::get('/{id?}', 'GroupController@get');
    Route::post('create', 'GroupController@create');
    Route::post('update', 'GroupController@update');
    Route::post('delete', 'GroupController@delete');
});
