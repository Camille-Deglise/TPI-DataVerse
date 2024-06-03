<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

//------------------------------
// ETML - TPI
// Auteur : Camille Déglise
// Date : 21.05.2024
// Modification : selon commit de git
//-------------------------------



/**
 * Classe de type Controller
 * Gère les méthodes en lien avec la connexion
 */
class LoginController extends Controller
{
    /**
     * Méthode d'affichage du formulaire de connexion
     * Retourne la view de connexion 
     */
    public function loginForm()
    {
        return view('auth.login');
    }

    /**
     * Méthode pour déconnecter l'utilisateur
     */
    public function logout()
    {
        Auth::logout();
        return to_route('home')->with('success','Vous êtes bien déconnecté');
    }

      /**
     * Méthode pour le login de l'utilisateur
     * Va vérifier si l'email de l'utilisateur est vérifié
     * Va vérifier si les crédentiels de l'utilisateur sont :
     * Reconnus dans la base de données
     * Valides 
     */
    public function doLogin(LoginRequest $request) {
        
        // Vérification des données avec méthode validated et enregistrement dans une variable
        $credentials = $request->validated();
    
        // Vérification si l'utilisateur existe et est actif
        $user = User::where('email', $credentials['email'])->first();
        
        if ($user && !$user->is_activ) {
            return redirect()->route('login')->withErrors(['email' => 'Votre compte est désactivé. Veuillez contacter l\'administrateur.'])->withInput($request->only('email'));
        }
    
        // Tentative de connexion
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if($user->email_verified_at != null) {
                // Utilisateur authentifié avec succès
                $request->session()->regenerate();
                return redirect()->route('home', $user->id)->with('success', 'Vous êtes connecté avec succès.');
            } else {
                // Email non vérifié
                Auth::logout();
                return redirect()->route('login')->withErrors(['email' => "Email non vérifié"])->withInput($request->only('email'));
            }
        }
    
        // Vérification si l'email existe dans la base de données
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            // Email inexistant dans la base de données
            return redirect()->route('login')->withErrors(['email' => "Email inexistant"])->withInput($request->only('email'));
        }
    
        // Identifiants incorrects
        return redirect()->route('login')->withErrors(['email' => 'Identifiants incorrects'])->withInput($request->only('email'));
    }
    
}
