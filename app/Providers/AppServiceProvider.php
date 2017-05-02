<?php

namespace App\Providers;

use App\Socialite\AirStreamProvider;
use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Facades\Socialite;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Socialite::extend('airstream', function($app) {
            $config = $app['config']['services.airstream'];
            return Socialite::buildProvider(AirStreamProvider::class, $config);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
