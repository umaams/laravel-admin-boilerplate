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

Route::prefix('users')->group(function() {
    Route::get('/', 'UserController@index');
    Route::get('/create', 'UserController@create');
    Route::post('/', 'UserController@store');
    Route::get('/{id}/edit', 'UserController@edit');
    Route::put('/{id}/password', 'UserController@updatePassword');
    Route::put('/{id}', 'UserController@update');
    Route::delete('/{id}', 'UserController@destroy');
    Route::get('/datatable', 'UserController@datatable');
    Route::get('/{id}', 'UserController@show'); 
});
