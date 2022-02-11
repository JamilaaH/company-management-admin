<?php

namespace App\Providers;

use App\Events\ListDaily;
use App\Events\NewTache;
use App\Events\NewUser;
use App\Listeners\ListDailyListener;
use App\Listeners\NewTacheListener;
use App\Listeners\NewUserListener;
use App\Listeners\SendMessageNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        NewTache::class => [
            NewTacheListener::class
        ],
        NewUser::class => [
            NewUserListener::class
        ],
    
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
