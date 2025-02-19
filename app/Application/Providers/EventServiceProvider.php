<?php

namespace App\Application\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen(\App\Application\Events\OrderPaid::class, \App\Application\Listeners\Order\SendPaymentEmail::class);
        Event::listen(\App\Application\Events\OrderCreated::class, \App\Application\Listeners\Order\MonitoringOrder::class);

        Event::listen(\App\Domain\Events\Category\CategoryCreated::class, \App\Application\Listeners\Category\CreateCategory::class);
        Event::listen(\App\Domain\Events\Category\CategoryUpdated::class, \App\Application\Listeners\Category\UpdateCategory::class);
        Event::listen(\App\Domain\Events\Category\CategoryDeleted::class, \App\Application\Listeners\Category\DeleteCategory::class);

        Event::listen(\App\Domain\Events\Film\FilmCreated::class, \App\Application\Listeners\Film\CreateFilm::class);
        Event::listen(\App\Domain\Events\Film\FilmUpdated::class, \App\Application\Listeners\Film\UpdateFilm::class);
        Event::listen(\App\Domain\Events\Film\FilmDeleted::class, \App\Application\Listeners\Film\DeleteFilm::class);

        Event::listen(\App\Domain\Events\Rating\RatingCreated::class, \App\Application\Listeners\Rating\CreateRating::class);
        Event::listen(\App\Domain\Events\Rating\RatingUpdated::class, \App\Application\Listeners\Rating\UpdateRating::class);
        Event::listen(\App\Domain\Events\Rating\RatingDeleted::class, \App\Application\Listeners\Rating\DeleteRating::class);

        Event::listen(\App\Domain\Events\User\UserCreated::class, \App\Application\Listeners\User\CreateUser::class);
        Event::listen(\App\Domain\Events\User\UserUpdated::class, \App\Application\Listeners\User\UpdateUser::class);
        Event::listen(\App\Domain\Events\User\UserDeleted::class, \App\Application\Listeners\User\DeleteUser::class);
    }
}
