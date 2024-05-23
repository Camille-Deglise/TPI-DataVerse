<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\WeatherData;
use Illuminate\Http\Request;
use Nette\Utils\Random;
use App\Charts\NoChartData;

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

    public function home_auth()
    {

        return view('site.home-auth');
    }
}
