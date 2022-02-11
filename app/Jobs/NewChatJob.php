<?php

namespace App\Jobs;

use App\Events\ChatEvent;
use App\Models\Entreprise;
use App\Models\User;
use App\Notifications\NewMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Notification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class NewChatJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $user;
    public $message;
    public function __construct($user, $message)
    {
        $this->user = $user;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //message instannée
        broadcast(new ChatEvent($this->message));
        //vérifier si le destinaire est un admin et envoyer la notif 
        if ($this->user->user->id == 1) {
            $admin = User::find(1);
            Notification::send($admin, new NewMessage($this->user->entreprise->nom_contact, $this->message));
        } else {
            $entreprise = Entreprise::where('tva', $this->message->entreprise_id)->first();
            Notification::send($entreprise->user, new NewMessage('admin', $this->message));
        }
        
    }
}
