<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use App\Models\User;

//------------------------------
// ETML - TPI
// Auteur : Camille Déglise
// Date : 21.05.2024
// Modification : 
//-------------------------------




/**
 * Classe de type Controller 
 * Contient les méthodes de vérification de l'utilisateur 
 */
class VerificationController extends Controller
{
    /**
     * Méthode de vérification de l'utilisateur avec le lien de validation envoyé par email
     * Change la propriété de l'email vérifié dans la base de donnée
     * Utilise principalement des fonctions de Laravel
     */
    public function verify(Request $request)
    {
        $user = User::find($request->route('id'));
        if (!$user) {
            return redirect()->route('login')->with('userNotFoud', 'Utilisateur non trouvé.');
        }
        if ($user->hasVerifiedEmail()) {
            return redirect()->route('login')->with('info', 'Votre e-mail est déjà vérifié.');
        }

            // Marquer l'e-mail comme vérifié dans la base de données
            $user->markEmailAsVerified();

            // Déclencher l'événement Verified
            event(new Verified($user));

            // Rediriger l'utilisateur vers la page de connexion avec un message de succès
            return redirect()->route('login')->with('success', 'Votre e-mail a été vérifié avec succès. Vous pouvez maintenant vous connecter.');
    }
}
