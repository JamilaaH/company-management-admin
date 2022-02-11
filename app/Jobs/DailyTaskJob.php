<?php

namespace App\Jobs;

use App\Mail\DailyTask;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class DailyTaskJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $user;
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
            if ($this->user->entreprise->taches->where('etat', 0)->count() >= 1) {
                var_dump($this->user->entreprise->taches->where('etat', 0));
                Mail::to($this->user->email)->send(new DailyTask($this->user->entreprise->taches->where('etat', 0)));
        }
    }
}
