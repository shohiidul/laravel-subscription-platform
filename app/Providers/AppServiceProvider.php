<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Request;
use Illuminate\Pagination\Paginator;

use Illuminate\Support\Facades\Event;
use App\Events\PostCreated;
use App\Listeners\SendPostNotificationEmail;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Manual registartion
        // Event::listen(
        //     PostCreated::class,
        //     SendPostNotificationEmail::class
        // );
    }
}
