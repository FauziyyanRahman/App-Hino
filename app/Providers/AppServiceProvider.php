<?php

namespace App\Providers;

use App\Services\AuthService;
use App\Services\BodyMakerService;
use App\Services\IdentityService;
use App\Services\DesignService;
use App\Services\EquipmentService;
use App\Services\PicService;
use App\Services\ProductionService;
use App\Services\ChassisService;
use App\Services\VariantService;
use App\Services\HomeService;
use App\Services\UsersService;
use App\Services\NewsService;
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
        $this->app->bind(AuthService::class, function ($app) {
            return new AuthService();
        });

        $this->app->bind(HomeService::class, function ($app) {
            return new HomeService();
        });

        $this->app->bind(BodyMakerService::class, function ($app) {
            return new BodyMakerService();
        });

        $this->app->bind(IdentityService::class, function ($app) {
            return new IdentityService();
        });

        $this->app->bind(DesignService::class, function ($app) {
            return new DesignService();
        });

        $this->app->bind(EquipmentService::class, function ($app) {
            return new EquipmentService();
        });

        $this->app->bind(PicService::class, function ($app) {
            return new PicService();
        });

        $this->app->bind(ProductionService::class, function ($app) {
            return new ProductionService();
        });

        $this->app->bind(ChassisService::class, function ($app) {
            return new ChassisService();
        });

        $this->app->bind(VariantService::class, function ($app) {
            return new VariantService();
        });

        $this->app->bind(UsersService::class, function ($app) {
            return new UsersService();
        });

        $this->app->bind(NewsService::class, function ($app) {
            return new NewsService();
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
