<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\WeatherData;
use Illuminate\Http\Request;
use Nette\Utils\Random;
use App\Charts\NoChartData;

//------------------------------
// ETML - TPI
// Auteur : Camille Déglise
// Date : 21.05.2024
// Modification :  v2_23.05.2024 - v3_24.05.2024
//-------------------------------


/**
 * Classe de type Controller
 * Gères les méthodes en lien avec les pages d'accueil
 */
class HomeController extends Controller
{

    /**
     * Retourne la vue de la vue home de base du site 
     * Ne tient pas compte de si l'utilisateur est connecté ou non
     */
    public function home()
    {

        //Création d'un graphique aléatoire
        $location = Location::inRandomOrder()->first();
        $weatherChartController = new WeatherChartController();

        $randomChartData = $weatherChartController->randomWeatherChart($location);
        
            return view('site.home', ['randomChartData' => $randomChartData]);
        // Vérifier si l'utilisateur est authentifié
        if (auth()->check())
        {
            $user = auth()->user();
            return view('site.home-auth',
            [
                'user' => $user
            ]);
        }
    }

    /**
     * Méthode d'affichage de la vue "home" si l'utilisateur est authentifié
     * Retourne une vue
     */
    public function home_auth()
    {

        return view('site.home-auth');
    }


    /**
     * Méthode pour la barre de recherche
     * 
     */
    public function search()
    {
        //Vérifier s'il y a une recherche
        if(request()->has('search'))
        {

        }
        //Si oui, check dans la base de donnée

            //Si ok --> envoi sur la page combinaison
            //Sinon --> message d'erreur et liste des lieux existants, renvoi sur la page d'accueil 
        
    }
}
