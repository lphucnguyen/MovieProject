<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    private $mappingServices;

    public function __construct($app)
    {
        parent::__construct($app);

        $this->mappingServices = [
            \App\Services\Contracts\IActorService::class
            => \App\Services\Eloquents\ActorService::class,
            \App\Services\Contracts\IAdminService::class
            => \App\Services\Eloquents\AdminService::class,
            \App\Services\Contracts\ICategoryService::class
            => \App\Services\Eloquents\CategoryService::class,
            \App\Services\Contracts\IEpisodeService::class
            => \App\Services\Eloquents\EpisodeService::class,
            \App\Services\Contracts\IFavoriteService::class
            => \App\Services\Eloquents\FavoriteService::class,
            \App\Services\Contracts\IFilmService::class
            => \App\Services\Eloquents\FilmService::class,
            \App\Services\Contracts\IMessageService::class
            => \App\Services\Eloquents\MessageService::class,
            \App\Services\Contracts\IRatingService::class
            => \App\Services\Eloquents\RatingService::class,
            \App\Services\Contracts\IReviewService::class
            => \App\Services\Eloquents\ReviewService::class,
            \App\Services\Contracts\ITransactionService::class
            => \App\Services\Eloquents\TransactionService::class,
            \App\Services\Contracts\IUserService::class
            => \App\Services\Eloquents\UserService::class,
        ];
    }

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
        Schema::defaultStringLength(191);

        Paginator::useBootstrap();

        // \App\Film::observe(\App\Observers\FilmObserver::class);
        // \App\User::observe(\App\Observers\UserObserver::class);
        // \App\Category::observe(\App\Observers\CategoryObserver::class);
        // \App\Rating::observe(\App\Observers\RatingFilmObserver::class);

        foreach ($this->mappingServices as $interface => $service) {
            $this->app->singleton($interface, $service);
        }
    }
}
