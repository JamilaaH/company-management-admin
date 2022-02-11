<?php

namespace App\Http\Controllers;

use App\Events\ChatEvent;
use App\Jobs\NewChatJob;
use App\Models\Entreprise;
use App\Models\Messagerie;
use App\Models\Notification as ModelsNotification;
use App\Models\Tache;
use App\Models\User;
use App\Notifications\NewMessage;
use BeyondCode\LaravelWebSockets\Dashboard\Http\Controllers\SendMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

//toutes les fonctions coté vue
class EntrepriseController extends Controller
{
    public function dashboard()
    {
        $notifications = Auth::user()->unreadNotifications;
        if ($notifications->isEmpty()) {
            return response()->json([
                "valid" => false
            ]);
        } else {
            //récuperer taches
            $taches = ModelsNotification::where('notifiable_id', Auth::user()->id)->where('read_at', null)->where('type', 'like', '%NewTask')->get();
            $messages = ModelsNotification::where('notifiable_id', Auth::user()->id)->where('read_at', null)->where('type', 'like', '%NewMessage')->get();
            return response()->json([
                "valid"=>true,
                'taches'=>$taches,
                'messages'=>$messages,
                "success"=>"la liste des notifications est bien récupérée",
            ]); 
        }
    }
    public function index()
    {
        $entreprise  = Entreprise::where('user_id', Auth::user()->id)->get();
        if ($entreprise->isEmpty()) {
            return response()->json([
                "valid" => false
            ]);
        } else {
            return response()->json([
                "valid"=>true,
                "message"=>"Données de l'entreprise récupérée",
                'data'=>$entreprise
            ]); 
        }
        
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

        $entreprise = Entreprise::where('user_id', Auth::id())->first();
        $entreprise->nom = $request->nom;
        $entreprise->tva = $request->tva;
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

    public function task()
    {
        $taches = Tache::where('entreprise_id', Auth::user()->entreprise->tva)->get();
        if ($taches->isEmpty()) {
            return response()->json([
                'message'=> 'pas de taches'
            ],404);            
        } else {
            return response()->json([
                'taches'=> $taches
            ]);            

        }
    }

    public function done(Tache $id)
    {
        $tache = $id;
        switch ($tache->etat) {
            case (0):
                $tache->etat = 1;
                $tache->save();
                break;
            case (1):
                $tache->etat = 0;
                $tache->save();
                break;
            
            default:
                
                break;
        }
        
        $taches = Tache::where('entreprise_id', Auth::user()->entreprise->tva)->get();
        return response()->json([
            "taches" => $taches
        ]);

    }

    public function messages()
    {
        $messages = Messagerie::where('entreprise_id', Auth::user()->entreprise->tva)->with('author')->with('entreprise')->get();
        return response()->json([
            'messages'=>$messages,
        ]);
    }

    public function envoiMessage(Request $request)
    {
        $request->validate([
            "texte"=>"required"
        ]);

        $message = Messagerie::create([
            "author_id" => Auth::user()->id,
            "entreprise_id" => Auth::user()->entreprise->tva,
            "message" => $request->texte,
        ]);
        NewChatJob::dispatch($message->entreprise, $message);
        return response()->json([
            "message"=>'message envoyé',
            'text'=> $message
        ]);

    }

}
