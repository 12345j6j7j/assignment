<?php

namespace App\Providers;

use App\Models\Ship;
use App\Observers\ShipObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Ship::observe(ShipObserver::class);
    }
}
