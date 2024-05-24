<?php
namespace App\Http\Controllers\Site;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use Illuminate\Http\Request;


//------------------------------
// ETML - TPI
// Auteur : Camille Déglise
// Date : 21.05.2024
// Modification :  v2_24.05.2024
//-------------------------------


/**
 * Classe de type Controller
 * Gères les méthodes CRUD pour les utilisaeurs 
 */
class SettingController extends Controller
{
    /**
     * Méthode d'affichage du formulaire de modification des données
     * Retourne une vue
     */
    public function edit()
    {
        // Vérifier si l'utilisateur est authentifié
        if (!auth()->check()) {
            // Rediriger vers la page de connexion ou afficher un message d'erreur
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour accéder à cette page.');
            }

        // Récupérer l'utilisateur actuellement authentifié
        $user = auth()->user();
    

        return view('site.setting', 
        [
            'user' => $user
        ]);
    }

    /**
     * Méthode pour modifier les données de l'utilisateur dans la base de données
     * Retourne une redirection avec un message de succès
     */
    public function update(SettingRequest $request, User $user)
    {
        $user = User::findOrFail($request->user_id);

        $validatedData = $request->validated();

        $user->update($validatedData);

        return redirect()->route('setting.edit')->with('success', 'Vos données ont bien été modifiées');
    }

    /**
     * Méthode pour modifier le mot de passe de l'utilisateur dans la base de données
     * Retourne une redirection avec un message de succès
     */
    public function updpwd(SettingRequest $request, User $user)
    {
        $user = User::findOrFail($request->user_id);

        $validatedData = $request->validated();

        $user->update($validatedData, [
            'password' => bcrypt('password')
        ]);

        return redirect()->route('setting.edit')->with('success', 'Votre mot de passe a bien été modifié');
    }
}
