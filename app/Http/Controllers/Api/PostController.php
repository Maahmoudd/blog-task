<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Services\IPostsService;
use Symfony\Component\HttpFoundation\Response;

class PostController extends ApiBaseController
{

    public function __construct(public IPostsService $postsService)
    {
    }

    public function index()
    {
        $posts = $this->postsService->getAllPosts();
        return $posts->isNotEmpty() ? $this->respondSuccess($posts) : $this->respondError(errors: 'No posts found',  status: Response::HTTP_UNPROCESSABLE_ENTITY);
    }


    public function store(StorePostRequest $request)
    {
        $post = $this->postsService->storePost($request->validated());
        return $post ? $this->respondSuccess($post) : $this->respondError(errors: 'Unable to create post',  status: Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function show(int $id)
    {
        $post = $this->postsService->getSinglePost($id);
        return $post ? $this->respondSuccess($post) : $this->respondError(errors: 'No post found', message: 'No Specified Post',  status: Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function update(UpdatePostRequest $request,Post $post)
    {
        $post = $this->postsService->updatePost($post, $request->validated());
        return $post ? $this->respondSuccess($post) : $this->respondError(errors: 'Unable to update post',  status: Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function destroy(Post $post)
    {
        $post = $this->postsService->deletePost($post);
        return $post ? $this->respondSuccess(message: 'Post deleted successfully') : $this->respondError(errors: 'Unable to delete post',  status: Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
