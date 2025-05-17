<?php

namespace App\Providers;

use App\Services\LoginService;
use App\Services\LoginServiceContract;
use App\Services\UserServiceContract;
use App\Services\UserService;

use Illuminate\Support\ServiceProvider;
use App\Services\JwtService;
use App\Services\JwtServiceContract;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */

    public $bindings = [
        UserServiceContract::class => UserService::class,
        LoginServiceContract::class => LoginService::class,
        JwtServiceContract::class => JwtService::class
    ];

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
        //
    }
}
