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
                'search' => '',
                'locations' => collect(),
            ]);
        }
    
        return view('site.combi', [
            'location' => null,
            'availableYears' => [],
            'availableMonths' => [],
            'search' => '',
            'locations' => collect(),
        ]);
    }
    
    
    /**
     * Méthode qui effectue la combinaison et permet l'affichage du graphique
     * @param $id
     * @param Request $request
     * Retourne la vue combi avec le graphique
     */
    public function combinaisonChart($id, Request $request)
    {
        $location = Location::findOrFail($id); 
        
         // Récupérer les données météorologiques pour ce lieu et cette plage de dates
        $beginYear = $request->input('begin_year');
        $beginMonth = $request->input('begin_month');
        $endYear = $request->input('end_year');
        $endMonth = $request->input('end_month');
        $category = $request->input('category');
    
        
        $validCategories = ['precipitation', 'sunshine', 'snow', 'wind', 'temperature', 'humidity'];
        if (!in_array($category, $validCategories)) {
            $noChartData = new NoChartData('Catégorie invalide');
            return $this->returnCombiView($noChartData, $location);
        }
        
        //Formatage et calcul des dates
        $beginDate = "$beginYear-$beginMonth-01";
        $endDate = date("Y-m-t", strtotime("$endYear-$endMonth-01")); 
    
        $weatherData = WeatherData::where('location_id', $id)
            ->whereBetween('statement_date', [$beginDate, $endDate])
            ->orderBy('statement_date', 'asc')
            ->get();
    
        if ($weatherData->isEmpty()) {
            $noChartData = new NoChartData('Pas de données météorologiques disponible pour cette période');
            return $this->returnCombiView($noChartData, $location);
        }
    
        $combiChart = $this->createCombiChart($category, $weatherData);
    
        return $this->returnCombiView($combiChart, $location, $beginYear, $beginMonth, $endYear, $endMonth, $category);
    }

    /**
     * Méthode privée pour simplifier la lecture de combinaisonChart()
     */
    private function createCombiChart($category, $weatherData)
    {
        switch ($category) {
            case 'precipitation':
                return app(WeatherChartController::class)->precipChart($weatherData);
            case 'sunshine':
                return app(WeatherChartController::class)->sunshineChart($weatherData);
            case 'snow':
                return app(WeatherChartController::class)->snowChart($weatherData);
            case 'wind':
                return app(WeatherChartController::class)->windChart($weatherData);
            case 'temperature':
                return app(WeatherChartController::class)->tempChart($weatherData);
            case 'humidity':
                return app(WeatherChartController::class)->humiChart($weatherData);

        }
    }

    /**
     * Méthode privée pour simplifier la lecture de combinaisonChart()
     * Gère le return
     */
    private function returnCombiView($chartData, $location, $beginYear = null, $beginMonth = null, $endYear = null, $endMonth = null, $category = null)
    {  
        return view('site.combi', [
            'combiChart' => $chartData,
            'location' => $location,
            'beginYear' => $beginYear,
            'beginMonth' => $beginMonth,
            'endYear' => $endYear,
            'endMonth' => $endMonth,
            'category' => $category,
            'availableYears' => WeatherData::where('location_id', $location->id)->selectRaw('YEAR(statement_date) as year')->distinct()->pluck('year')->sort()->toArray(),
            'availableMonths' => WeatherData::where('location_id', $location->id)->selectRaw('MONTH(statement_date) as month')->distinct()->pluck('month')->sort()->toArray(),
            'search' => '',
            'locations' => collect(),
        ]);
    }

    
}