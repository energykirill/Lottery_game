<?php

namespace App\Providers;

use App\Events\FinishMatchEvent;
use App\Events\RegisterUserForMatchEvent;
use App\Listeners\DeterminingWinnerMatchListener;
use App\Listeners\ExceedingNumberGamerPerMatchListener;
use App\Listeners\RepeatedRegistrationUserForMatchListener;
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \App\Events\ExampleEvent::class => [
            \App\Listeners\ExampleListener::class,
        ],

        RegisterUserForMatchEvent::class => [
            RepeatedRegistrationUserForMatchListener::class,
            ExceedingNumberGamerPerMatchListener::class
        ],

        FinishMatchEvent::class => [
            DeterminingWinnerMatchListener::class
        ]
    ];

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
