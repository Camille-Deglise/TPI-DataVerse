<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

/**
 * Classe de type Controller 
 * Contient toutes les méthodes gérant l'enregistrement d'un utilisateur
 */
class RegisterController extends Controller
{
    /*
    * Méthode d'affichage du formulaire d'enregistrement 
    * retourne une vue 
    */
    public function registerForm()
    {
        return view('auth.register');
    }

    /**
     * Méthode qui gère l'enregistrement dans la base de donnée
     * Prend en paramètre la requête POST du formulaire
     * Retourne l'utilisateur sur la page home du site avec un message
     */
    public function storeDB(RegisterRequest $request)
    {
        
         //Reprendre les données de la requête validée dans le RegisterRequest
         $validatedData = $request ->validated();
        
        //Création de l'utilisateur 
         $user = User::create([
           'lastname' => $validatedData['lastname'],
           'firstname' => $validatedData['firstname'],
           'email' => $validatedData['email'],
           'password' =>Hash::make($validatedData['password']),
           
         ]);
        
            //permet d'effectuer un nouvel événement d'enregistrement (de base dans Laravel) du $user afin de pouvoir par 
            //après utiliser la vérification d'email. 
            event(new Registered($user));
            
            
            return redirect()->route('home')->with("success",
            "Votre inscription s'est bien effectuée. Vérifier le lien reçu par email pour pouvoir vous connecter");

    }
}
