<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WeatherData;
use Illuminate\Http\Request;
//------------------------------
// ETML - TPI
// Auteur : Camille Déglise
// Date : 28.05.2024
// Modification : selon commit de git
//-------------------------------


/**
 * Classe de type Controller
 * Gère les méthodes avec la modification des données de l'utilisateur
 */
class SettDataController extends Controller
{
    /**
     * Méthode d'affichage de la vue principale de gestion des données de l'utilisateur
     */
    public function showData()
    {
        //Récupérer l'utilisateur actuellement connecté
        $user = auth()->user();

        //Vérifier s'il a importé des données
         if(!$user->weather_datas)
         {
            return redirect()->back()->with('error', 'Vous n\'avez pas importé de donnée');
         }

        //Récupérer les données qui lui sont liées
        $userId = $user->id;

        $weatherDatas = WeatherData::whereIn('user_id', function($query) use ($userId)
            {
                $query->select('id')
                ->from('weather_datas')
                ->where('user_id', $userId);
            })
            ->orderBy('imported_at', 'desc')
            ->join('locations', 'weather_datas.location_id', '=', 'locations.id')
            ->get();
        
            return view('site.showData', compact('weatherDatas'));
    }

    public function showSummary(Request $request)
    {
       $weatherData = WeatherData::with('id')->find($request->id);
        dd($weatherData);
        
        return view('site.showData', compact('datas'));
    }
}
