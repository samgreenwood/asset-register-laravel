<?php

namespace App\Providers;

use App\Repositories\MemberRepository;
use App\Repositories\MembersMemberRepository;
use App\Repositories\NodeRepository;
use App\Repositories\ProductRepository;
use App\Repositories\StaticNodeRepository;
use App\Repositories\StaticProductRepository;
use App\Socialite\AirStreamProvider;
use Doctrine\ORM\EntityManager;
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
        $this->app->singleton(NodeRepository::class, StaticNodeRepository::class);
        $this->app->singleton(MemberRepository::class, MembersMemberRepository::class);
        $this->app->singleton(ProductRepository::class, StaticProductRepository::class);
    }
}
