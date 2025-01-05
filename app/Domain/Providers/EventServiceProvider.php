<?php

namespace App\Domain\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        \App\Domain\Models\Actor::observe(\App\Domain\Observers\ActorObserver::class);
        \App\Domain\Models\Admin::observe(\App\Domain\Observers\AdminObserver::class);
        \App\Domain\Models\Film::observe(\App\Domain\Observers\FilmObserver::class);
        \App\Domain\Models\User::observe(\App\Domain\Observers\UserObserver::class);
    }
}
