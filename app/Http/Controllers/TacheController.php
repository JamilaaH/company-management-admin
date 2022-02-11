<?php

namespace App\Http\Controllers;

use App\Jobs\TacheJob;
use App\Models\Entreprise;
use App\Models\Tache;
use Illuminate\Http\Request;

//controller tache de l'admin pour créer/voir les taches
class TacheController extends Controller
{
    public function index()
    {
        $taches = Tache::all();
        return view('back.taches.index', compact('taches'));
    }

    public function create()
    {
        $entreprises = Entreprise::all();
        return view ('back.taches.add', compact('entreprises'));
    }

    public function store(Request $request)
    {
        $request->validate([
            "entreprise"=>"required|string",
            "text"=>"required"
        ]);

        $tache = new Tache();
        $tache->entreprise_id = $request->entreprise ;
        $tache->text = $request->text ;
        $tache->etat = 0 ;
        $tache->save();
        $entreprise = Entreprise::where('tva',$tache->entreprise_id)->first();
        $user = $entreprise->user;
        dispatch(new TacheJob($user, $tache));
        return redirect()->route('tache.index')->with('success', 'Tâche bien ajoutée');
    }

    public function edit(Tache $id)
    {
        $tache = $id;
        $entreprises = Entreprise::all();
        return view('back.taches.edit', compact('tache', 'entreprises'));
    }

    public function update(Request $request, Tache $id)
    {
        $request->validate([
            "entreprise"=>"required|string",
            "text"=>"required"
        ]);

        $tache = Tache::find($id)->first();
        $tache->entreprise_id = $request->entreprise ;
        $tache->text = $request->text ;
        $tache->etat = 0 ;
        $tache->save();
        return redirect()->route('tache.index')->with('success', 'Tâche éditée');
    }
    
    public function destroy(Tache $id)
    {
        $tache = $id;
        $tache->delete();
        return redirect()->back()->with('warning', 'Tâche supprimée');
    }
}
