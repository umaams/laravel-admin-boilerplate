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

Route::prefix('permissions')->group(function() {
    Route::get('/', 'PermissionController@index');
    Route::get('/create', 'PermissionController@create');
    Route::post('/', 'PermissionController@store');
    Route::get('/{id}/edit', 'PermissionController@edit');
    Route::put('/{id}', 'PermissionController@update');
    Route::delete('/{id}', 'PermissionController@destroy');
});
