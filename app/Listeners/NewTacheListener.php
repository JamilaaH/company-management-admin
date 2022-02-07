<?php

namespace App\Listeners;

use App\Events\NewTache;
use App\Mail\NewTask;
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
        // Mail::to($this->user)->send(new NewTask($this->tache));
        // $data = $event;
        var_dump($event);
    }
}
