<?php

namespace App\Services;

use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Repositories\IPostsRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Gate;

class PostsService implements IPostsService
{

    public function __construct(public IPostsRepository $postsRepository)
    {
    }

    public function getAllPosts(): AnonymousResourceCollection
    {
        return PostResource::collection($this->postsRepository->all());
    }

    public function getSinglePost(int $id): PostResource
    {
        return PostResource::make($this->postsRepository->find($id));
    }

    public function storePost(array $data): PostResource
    {
        return PostResource::make($this->postsRepository->create($data));
    }

    public function updatePost(Post $post, array $data): ?PostResource
    {
        return $this->postsRepository->update($post->id, $data) ?
            PostResource::make($this->postsRepository->find($post->id)) :
            null;
    }

    public function deletePost(Post $post): ?bool
    {
        if (Gate::allows('delete', $post)) {
            return $this->postsRepository->delete($post->id);
        }
        return null;
    }
}
