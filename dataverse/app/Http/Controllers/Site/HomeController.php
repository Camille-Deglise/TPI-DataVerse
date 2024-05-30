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
        $randomChartData = app(WeatherChartController::class)->randomWeatherChart($location);

        // Vérification s'il y a une requête de type recherche
        if ($request->has('search')) {
            $fromCombi = $request->input('from_combi', false);
            return $this->search($request, $whichView, $randomChartData, $fromCombi);
        }

        return view($whichView, [
            'randomChartData' => $randomChartData,
            'location' => $location,
            'search' => '',
            'locations' => collect(),  //Pour les vues
        ]);
    }

    /**
     * Méthode pour la fonctionnalité de recherche
     * @param Request $request
     * @param $view 
     * @param $randomChartData
     * @param $fromCombi 
     * Fonctionnement différent si la recherche provient de home ou de combinaison
     */
    public function search(Request $request, $view, $randomChartData, $fromCombi = false)
    {
        $query = $request->input('search');
    
        // Recherche de la correspondance exacte
        $exactLocation = Location::where('name', $query)->first();
    
        if ($exactLocation) {
            // Rediriger vers la vue combi du lieu trouvé
            return redirect()->route('combi', ['id' => $exactLocation->id]);
        }
    
        // Si aucune correspondance exacte, continuer avec la recherche partielle
        $locations = Location::where('name', 'like', '%' . $query . '%')->get();
    
        // Si la recherche provient de la vue combi, renvoyer à combi avec les résultats partiels
        if ($fromCombi) {
            return view('site.combi', [
                'randomChartData' => $randomChartData,
                'search' => $query,
                'locations' => $locations,
                'location' => $locations->first() ?? null,
                'availableYears' => $locations->isNotEmpty()
                                ? WeatherData::where('location_id', $locations->first()->id)
                                    ->selectRaw('YEAR(statement_date) as year')
                                    ->distinct()
                                    ->pluck('year')
                                    ->sort()
                                    ->toArray()
                                : [],
                'availableMonths' => $locations->isNotEmpty()
                                ? WeatherData::where('location_id', $locations->first()->id)
                                    ->selectRaw('MONTH(statement_date) as month')
                                    ->distinct()
                                    ->pluck('month')
                                    ->sort()
                                    ->toArray()
                                : [],
            ]);
        } else {
            return view($view, [
                'randomChartData' => $randomChartData,
                'search' => $query,
                'locations' => $locations,
            ]);
        }
    }
    
    
}
