<?php

namespace App\Providers;

use App\Domain\Services\Contracts\JwtServiceContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::viaRequest('jwt', function (Request $request){
            $jwtService = app(JwtServiceContract::class);;
            if (($token = $request->bearerToken()) === null){
                return null;
            }
            return $jwtService->validateToken($token);

        });

        //
    }
}
