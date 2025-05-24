<?php

namespace App\Providers;

use App\Domain\Repositories\Contracts\ReactionRepositoryContract;
use App\Domain\Repositories\Implementations\ReactionRepository;
use App\Domain\Services\Contracts\JwtServiceContract;
use App\Domain\Services\Contracts\LoginServiceContract;
use App\Domain\Services\Contracts\PostServiceContract;
use App\Domain\Services\Contracts\ReactionServiceContract;
use App\Domain\Services\Contracts\UserServiceContract;
use App\Domain\Services\Implementations\JwtService;
use App\Domain\Services\Implementations\LoginService;
use App\Domain\Services\Implementations\PostService;
use App\Domain\Services\Implementations\ReactionService;
use App\Domain\Services\Implementations\UserService;
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
        ReactionServiceContract::class => ReactionService::class,
        ReactionRepositoryContract::class => ReactionRepository::class,
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
