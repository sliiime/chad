<?php

namespace App\Providers;

use App\Services\Contracts\JwtServiceContract;
use App\Services\Contracts\LoginServiceContract;
use App\Services\Contracts\PostServiceContract;
use App\Services\Contracts\UserServiceContract;
use App\Services\Implementations\JwtService;
use App\Services\Implementations\LoginService;
use App\Services\Implementations\PostService;
use App\Services\Implementations\UserService;
use Illuminate\Support\ServiceProvider;

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
        JwtServiceContract::class => JwtService::class,
        PostServiceContract::class => PostService::class,
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
