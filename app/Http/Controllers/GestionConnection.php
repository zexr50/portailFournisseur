<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class GestionConnection extends Controller
{
    public function login(LoginUserRequest $request)
    {
        $credentials = $request->only('email', 'NEQ', 'password');
        
        $user = null;
        if (!empty($credentials['email'])) {
            $user = User::where('email', $credentials['email'])->first();
        } elseif (!empty($credentials['NEQ'])) {
            $user = User::where('NEQ', $credentials['NEQ'])->first();
        }

        if ($user && Hash::check($credentials['password'], $user->password)) {
            
            Auth::login($user);

            return redirect()->route('MenuFournisseur')->with('success', 'Login successful');
        }

        
        return back()->with('erreur', 'Email/NEQ ou mot de passe incorrect.');
    }


    public function Logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('Accueil')->with('success', "Déconnexion réussie");
    }
}