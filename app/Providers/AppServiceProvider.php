<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        \App\Film::observe(\App\Observers\FilmObserver::class);
        \App\User::observe(\App\Observers\UserObserver::class);
        \App\Category::observe(\App\Observers\CategoryObserver::class);
        \App\Rating::observe(\App\Observers\RatingFilmObserver::class);
    }
}
