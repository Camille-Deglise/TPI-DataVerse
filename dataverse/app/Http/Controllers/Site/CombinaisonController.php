<?php

namespace App\Http\Controllers\Site;

use App\Charts\WeatherChart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Http\Controllers\Site\WeatherChartController;
use App\Charts\NoChartData;
use App\Models\WeatherData;

//------------------------------
// ETML - TPI
// Auteur : Camille Déglise
// Date : 27.05.2024
// Modification : selon commit de git
//

/**
 * Classe de type Controller
 * Gére les méthodes des graphiques combinés
 */
class CombinaisonController extends Controller
{
      /**
     * Méthode pour la liste de liens
     * @param $id
     * Retourne la vue combi avec le lieu
     */
    public function combi($id)
    {
        // Définir et retrouver l'id du lieu cliqué
        $location = Location::find($id);

        if ($location) {
            // Récupérer les années et les mois disponibles pour ce lieu
            $availableYears = WeatherData::where('location_id', $id)
                                ->selectRaw('YEAR(statement_date) as year')
                                ->distinct()
                                ->pluck('year')
                                ->sort()
                                ->toArray();
            
            $availableMonths = WeatherData::where('location_id', $id)
                                ->selectRaw('MONTH(statement_date) as month')
                                ->distinct()
                                ->pluck('month')
                                ->sort()
                                ->toArray();

            return view('site.combi', [
                'location' => $location,
                'availableYears' => $availableYears,
                'availableMonths' => $availableMonths,
            ]);
        }

        return view('site.combi', ['location' => null]);
    }



    /**
     * Méthode qui effectue la combinaison et permet l'affichage du graphique
     * @param $id
     * @param Request $request
     * Retourne la vue combi avec le graphique
     */
    public function combinaisonChart($id, Request $request)
    {
       //Récupération du select des mois et des années pour début et fin
        $beginYear = $request->input('begin_year');
        $beginMonth = $request->input('begin_month');
        $endYear = $request->input('end_year');
        $endMonth = $request->input('end_month');
        $category = $request->input('category');

        //Comparaison que la catégorie choisie et une catégorie valide
        $validCategories = ['precipitation', 'sunshine', 'snow', 'wind', 'temperature', 'humidity'];
        if (!in_array($category, $validCategories)) {
            $noChartData = new NoChartData('Catégorie invalide');
            return view('site.combi', [
                'noChartData' => $noChartData,
                'availableYears' => WeatherData::where('location_id', $id)->selectRaw('YEAR(statement_date) as year')->distinct()->pluck('year')->sort()->toArray(),
                'availableMonths' => WeatherData::where('location_id', $id)->selectRaw('MONTH(statement_date) as month')->distinct()->pluck('month')->sort()->toArray()
            ]);
        }
        
        //Formatage des dates comme dans la base de données avec un jour 
        $beginDate = "$beginYear-$beginMonth-01";
        $endDate = date("Y-m-t", strtotime("$endYear-$endMonth-01")); 

        //Récupération des données correspondantes aux dates choisies
        $weatherData = WeatherData::where('location_id', $id)
            ->whereBetween('statement_date', [$beginDate, $endDate])
            ->orderBy('statement_date', 'asc')
            ->get();

        if ($weatherData->isEmpty()) {
            $noChartData = new NoChartData('Pas de données météorologiques disponible pour cette période');
            return view('site.combi', [
                'noChartData' => $noChartData,
                'availableYears' => WeatherData::where('location_id', $id)->selectRaw('YEAR(statement_date) as year')->distinct()->pluck('year')->sort()->toArray(),
                'availableMonths' => WeatherData::where('location_id', $id)->selectRaw('MONTH(statement_date) as month')->distinct()->pluck('month')->sort()->toArray()
            ]);
        }

        //Initialisation de la variable qui contiendra le graphique
        $combiChart = null;

        //Choix du graphique selon la catégorie
        switch ($category) {
            case 'precipitation':
                $combiChart = app(WeatherChartController::class)->precipChart($weatherData);
                break;
            case 'sunshine':
                $combiChart = app(WeatherChartController::class)->sunshineChart($weatherData);
                break;
            case 'snow':
                $combiChart = app(WeatherChartController::class)->snowChart($weatherData);
                break;
            case 'wind':
                $combiChart = app(WeatherChartController::class)->windChart($weatherData);
                break;
            case 'temperature':
                $combiChart = app(WeatherChartController::class)->tempChart($weatherData);
                break;
            case 'humidity':
                $combiChart = app(WeatherChartController::class)->humiChart($weatherData);
                break;
        }

        //Cas où le graphique n'est pas généré
        if ($combiChart instanceof NoChartData) {
            return view('site.combi', [
                'noChartData' => $combiChart,
                'availableYears' => WeatherData::where('location_id', $id)->selectRaw('YEAR(statement_date) as year')->distinct()->pluck('year')->sort()->toArray(),
                'availableMonths' => WeatherData::where('location_id', $id)->selectRaw('MONTH(statement_date) as month')->distinct()->pluck('month')->sort()->toArray()
            ]);
        }
        
        //Rendu du graphique avec toutes les dates 
        return view('site.combi', [
            'combiChart' => $combiChart,
            'beginYear' => $beginYear,
            'beginMonth' => $beginMonth,
            'endYear' => $endYear,
            'endMonth' => $endMonth,
            'category' => $category,
            'availableYears' => WeatherData::where('location_id', $id)->selectRaw('YEAR(statement_date) as year')->distinct()->pluck('year')->sort()->toArray(),
            'availableMonths' => WeatherData::where('location_id', $id)->selectRaw('MONTH(statement_date) as month')->distinct()->pluck('month')->sort()->toArray()
        ]);
    }


}
