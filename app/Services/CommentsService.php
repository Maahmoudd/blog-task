<?php

namespace App\Services;

use App\Events\CommentCreated;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;
use App\Repositories\ICommentsRepository;
use Illuminate\Support\Facades\Gate;

class CommentsService implements ICommentsService
{
    public function __construct(public ICommentsRepository $commentsRepository)
    {
    }

    public function store(Post $post, array $data): ?CommentResource
    {
        $comment = $this->commentsRepository->create($post, $data);
        CommentCreated::dispatch($comment);
        return CommentResource::make($comment);
    }

    public function delete(Post $post, Comment $comment): ?bool
    {
        if (Gate::allows('delete', $comment)) {
            return $this->commentsRepository->delete($post, $comment);
        }
        return null;
    }
}
