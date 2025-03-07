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

//In Headers
//Accept => application/json
Route::post('login', 'Api\AuthController@login');

Route::group(['middleware' => 'auth:api', 'namespace' => 'Api'], function () {
    Route::get('/user', 'UserController@index');

    Route::apiResource('categories', 'CategoryController'); //all categories with movies
    Route::apiResource('movies', 'MovieController'); //show movie with reviews and actors
    Route::apiResource('actors', 'ActorController'); //show actor
});
