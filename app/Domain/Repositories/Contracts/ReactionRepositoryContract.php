<?php

namespace App\Domain\Repositories\Contracts;

use App\Domain\Models\Reaction;

interface ReactionRepositoryContract
{
    public function userReactions(int $user_id);

}
