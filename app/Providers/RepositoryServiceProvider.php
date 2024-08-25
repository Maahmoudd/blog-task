<?php

namespace App\Providers;

use App\Repositories\CommentsRepository;
use App\Repositories\ICommentsRepository;
use App\Repositories\IPostsRepository;
use App\Repositories\PostsRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(IPostsRepository::class, PostsRepository::class);
        $this->app->bind(ICommentsRepository::class, CommentsRepository::class);
    }
}
