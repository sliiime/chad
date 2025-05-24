<?php

namespace App\Domain\Services\Contracts;

interface PostServiceContract {

    public function index($user);
    public function store($user, $post);

    public function storeReaction(int $user_id, $post, $reaction_type);

}
