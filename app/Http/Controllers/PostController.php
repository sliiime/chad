<?php

namespace App\Http\Controllers;

use App\Domain\Enums\ReactionTypeEnum;
use App\Domain\Models\Post;
use App\Domain\Services\Contracts\PostServiceContract;
use App\Domain\Services\Contracts\ReactionServiceContract;
use App\Http\Requests\ReactionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected PostServiceContract $postService;

    public function __construct(PostServiceContract $postService)
    {
        $this->postService = $postService;
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        return $this->postService->index($user);

    }

    /**created_by
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        return $this->postService->show($this->postService->store($user, $request->input()));
    }

    /**
     * Display the specified resource.
     */
    public function show($post_id)
    {
        return $this->postService->show($post_id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $post_id)
    {
        $user = Auth::user();
        return $this->postService->show($this->postService->update($user, $post_id, $request->input()));
    }

    public function reaction(ReactionRequest $request, $post_id){
        $user = Auth::user();

        $reaction_type = $request->enum('reaction_type', ReactionTypeEnum::class);
        return $this->postService->storeReaction($user->id, $post_id, $reaction_type);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($post_id)
    {

    }
}
