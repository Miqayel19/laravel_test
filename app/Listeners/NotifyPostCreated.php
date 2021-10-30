<?php

namespace App\Listeners;

use App\Events\PostCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use Mail;

class NotifyPostCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PostCreated  $event
     * @return void
     */
    public function handle(PostCreated $event)
    {
        $users = $event->users;
        $post = $event->post;
        foreach ($users as $user) {
             Mail::send('emails.welcome', ['post' => $post], function ($message) use ($user) {
                    $message->from('test@gmail.com', 'John Doe');
                    $message->subject('Welcome '.$user->name.'!');
                    $message->to($user->email);
            });
        }

    }
}
