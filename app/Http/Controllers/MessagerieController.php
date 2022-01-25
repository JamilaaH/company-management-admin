<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use App\Models\Messagerie;
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

    public function show(Entreprise $id)
    {
        $entreprise = $id;
        $messages = Messagerie::where('entreprise_id', $entreprise->id)->get();
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
        return redirect()->route('messages.index')->with('success', 'message envoyé');
    }

    public function create()
    {
        $entreprises = Entreprise::all();
        return view('back.messages.add', compact('entreprises'));
    }
}
