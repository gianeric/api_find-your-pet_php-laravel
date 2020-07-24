<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/users', 'API\UserController@index');
Route::post('/users', 'API\UserController@store');
Route::get('/users/{id}', 'API\UserController@show');
Route::put('/users/{id}', 'API\UserController@update');
Route::delete('/users/{id}', 'API\UserController@destroy');
