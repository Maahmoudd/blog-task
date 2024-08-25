<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Services\ICommentsService;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends ApiBaseController
{
    public function __construct(public ICommentsService $commentsService)
    {
    }

    public function store(StoreCommentRequest $request, Post $post)
    {
        $comment = $this->commentsService->store($post, $request->validated());
        return $comment ? $this->respondCreated($comment) : $this->respondError(errors: 'Comment could not be created', status: Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function destroy(Post $post, Comment $comment)
    {
        $deleted = $this->commentsService->delete($post, $comment);
        return $deleted ? $this->respondSuccess(message: 'Comment deleted successfully') : $this->respondError(errors: 'Unauthorized', message: 'Comment could not be deleted',  status: Response::HTTP_UNAUTHORIZED);
    }
}
