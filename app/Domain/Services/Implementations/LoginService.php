<?php

namespace App\Domain\Services\Implementations;

use App\Domain\Models\User;
use App\Domain\Services\Contracts\JwtServiceContract;
use App\Domain\Services\Contracts\LoginServiceContract;
use App\Exceptions\Services\MissingKeyException;
use Illuminate\Support\Facades\Hash;

class LoginService implements LoginServiceContract {

    protected $jwtService;

    function __construct(JwtServiceContract $jwtService)
    {
        $this->jwtService = $jwtService;
    }

    public function authenticatedUser(array $credentials){
        if (!isset($credentials['username']) && !isset($credentials['email'])){
            MissingKeyException::disjunction($credentials['username'], $credentials['email']);
        }

        $q = User::query();

        if (isset($credentials['username'])){
            $q->where('username', '=', $credentials['username']);
        }

        if (isset($credentials['email'])){
            $q->where('email', '=', $credentials['email']);
        }

        $u = $q->first();

        if (is_null($u)){
            return null;
        }

        if (!Hash::check($credentials['password'], $u->password)){
            return null;
        }

        return $u;
    }


    public function success($user){

        $token = $this->jwtService->generateToken($user);

        return response()->json([
                'accessToken' => $token
            ], 200);
    }

}
