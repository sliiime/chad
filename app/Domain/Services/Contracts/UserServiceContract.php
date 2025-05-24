<?php

namespace App\Services\Contracts;

use App\Domain\Models\User;

interface UserServiceContract {
    function index();
    function show($int);
    function store($user);
    function update($id, array $user);

    function resolveUser($user) : User;
}


