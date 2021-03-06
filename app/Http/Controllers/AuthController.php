<?php

namespace App\Http\Controllers;

use App\Jobs\NewUserJob;
use App\Jobs\TacheJob;
use App\Mail\NewUser;
use App\Models\Entreprise;
use App\Models\User;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    //authenfication coté vue

    public function register(Request $request)
    {
        $form = $request->validate([
            'nom' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string|confirmed',
        ]);

        $user = User::create([
            'nom' => $form['nom'],
            'email' => $form['email'],
            'password' => bcrypt($form['password']),
        ]);

        $token = $user->createToken('api_token')->plainTextToken;
        dispatch(new NewUserJob($user));
        $response = [
            'user'=>$user,
            'token' => $token,
        ];
        
        return response()->json($response, 201);
    }
    public function login(Request $request)
    {
        $form = $request->validate([
            'email' => 'required|string',
            'password' => 'required',
        ]);
        //vérifie si la connexion a échoué 
        if (!Auth::attempt($form)) {
            return response()->json([
                "message"=>'Mot de passe ou email invalides',
            ],401);
        }
        //rechercher l'user
        $user = User::where('email', $form['email'])->first();

        //vérifier le mdp et si l'user n'existe pas
        if (!$user || !Hash::check($form["password"], $user->password)) {
            return response()->json([
                'message'=>"mot de passe ou email invalide"
            ], 401);
        }

        $token = $user->createToken('api_token')->plainTextToken;
        $response = [
            'message'=>"vous êtes connecté",
            'user'=> $user,
            'token' => $token,
        ];
        
        return response()->json($response,201);
    }

    public function logout(Request $request)
    {
        auth()->user()->currentAccessToken()->delete();       
        return response(['message' => 'You have been successfully logged out.'], 200);
    }
}
