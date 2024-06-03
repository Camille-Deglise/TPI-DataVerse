<?php
namespace App\Http\Controllers\Site;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\PwdSettingRequest;
use App\Http\Requests\SettingRequest;
use Illuminate\Http\Request;


//------------------------------
// ETML - TPI
// Auteur : Camille Déglise
// Date : 21.05.2024
// Modification :  selon commit de git
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
    public function updpwd(PwdSettingRequest $request, User $user)
    {
        $user = User::findOrFail($request->user_id);

        $validatedData = $request->validated();

        $user->update($validatedData, [
            'password' => bcrypt('password')
        ]);

        return redirect()->route('setting.edit')->with('success', 'Votre mot de passe a bien été modifié');
    }

    public function deactivateAccount(Request $request, $id)
    {
        $user = User::find($id);

        if ($user) {
            $user->is_activ = false; // Assurez-vous que c'est bien `is_active` et pas `is_activ`
            $user->save();

            // Déconnexion de l'utilisateur
            auth()->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->with('success', 'Votre compte a bien été désactivé.');
        }

        return redirect()->back()->with('error', 'Une erreur est survenue lors de la désactivation du compte.');
    }

}
