<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
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

    public function userSetting($id)
    {
        $user = User::find($id);
        
        return view('admin.settingUser', ['user' => $user]);
    }

    public function deactivateUser($id)
    {
        $user = User::find($id);

        $user->is_activ = false;
        $user->save();

        return redirect()->route('user.setting', ['id' => $user->id])->with('success', 'L\'utilisateur a bien été désactivé.');
    }

    public function reactivateUser($id)
    {
        $user = User::find($id);
        $user->is_activ = true;
        $user->save();

        return redirect()->route('user.setting', ['id' =>$user->id])->with('success', 'L\'utilisateur a bien été réactivé.');
    }

    public function sendResetLink($id)
    {
        $user = User::find($id);
        $status = Password::sendResetLink(['email' =>$user->email]);

        return $status === Password::RESET_LINK_SENT
        ?redirect()->route('user.setting', ['id' => $user->id])->with('success', 'Lien envoyé à l\'utilisateur')
        :redirect()->route('user.setting', ['id' => $user->id])->withErrors(['email' => __($status)]);
    }
}