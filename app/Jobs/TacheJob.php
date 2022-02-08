<?php

namespace App\Jobs;

use App\Events\NewTache;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class TacheJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $user;
    public $tache;
    public function __construct($user, $tache)
    {
        $this->user = $user;
        $this->tache = $tache;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        event(new NewTache($this->user, $this->tache));

    }
}
