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

Route::prefix('menus')->group(function() {
    Route::get('/', 'MenuController@index');
    Route::get('/create', 'MenuController@create');
    Route::post('/', 'MenuController@store');
    Route::get('/{id}/edit', 'MenuController@edit');
    Route::put('/{id}', 'MenuController@update');
    Route::delete('/{id}', 'MenuController@destroy');
});
