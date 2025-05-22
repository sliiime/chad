<?php

namespace App\Http\Controllers;

use App\Services\Contracts\PostServiceContract;
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($post_id)
    {

    }
}
