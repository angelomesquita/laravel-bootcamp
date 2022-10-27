<?php

namespace App\Listeners;

use App\Events\ChirpCreated;
use App\Models\User;
use App\Notifications\NewChirp;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendChirpCreatedNotifications implements ShouldQueue
{
    public function __construct()
    {
    }

    public function handle(ChirpCreated $event): void
    {
        $users = User::whereNot('id', $event->chirp->user_id)->cursor();
        foreach ($users as $user) {
            $user->notify(new NewChirp($event->chirp));
        }
    }
}
