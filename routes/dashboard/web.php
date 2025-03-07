<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'dashboard', 'namespace' => 'Dashboard'], function () {
    Config::set('auth.defines', 'admin');

    Route::get('login', 'AuthController@showLoginForm')->name('dashboard.login');
    Route::post('login', 'AuthController@login');
    Route::any('logout', 'AuthController@logout')->name('dashboard.logout');

    Route::group(['middleware' => 'adminAuth:admin', 'as' => 'dashboard.'], function () {
        Route::get('/', 'HomeController@index')->name('home');

        Route::put('admins/{uuid}/update-permissions', 'AdminController@updatePermissions')->name('admins.updatePermissions');
        Route::resource('admins', 'AdminController')->except(['show']);
        Route::resource('clients', 'ClientController')->except(['show']);
        Route::resource('films', 'FilmController');
        Route::resource('plans', 'PlanController');
        Route::resource('subscriptions', 'SubscriptionController');
        Route::resource('actors', 'ActorController');
        Route::resource('categories', 'CategoryController')->except(['show']);
        Route::resource('orders', 'OrderController')->except(['destroy', 'create']);
        Route::resource('ratings', 'RatingController')->only(['index', 'destroy']);
        Route::resource('reviews', 'ReviewController')->only(['index', 'destroy']);
        Route::resource('messages', 'MessageController')->only(['index', 'destroy']);
    });
});
