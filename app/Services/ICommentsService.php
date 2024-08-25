<?php

namespace App\Services;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;

interface ICommentsService
{
    public function store(Post $post, array $data): ?CommentResource;
    public function delete(Post $post, Comment $comment): ?bool;
}
