<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntrepriseController extends Controller
{
    public function index()
    {
        $entreprise  = Entreprise::where('user_id', Auth::user()->id)->get();
        return response()->json([
            "message"=>"Données de l'entreprise récupérée",
            'data'=>$entreprise
        ]); 
    }

    public function update(Request $request)
    {
        $request->validate([
            "nom"=> "required|string",
            "activite"=> "required|string",
            "ville"=> "required|string",
            "pays"=> "required|string",
            "code_postal"=> "required",
            "email"=> "required",
            "nom_contact"=> "required",
            "numero_contact"=> "required",
        ]);

        $entreprise = Entreprise::where('user_id', Auth::user()->id)->first();
        $entreprise->tva = $request->tva;
        $entreprise->nom = $request->nom;
        $entreprise->activite = $request->activite;
        $entreprise->ville = $request->ville;
        $entreprise->pays = $request->pays;
        $entreprise->code_postal = $request->code_postal;
        $entreprise->email = $request->email;
        $entreprise->nom_contact = $request->nom_contact;
        $entreprise->numero_contact = $request->numero_contact;
        $entreprise->save() ;

        return response()->json([
            'message'=>"Mise à jour fait",
            'data'=>$entreprise
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            "nom"=>"required|string",
            "activite"=>"required|string",
            "adresse"=>"required|string",
            "numero"=>"required",
            "code_postal"=>"required|integer",
            "ville"=>"required|string",
            "pays"=>"required|string",
            "nom_contact"=>"required|string",
            "email_contact"=>"required|string",
            "numero_contact"=>"required|integer",
        ]);
        
        $entreprise = new Entreprise();
        $add = $request->adresse.' ' .$request->numero;
        $entreprise->tva = $request->tva;
        $entreprise->user_id = Auth::user()->id;
        $entreprise->nom = $request->nom;
        $entreprise->activite = $request->activite;
        $entreprise->adresse = $add;
        $entreprise->code_postal = $request->code_postal;
        $entreprise->ville = $request->ville;
        $entreprise->pays = $request->pays;
        $entreprise->nom_contact = $request->nom_contact;
        $entreprise->email = $request->email_contact;
        $entreprise->numero_contact = $request->numero_contact;
        $entreprise->save();

        return response()->json([
            'message'=>'entreprise enregistrée',
            'data'=>$entreprise,
        ]);

    }


}
