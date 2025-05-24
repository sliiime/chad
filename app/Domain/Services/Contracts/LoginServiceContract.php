<?php

namespace App\Services\Contracts;

interface LoginServiceContract {
    public function authenticatedUser(array $input);
    public function success($user);
}
