<?php

namespace App\Services;

interface UserServiceContract {
    function index();
    function show($int);
    function store($user);
    function update($id, array $user);
}


