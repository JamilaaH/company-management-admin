<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use App\Models\Messagerie;
use App\Models\Tache;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    
    function index()
    {
        $nbreEntreprise = Entreprise::all()->count();
        $messages = Auth::user()->unreadNotifications;
        $taches = Tache::all()->count();
        return view('home', compact('nbreEntreprise', 'messages', 'taches'));
    }
    public function entreprises()
    {
        $entreprises = Entreprise::paginate(8);
        return view('back.entreprise.index', compact('entreprises'));
    }
    
    public function profil()
    {
        return view('back.profil.index');
    }

    public function edit()
    {
        return view('back.profil.edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'nom'=>"required|string",
            "email"=>'required|email',
            'password'=>"required"
        ]);

        $user = User::where('id', Auth::user()->id)->first();
        $user->nom = $request->nom;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        return redirect()->route('profil.index')->with('success', 'profil édité');
    }
}
