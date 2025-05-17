<?php

namespace App\Services;

interface LoginServiceContract {
    public function authenticatedUser(array $input);
    public function success($user);
}