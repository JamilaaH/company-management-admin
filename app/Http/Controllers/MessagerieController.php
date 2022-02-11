<?php

namespace App\Http\Controllers;

use App\Events\ChatEvent;
use App\Jobs\NewChatJob;
use App\Models\Entreprise;
use App\Models\Messagerie;
use App\Models\User;
use App\Notifications\NewMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//messagerie coté admin
class MessagerieController extends Controller
{
    public function index()
    {
        $entreprises = Entreprise::all();
        $messages = Messagerie::all();
        $reponse = Auth::user()->messages;
        $notifications = Auth::user()->unreadNotifications;
        foreach ($notifications as $notification ) {
            $notification->markAsRead();
            // $notification->save();
        };
        return view("back.messages.index", compact('messages', 'reponse', 'entreprises'));
    }

    public function show( $tva)
    {
        $entreprise = Entreprise::where('tva', $tva)->first();
        // return dd($entreprise);
        $messages = Messagerie::where('entreprise_id', $entreprise->tva)->get();
        // return dd($messages);
        return view('back.messages.show', compact('messages', 'entreprise'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'message'=>'required|string',
        ]);

        $message = new Messagerie();
        $message->author_id = Auth::user()->id;
        $message->entreprise_id = $request->entreprise;
        $message->message = $request->message;
        $message->save();
        NewChatJob::dispatch($message->entreprise, $message);

        return redirect()->route('messages.index');
    }

    public function create()
    {
        $entreprises = Entreprise::all();
        return view('back.messages.add', compact('entreprises'));
    }
}
