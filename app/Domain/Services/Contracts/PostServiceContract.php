<?php

namespace App\Services\Contracts;

use App\Domain\Models\User;

interface PostServiceContract {

    public function index($user);
    public function store($user, $post);

}
