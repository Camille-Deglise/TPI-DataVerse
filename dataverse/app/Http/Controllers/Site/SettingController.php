<?php

namespace App\Http\Controllers\Site;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use Illuminate\Http\Request;

class SettingController extends Controller
{
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

    public function update(SettingRequest $request, User $user)
    {
        $user = User::findOrFail($request->user_id);

        $validatedData = $request->validated();

        $user->update($validatedData);

        return redirect()->route('setting.edit')->with('success', 'Vos données ont bien été modifiées');
    }

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
