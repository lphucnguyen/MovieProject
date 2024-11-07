<?php

use Illuminate\Support\Facades\Auth;
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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes(['reset' => false]);
Route::any('logout', 'Auth\LoginController@logout')->name('web.logout');

Route::get('/', 'HomeController@index');
Route::get('/search', 'HomeController@search');
Route::post('/message', 'HomeController@message');
Route::get('/contact-us', 'HomeController@contact');

Route::get('/movies', 'MovieController@index');
Route::get('/movies/{uuid}', 'MovieController@show');

Route::group(['name' => 'actors', 'prefix' => 'actors'], function () {
    // Route::get('/', \App\Http\Controllers\Actor\ShowController::class);
    Route::get('/{uuid}', \App\Http\Controllers\Actor\GetActorController::class);
});

Route::group(['middleware' => 'auth'], function () {
    // User Routes
    Route::get('/user/profile', \App\Http\Controllers\User\ShowProfileController::class);
    Route::put('/user/profile/{uuid}', \App\Http\Controllers\User\UpdateProfileController::class);
    Route::get('/user/change_password', \App\Http\Controllers\User\ShowChangePasswordController::class);
    Route::put('/user/change_password/{uuid}', \App\Http\Controllers\User\ChangePasswordController::class);
    Route::get('/user/favorites', \App\Http\Controllers\User\ShowFavoritesController::class);
    Route::get('/user/ratings', \App\Http\Controllers\User\ShowRatingsController::class);
    Route::get('/user/reviews', \App\Http\Controllers\User\ShowReviewsController::class);
    Route::get('/user/transactions', \App\Http\Controllers\User\ShowTransactionsController::class);
    Route::post('/user/addToFavorite/{uuid}', 'FavoriteController@store');
    Route::post('/user/removeFromFavorite/{uuid}', 'FavoriteController@destroy');
    Route::post('/user/rate/{uuid}', 'RateController@store');
    Route::post('/user/review/{uuid}', 'ReviewController@store');
    Route::delete('/user/review/{uuid}', 'ReviewController@destroy');
});
