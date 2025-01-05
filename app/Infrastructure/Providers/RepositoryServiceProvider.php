<?php

namespace App\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    private $mappingRepositories;

    public function __construct($app)
    {
        parent::__construct($app);

        $this->mappingRepositories = [
            \App\Domain\Repositories\IActorRepository::class
            => \App\Infrastructure\Repositories\ActorRepository::class,
            \App\Domain\Repositories\IAdminRepository::class
            => \App\Infrastructure\Repositories\AdminRepository::class,
            \App\Domain\Repositories\ICategoryRepository::class
            => \App\Infrastructure\Repositories\CategoryRepository::class,
            \App\Domain\Repositories\IEpisodeRepository::class
            => \App\Infrastructure\Repositories\EpisodeRepository::class,
            \App\Domain\Repositories\IFavoriteRepository::class
            => \App\Infrastructure\Repositories\FavoriteRepository::class,
            \App\Domain\Repositories\IFilmRepository::class
            => \App\Infrastructure\Repositories\FilmRepository::class,
            \App\Domain\Repositories\IMessageRepository::class
            => \App\Infrastructure\Repositories\MessageRepository::class,
            \App\Domain\Repositories\IRatingRepository::class
            => \App\Infrastructure\Repositories\RatingRepository::class,
            \App\Domain\Repositories\IReviewRepository::class
            => \App\Infrastructure\Repositories\ReviewRepository::class,
            \App\Domain\Repositories\ITransactionRepository::class
            => \App\Infrastructure\Repositories\TransactionRepository::class,
            \App\Domain\Repositories\IUserRepository::class
            => \App\Infrastructure\Repositories\UserRepository::class,
            \App\Domain\Repositories\IPlanRepository::class
            => \App\Infrastructure\Repositories\PlanRepository::class,
        ];
    }

    /**
     * Register services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        foreach ($this->mappingRepositories as $interface => $repository) {
            $this->app->singleton($interface, $repository);
        }
    }
}
