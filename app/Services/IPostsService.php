<?php

namespace App\Services;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface IPostsService
{
    public function getAllPosts(): AnonymousResourceCollection;
    public function getSinglePost(int $id): PostResource;
    public function storePost(array $data): PostResource;
    public function updatePost(Post $post, array $data): ?PostResource;
    public function deletePost(Post $post): ?bool;
}
