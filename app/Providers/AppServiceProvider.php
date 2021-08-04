<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Support\Storage\Contracts\StorageInterface;
use App\Support\Storage\SessionStorage;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(StorageInterface::class, function ($app) {
            return new SessionStorage('basket');
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        session_start();

        Schema::defaultStringLength(191);
    }
}
