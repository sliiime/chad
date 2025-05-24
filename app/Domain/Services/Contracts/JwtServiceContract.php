<?php

namespace App\Domain\Services\Contracts;

interface JwtServiceContract {

    function validateToken($token);
    function generateToken($user);
    function encode(array $payload);
}
