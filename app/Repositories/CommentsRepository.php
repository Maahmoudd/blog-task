<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Models\Post;

class CommentsRepository implements ICommentsRepository
{

    public function create(Post $post, array $data)
    {
        return $post->comments()->create($data);
    }

    public function delete(Post $post, Comment $comment)
    {
        return $comment->delete();
    }
}
