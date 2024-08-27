<?php

namespace App\Listeners;

use App\Events\CreateComment;
use App\Models\User;
use App\Notifications\CommentAdded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CreateComment $event): void
    {
        $comment=$event->comment;
        $user=User::where('user_id',$comment->post->user_id)->first();
        $user->notify(new CommentAdded($comment));

    }
}
