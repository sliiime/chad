<?php

namespace App\Services\Implementations;

use App\Domain\Models\Post;
use App\Domain\Models\User;
use App\Exceptions\Exception400;
use App\Services\Contracts\PostServiceContract;
use App\Services\Contracts\UserServiceContract;
use Carbon\Carbon;

class PostService implements PostServiceContract
{
    public function index($user){
        $user = app(UserServiceContract::class)->resolveUser($user);


        return Post::query()->where('created_by', '=', $user->id)->get();
    }

    public function store($user, $params){
        $user = app(UserServiceContract::class)->resolveUser($user);

        $post = new Post;
        $post->fill($params);
        $post->created_by = $user->id;
        $post->created_at = $params['created_at'] ?? Carbon::now();
        $post->updated_at = $post->created_at;
        $post->save();

        return $post;
    }

    public function show($post){
        $post = $this->resolvePost($post);
        return $post;
    }

    public function update($user, $post, $params){
        $post = $this->resolvePost($post);
        if (!$this->userCanEditPost($user, $post)){
            throw new Exception400("$user doesn't have permissions to edit this post");
        }

        $post->content = $params['content'] ?? $post->content;
        $post->posted_to = $params['posted_to'] ?? $post->posted_to;

        $post->save();

        return $post;
    }

    public function resolvePost($post){
        return $post instanceof Post ? $post : Post::query()->findOrFail($post);
    }

    public function userCanEditPost($user, $post){
        return $user->id === $post->created_by;
    }
}
