<?php

namespace App\Listeners;

use App\Events\CommentCreated;
use App\Notifications\CommentPosted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyPostAuthor
{
    public function handle(CommentCreated $event): void
    {
        $event->comment->post->author->notify(new CommentPosted($event->comment));
    }
}
