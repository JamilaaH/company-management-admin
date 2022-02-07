<?php

namespace App\Http\Controllers;

use App\Events\ChatEvent;
use App\Models\Entreprise;
use App\Models\Messagerie;
use App\Models\User;
use App\Notifications\NewMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagerieController extends Controller
{
    public function index()
    {
        $entreprises = Entreprise::all();
        $messages = Messagerie::all();
        $reponse = Auth::user()->messages;
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
        broadcast(new ChatEvent($message));
        $to = Entreprise::where('tva', $message->entreprise_id)->first();
        $destination = $to->user;
        //notification coté entreprise
        $destination->notify(new NewMessage('Admin', $message));
        return redirect()->back();
    }

    public function create()
    {
        $entreprises = Entreprise::all();
        return view('back.messages.add', compact('entreprises'));
    }
}
