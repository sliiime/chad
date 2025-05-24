<?php

namespace App\Http\Controllers;

use App\Domain\Services\Contracts\ReactionServiceContract;
use Illuminate\Support\Facades\Auth;

class ReactionController
{

    function __construct(protected ReactionServiceContract $reactionService){}

    public function index(){
        $user = Auth::user();
        $this->reactionService->index($user);
    }

}
