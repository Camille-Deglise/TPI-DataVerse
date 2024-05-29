<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Support\Facades\DB;
use App\Models\WeatherData;
use Illuminate\Http\Request;
use Nette\Utils\Random;
use App\Charts\NoChartData;

//------------------------------
// ETML - TPI
// Auteur : Camille Déglise
// Date : 21.05.2024
// Modification : selon commit de git
//-------------------------------


/**
 * Classe de type Controller
 * Gères les méthodes en lien avec les pages d'accueil
 */
class HomeController extends Controller
{
    /**
     * Méthode d'affichage de la vue 
     * @param Request  $request
     * Retourne la vue de la vue home selon la connexion de l'utilisateur
     */
    public function home(Request $request)
{
    // Vérification de l'authentification de l'utilisateur
    $userChecked = auth()->check();
    $userAdmin = $userChecked ? auth()->user()->is_admin : false;

    // Choix de la vue s'il est connecté ou non
    if ($userChecked && $userAdmin) {
        $whichView = 'admin.home-admin';
    } else {
        $whichView = $userChecked ? 'site.home-auth' : 'site.home';
    }

    // Création d'un graphique aléatoire
    $location = Location::inRandomOrder()->first();
    $weatherChartController = new WeatherChartController();
    $randomChartData = $weatherChartController->randomWeatherChart($location);

    // Vérification s'il y a une requête de type recherche
    if ($request->has('search')) {
        return $this->search($request, $whichView, $randomChartData);
    }

    return view($whichView, [
        'randomChartData' => $randomChartData,
        'search' => '',
        'locations' => collect(),   // Collect reprend les lieux dans un tableau
    ]);
}

    /**
     * Méthode privée pour la barre de recherche
     * @param Request $request
     * @param $view
     * @param $randomChartData  Nécessaire si la vue choisie est pour l'utilisateur non connecté
     * Retourne une vue qui est déterminée par la méthode home 
     */
    private function search(Request $request, $view, $randomChartData)
    {
        //Initialisation d'une variable qui prend ocmme valeur la recherche 
        $search = $request->input('search');
        
        //Query Builder pour les lieux
        $locationsQuery = Location::query();
    
        // Recherche de lieux avec des lettres en commun avec la recherche
        $locationsQuery->where('name', 'like', '%' . $search . '%');
        
        //Exécution de la requête (Sans cela, ne récupérait pas les résultats, toujours vides.)
        $locations = $locationsQuery->get(); 
        
        //Détermine le lieu exact 
        $exactLocation = $locationsQuery->where('name', $search)
                                        ->orWhere('zipcode', $search)
                                        ->first();
    
        // Retourner la vue avec les résultats de la recherche
        return view($view, [
            'randomChartData' => $randomChartData,
            'search' => $search,
            'locations' => $locations, 
            'exactLocation' => $exactLocation,
        ]);
    }
  
}
