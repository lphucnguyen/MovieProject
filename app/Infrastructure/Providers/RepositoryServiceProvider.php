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
            \App\Domain\Repositories\IUserRepository::class
            => \App\Infrastructure\Repositories\UserRepository::class,
            \App\Domain\Repositories\IPlanRepository::class
            => \App\Infrastructure\Repositories\PlanRepository::class,
            \App\Domain\Repositories\IOrderRepository::class
            => \App\Infrastructure\Repositories\OrderRepository::class,
            \App\Domain\Repositories\ISubscriptionRepository::class
            => \App\Infrastructure\Repositories\SubscriptionRepository::class,
            \App\Domain\Repositories\IFilmRepositoryNeo::class
            => \App\Infrastructure\Repositories\FilmRepositoryNeo::class,
            \App\Domain\Repositories\IUserRepositoryNeo::class
            => \App\Infrastructure\Repositories\UserRepositoryNeo::class,
            \App\Domain\Repositories\IRatingRepositoryNeo::class
            => \App\Infrastructure\Repositories\RatingRepositoryNeo::class,
            \App\Domain\Repositories\ICategoryRepositoryNeo::class
            => \App\Infrastructure\Repositories\CategoryRepositoryNeo::class,
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

        $this->app->singleton(\App\Shared\Domain\Models\INeoModel::class, \App\Shared\Domain\Models\NeoModel::class);
    }
}
