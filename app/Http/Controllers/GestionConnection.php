<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class GestionConnection extends Controller
{
    public function login(LoginUserRequest $request)
    {

        $credentials = $request->only('email', 'NEQ', 'password');
        
        Log::info('Login attempt', $request->all());
        Log::info('NEQ:', [$credentials['NEQ']]);
        Log::info('NEQ:', [$credentials['email']]);

        
        $user = null;
        if (!empty($credentials['email'])) {
            $user = User::where('email', $credentials['email'])->first();
        } elseif (!empty($credentials['NEQ'])) {
            $user = User::where('NEQ', $credentials['NEQ'])->first();
        }

        if ($user && Hash::check($credentials['password'], $user->password)) {
            
            Auth::login($user);

            return redirect()->route('MenuFournisseur');
        }

        return redirect()->route('ConnexionFournisseur')->with('erreur', 'Email/NEQ ou mot de passe incorrect.');
        
    }


    public function Logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('Accueil')->with('success', "Déconnexion réussie");
    }
}
