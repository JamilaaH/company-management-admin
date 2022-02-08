<?php

namespace App\Listeners;

use App\Events\NewTache;
use App\Mail\NewTask;
use App\Notifications\NewTask as NotificationsNewTask;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class NewTacheListener implements ShouldQueue
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
     * @param  App\Events\NewTache $event
     * @return void
     */
    public function handle(NewTache $event)
    {
        $email = $event->user->email;
        Mail::to($email)->send(new NewTask($event->tache));
        //user pr avoir la notification
        $user = $event->user;
        $user->notify(new NotificationsNewTask($event->tache));
    }
}
