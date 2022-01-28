<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

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

        $response = [
            'user'=>$user,
            'token' => $token,
        ];
        
        return response()->json($response, 201);
    }
    public function login(Request $request)
    {
        // dd($request->email);
        $form = $request->validate([
            'email' => 'required|string',
            'password' => 'required',
        ]);
        if (!Auth::attempt($form)) {
            return response()->json([
                "message"=>'Mot de passe ou email invalides',
            ]);
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
