<?php

namespace App\Providers;

use App\Services\AuthService;
use App\Services\CommentsService;
use App\Services\IAuthService;
use App\Services\ICommentsService;
use App\Services\IPostsService;
use App\Services\PostsService;
use Illuminate\Support\ServiceProvider;

class ActionServiceProvider extends ServiceProvider
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
        $this->app->bind(IAuthService::class, AuthService::class);
        $this->app->bind(IPostsService::class, PostsService::class);
        $this->app->bind(ICommentsService::class, CommentsService::class);

    }
}
