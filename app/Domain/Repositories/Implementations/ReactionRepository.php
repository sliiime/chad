<?php

namespace App\Domain\Repositories\Implementations;

use App\Domain\Models\Reaction;
use App\Domain\Repositories\Contracts\ReactionRepositoryContract;

class ReactionRepository implements ReactionRepositoryContract
{
    public function userReactions(int $user_id){
        return Reaction::where('user_id', $user_id)->get();
    }

    public function getUserReaction(int $userId, string $reactionable_type, int $reactionable_id)
    {
        return Reaction::where('user_id', $userId)->
            where('reactionable_type', $reactionable_type)->
            where('reactionable_id', $reactionable_id)->first();
    }
}
