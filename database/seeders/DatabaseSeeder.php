<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 5 users, each with 5 posts and each post having 5 comments
        User::factory(5)
            ->has(
                Post::factory(5) // Each user has 5 posts
                ->has(Comment::factory(5)->state(function (array $attributes, Post $post) {
                    return ['user_id' => $post->user_id]; // Ensure each comment has the same user_id as the post
                }), 'comments') // Each post has 5 comments
                , 'posts')
            ->create();

        // Create an admin user with posts and comments
        User::factory()
            ->has(
                Post::factory(5)
                    ->has(Comment::factory(5)->state(function (array $attributes, Post $post) {
                        return ['user_id' => $post->user_id]; // Ensure each comment has the same user_id as the post
                    }), 'comments') // Each post has 5 comments
                , 'posts')
            ->create([
                'name' => 'Admin User',
                'email' => 'admin@admin.com',
            ]);
    }
}
