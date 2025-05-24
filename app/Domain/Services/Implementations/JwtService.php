<?php

namespace App\Domain\Services\Implementations;


use App\Domain\Models\User;
use App\Domain\Services\Contracts\JwtServiceContract;
use Carbon\Carbon;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtService implements JwtServiceContract {

    function __construct(){}

    function validateToken($token) {
        $tokenPayload = JWT::decode($token, new Key(config('jwt.key'), 'HS256'));
        return User::query()->find($tokenPayload->sub)->first();
    }

    function encode(array $payload){
        return JWT::encode($payload, config('jwt.key'), 'HS256');
    }

    function generateToken($user){

        $expiration = config('jwt.jwt_ttl');

        $payload = [
            'sub' => $user->id,
            'exp' => Carbon::now()->getTimestamp() + $expiration,
            'nbf' => Carbon::now()->toDateTimeImmutable()->getTimestamp(),
            'iat' => Carbon::now()->toDateTimeImmutable()->getTimestamp()
        ];

        return $this->encode($payload);
    }

}
