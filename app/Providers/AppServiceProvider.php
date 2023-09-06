<?php

namespace App\Providers;

use App\Services\AuthService;
use App\Services\HomeService;
use App\Services\UsersService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;


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
        $this->app->bind(AuthService::class, function ($app) {
            return new AuthService();
        });

        $this->app->bind(HomeService::class, function ($app) {
            return new HomeService();
        });

        $this->app->bind(UsersService::class, function ($app) {
            return new UsersService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);

    }
}
