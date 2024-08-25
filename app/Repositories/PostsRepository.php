<?php

namespace App\Repositories;

use App\Models\Post;

class PostsRepository extends BaseModelRepository implements IPostsRepository
{
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }
}
