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

Auth::routes(['reset' => false]);

Route::get('/', \App\Presentation\Http\Controllers\Home\ShowHomeController::class)->name('home');
Route::get('/search', \App\Presentation\Http\Controllers\Home\SearchController::class)->name('search');
Route::post('/message', \App\Presentation\Http\Controllers\Home\SendMessageController::class)->name('message');
Route::get('/contact-us', \App\Presentation\Http\Controllers\Home\ShowContactController::class)->name('contact');
Route::get('/movies', \App\Presentation\Http\Controllers\Home\ShowMoviesController::class)->name('movies');
Route::get('/movies/{uuid}', \App\Presentation\Http\Controllers\Home\ShowMovieController::class)->name('movie.show');

Route::group(['name' => 'actors', 'prefix' => 'actors'], function () {
    Route::get('/', \App\Presentation\Http\Controllers\Actor\ShowActorsController::class);
    Route::get('/{uuid}', \App\Presentation\Http\Controllers\Actor\ShowActorController::class)->name('actor.show');
});

Route::group(['middleware' => 'auth', 'prefix' => 'user'], function () {
    Route::get('/profile', \App\Presentation\Http\Controllers\User\ShowProfileController::class)
    ->name('user');
    Route::put('/profile/{uuid}', \App\Presentation\Http\Controllers\User\UpdateProfileController::class)
    ->name('user-profile');
    Route::get('/change_password', \App\Presentation\Http\Controllers\User\ShowChangePasswordController::class)
    ->name('user-password');
    Route::any('logout', 'Auth\LoginController@logout')
    ->name('user.logout');
    Route::put('/change_password/{uuid}', \App\Presentation\Http\Controllers\User\ChangePasswordController::class)
    ->name('user.change-password');
    Route::get('/upgrade-account/{orderId?}', \App\Presentation\Http\Controllers\User\ShowUpgradeAccountController::class)
    ->name('user.upgrade-account');
    Route::get('/favorites', \App\Presentation\Http\Controllers\User\ShowFavoritesController::class)
    ->name('user.favorites');
    Route::get('/ratings', \App\Presentation\Http\Controllers\User\ShowRatingsController::class)
    ->name('user.ratings');
    Route::get('/reviews', \App\Presentation\Http\Controllers\User\ShowReviewsController::class)
    ->name('user.reviews');
    Route::get('/orders', \App\Presentation\Http\Controllers\User\ShowOrdersController::class)
    ->name('user.orders');
    Route::get('/orders/{uuid}', \App\Presentation\Http\Controllers\User\ShowOrderController::class)
    ->name('user.order');
    Route::delete('/orders/{orderId}', \App\Presentation\Http\Controllers\User\CancelOrderController::class)
    ->name('user.cancel-order');
    Route::post('/addToFavorite/{uuid}', \App\Presentation\Http\Controllers\User\AddFavoriteController::class)
    ->name('user.add-to-favorite');
    Route::post('/removeFromFavorite/{uuid}', \App\Presentation\Http\Controllers\User\RemoveFavoriteController::class)
    ->name('user.remove-from-favorite');
    Route::post('/rate/{uuid}', \App\Presentation\Http\Controllers\User\AddRateController::class)
    ->name('user.add-rate');
    Route::post('/review/{uuid}', \App\Presentation\Http\Controllers\User\AddReviewController::class)
    ->name('user.add-review');
    Route::delete('/review/{uuid}', \App\Presentation\Http\Controllers\User\RemoveReviewController::class)
    ->name('user.remove-review');
});

Route::group(['middleware' => ['auth', 'unsubcribed'], 'prefix' => 'payment'], function () {
    Route::post('/pay', \App\Presentation\Http\Controllers\Payment\PayController::class)
    ->name('pay');
    Route::get('/approval', \App\Presentation\Http\Controllers\Payment\ApprovalController::class)
    ->name('approval');
    Route::get('/cancelled', \App\Presentation\Http\Controllers\Payment\CancelledController::class)
    ->name('cancelled');
});
