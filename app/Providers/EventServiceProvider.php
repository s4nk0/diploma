<?php

namespace App\Providers;

use App\Models\Ad;
use App\Models\AdGet;
use App\Models\PhoneVerification;
use App\Models\User;
use App\Observers\AdGetObserver;
use App\Observers\AdObserver;
use App\Observers\PhoneVerificationObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
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
        PhoneVerification::observe(PhoneVerificationObserver::class);
        User::observe(UserObserver::class);
        Ad::observe(AdObserver::class);
        AdGet::observe(AdGetObserver::class);
    }

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
