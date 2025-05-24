<?php

namespace App\Domain\Services\Contracts;

interface LoginServiceContract {
    public function authenticatedUser(array $input);
    public function success($user);
}
