<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('register', 'Auth\AuthController@register');
Route::post('login', 'Auth\AuthController@login');

Route::get('tasks', 'Admin\TaskAPIController@index');

Route::group(['prefix' => 'admin', 'middleware' => 'auth:api'], function () {   
    Route::resource('dealers', 'Admin\DealerAPIController');
    Route::resource('tasks', 'Admin\TaskAPIController');
});