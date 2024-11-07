<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    private $mappingRepositories;

    public function __construct($app)
    {
        parent::__construct($app);

        $this->mappingRepositories = [
            \App\Repositories\Contracts\IActorRepository::class
            => \App\Repositories\Eloquents\ActorRepository::class,
            \App\Repositories\Contracts\IAdminRepository::class
            => \App\Repositories\Eloquents\AdminRepository::class,
            \App\Repositories\Contracts\ICategoryRepository::class
            => \App\Repositories\Eloquents\CategoryRepository::class,
            \App\Repositories\Contracts\IEpisodeRepository::class
            => \App\Repositories\Eloquents\EpisodeRepository::class,
            \App\Repositories\Contracts\IFavoriteRepository::class
            => \App\Repositories\Eloquents\FavoriteRepository::class,
            \App\Repositories\Contracts\IFilmRepository::class
            => \App\Repositories\Eloquents\FilmRepository::class,
            \App\Repositories\Contracts\IMessageRepository::class
            => \App\Repositories\Eloquents\MessageRepository::class,
            \App\Repositories\Contracts\IRatingRepository::class
            => \App\Repositories\Eloquents\RatingRepository::class,
            \App\Repositories\Contracts\IReviewRepository::class
            => \App\Repositories\Eloquents\ReviewRepository::class,
            \App\Repositories\Contracts\ITransactionRepository::class
            => \App\Repositories\Eloquents\TransactionRepository::class,
            \App\Repositories\Contracts\IUserRepository::class
            => \App\Repositories\Eloquents\UserRepository::class,
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
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

        foreach ($this->mappingRepositories as $interface => $repository) {
            $this->app->singleton($interface, $repository);
        }
    }
}
