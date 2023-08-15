<?php

namespace App\Providers;

use App\Services\TradeSafe\Service;
use Illuminate\Support\ServiceProvider;

class TradeSafeServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('tradesafe', function () {
            return new Service();
        });
    }
}
