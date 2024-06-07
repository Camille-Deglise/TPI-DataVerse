<?php

namespace App\Http\Controllers\Site;

use App\Models\User;
use App\Models\Location;
use App\Models\WeatherData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
//------------------------------
// ETML - TPI
// Auteur : Camille Déglise
// Date : 29.05.2024
// Modification : selon commit de git
//

/**
 * Classe de type Controller
 * Gére les méthodes pour l'administrateur
 */
class AdminController extends Controller
{
    /**
     * Méthode de la recherche des utilisateurs par l'administrateur
     * Prend la requête HTTP en paramètres
     * Retourne la vue hom-admin avec les résultats de la recherche
     */
    public function searchUsers(Request $request)
    {
        //Initialisation de la variable pour la recherche
        $search = $request->input('search');

        //Query Builder pour les utilisateurs
        $usersQuery = User::query();

        //Recherche des utilisateurs en lien avec la recherche et exécution
        $usersQuery->where('lastname', 'like', '%' . $search . '%');
        $users = $usersQuery->get();
        
        $exactUser = $usersQuery->where('lastname', $search)
                                ->orWhere('email', $search)
                                ->first();
        
        return view('admin.home-admin', [
            'search' => $search,
            'exactUser' => $exactUser,
            'users' => $users]);
    }

    /**
     * Méthode affichant la page du contributeur pour l'administrateur
     * Retourne une vue
     */
    public function userSetting($id)
    {
        $user = User::find($id);
        
        return view('admin.settingUser', ['user' => $user]);
    }

    /**
     * Méthode pour désactiver l'utilisateur
     * @param $id
     * Retourne sur la page de gestion de l'utilisateur avec message de succès
     */
    public function deactivateUser($id)
    {
        $user = User::find($id);

        $user->is_activ = false;
        $user->save();

        return redirect()->route('user.setting', ['id' => $user->id])->with('success', 'L\'utilisateur a bien été désactivé.');
    }

    /**
     * Méthode pour réactiver l'utilisateur
     * @param $id
     * Retourne sur la page de gestion de l'utilisateur avec message de succès
     */
    public function reactivateUser($id)
    {
        $user = User::find($id);
        $user->is_activ = true;
        $user->save();

        return redirect()->route('user.setting', ['id' =>$user->id])->with('success', 'L\'utilisateur a bien été réactivé.');
    }

    /**
     * Méthode pour envoyer le lien de réinitilisation du mot de passe à l'utilisateur
     * @param $id
     * Retourne sur la page de gestion de l'utilisateur avec message de succès ou d'erreurs
     */
    public function sendResetLink($id)
    {
        $user = User::find($id);
        $status = Password::sendResetLink(['email' =>$user->email]);

        return $status === Password::RESET_LINK_SENT
        ?redirect()->route('user.setting', ['id' => $user->id])->with('success', 'Lien envoyé à l\'utilisateur')
        :redirect()->route('user.setting', ['id' => $user->id])->withErrors(['email' => __($status)]);
    }

    /**
     * Méthode de gestion de toutes les données
     * Retourn la vue de gestion
     */

    public function allDatas()
    {
        $allDatas = WeatherData::all();
        $allLocations = Location::all();
        $allUsers = User::where('');
        
        
        
        return view('admin.settingDatas', ['allDatas' =>$allDatas, 'allLocations' => $allLocations, 'allUsers' => $allUsers]);
    }
}