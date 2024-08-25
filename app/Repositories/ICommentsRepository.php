<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Models\Post;

interface ICommentsRepository
{
    public function create(Post $post, array $data);
    public function delete(Post $post, Comment $comment);
}
