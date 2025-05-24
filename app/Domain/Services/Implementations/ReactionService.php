<?php

namespace App\Domain\Services\Implementations;

use App\Domain\Models\Reaction;
use App\Domain\Repositories\Contracts\ReactionRepositoryContract;
use App\Domain\Services\Contracts\ReactionServiceContract;
use App\Domain\Services\Contracts\UserServiceContract;
use App\Exceptions\Exception400;

class ReactionService implements ReactionServiceContract
{
    public function __construct(protected ReactionRepositoryContract $reactionRepository){}

    public function index($user){
        $user = app(UserServiceContract::class)->resolveUser($user);
        return $this->reactionRepository->userReactions($user->id);
    }

    public function store($user, $reaction_type, string $reactionable_type, int $reactionable_id){
        $user = app(UserServiceContract::class)->resolveUser($user);
        $this->storeValidation($user, $reactionable_type, $reactionable_id);

        $reaction = new Reaction();
        $reaction->user()->associate($user);
        $reaction->reaction_type_id = $reaction_type;
        $reaction->reactionable_type = $reactionable_type;
        $reaction->reactionable_id = $reactionable_id;

        $reaction->save();

        return $reaction;
    }


    private function storeValidation($user, $reactionable_type, $reactionable_id, bool $throwsException = true): bool{
        if (!is_null($this->reactionRepository->getUserReaction($user->id, $reactionable_type, $reactionable_id))){
            if ($throwsException){
                throw new Exception400("reaction already exists");
            }
            return false;
        }

//        if (is_null($reactionable_type->getMorphClass())){
//            if ($throwsException){
//                throw new Exception400("the given type is not reactionable");
//            }
//            return false;
//        }
        return true;
    }
}
