<?php

namespace App\Domain\Services\Contracts;

use Illuminate\Database\Eloquent\Model;

interface ReactionServiceContract
{
    public function index($user);
    public function store($user_id, $reaction, string $reactionable_type, int $reactionable_id);
}
