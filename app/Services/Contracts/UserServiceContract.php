<?php

namespace App\Services\Contracts;

interface UserServiceContract {
    function index();
    function show($int);
    function store($user);
    function update($id, array $user);
}


