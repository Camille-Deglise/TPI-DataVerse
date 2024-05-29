<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

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
        
        return view('admin.settingUser', ['user', $user]);
    }
}
