<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // dd($request->email);
        $form = $request->validate([
            'email' => 'required|string',
            'password' => 'required',
        ]);
        if (!Auth::attempt($form)) {
            return $this->error('Mot de passe ou email invalides', 401);
        }
        //rechercher l'user
        $user = User::where('email', $form['email'])->first();

        //vérifier le mdp et si l'user n'existe pas
        if (!$user || !Hash::check($form["password"], $user->password)) {
            return response()->json([
                'message'=>"mot de passe ou email invalide"
            ]);
        }

        $token = $user->createToken('api_token')->plainTextToken;
        // $entreprise = Entreprise::where('user_id', Auth::id())->get();
        $response = [
            'message'=>"vous êtes connecté",
            'user'=> $user,
            // 'entreprise'=>$user->entreprise,
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
