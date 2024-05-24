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
    public function home(Request $request)
    {
        if ($request->has('search')) {
            return $this->search($request);
        }
        //Création d'un graphique aléatoire
        $location = Location::inRandomOrder()->first();
        $weatherChartController = new WeatherChartController();

        $randomChartData = $weatherChartController->randomWeatherChart($location);
        
        return view('site.home', [
            'randomChartData' => $randomChartData,
            'search' => '',  // Ajout de 'search' vide
            'locations' => collect()  // Ajout de 'locations' vide
        ]);
    }
    

    /**
     * Méthode d'affichage de la vue "home" si l'utilisateur est authentifié
     * Retourne une vue
     */
    public function home_auth(Request $request)
    {
        if ($request->has('search')) {
            return $this->search($request);
        }
        return view('site.home-auth', [
            'search' => '',  // Ajout de 'search' vide
        ]);
    }


    /**
     * Méthode privée pour la barre de recherche
     * 
     */
    private function search(Request $request)
    {
        // Query builder
        $locations = Location::query();

        // Vérifier s'il y a une recherche
        if ($search = $request->search) {
            // Recherche exacte sur le nom
            $exactLocation = $locations->where('name', $search)
                                    ->orWhere('zipcode', $search)
                                    ->first();

            if ($exactLocation) {
                // Si une correspondance exacte est trouvée, redirection vers la page de détails
                return view('site.combi', ['location' => $exactLocation, 'search' => $search]);
            } 
            else {
                // Sinon, recherche de lieux contenant la partie de texte entrée
                $locationsContaining = $locations->where('name', 'LIKE', '%' . $search . '%')
                                                ->orWhere('zipcode', 'LIKE', '%' . $search . '%')
                                                ->get();

                // Retourner la liste des lieux correspondants
                return view('site.home-auth', ['locations' => $locationsContaining, 'search' => $search]);
            }
        } 
    }
}
