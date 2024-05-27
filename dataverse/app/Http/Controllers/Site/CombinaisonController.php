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
// Modification :
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
        //Définir et retrouver l'id du lieu cliqué
        $location = Location::find($id);

        if($location)
        {
            return view('site.combi', ['location' => $location]);
        }
    }


    /**
     * Méthode qui effectue la combinaison et permet l'affichage du graphique
     * @param $id
     * @param Request $request
     * Retourne la vue combi avec le graphique
     */
    public function combinaisonChart($id, Request $request)
    {
        // Vérifier si le lieu est bien fourni
        $location = Location::find($id);
        if (!$location) {
            return new NoChartData('Pas de localisation disponible');
        }
        //OK dd($location);
       
        // Récupérer les données météorologiques pour ce lieu et cette plage de dates
        $beginDate = $request->input('begin_date');
        $endDate = $request->input('end_date');
        $category = $request->input('category');
        //OK dd($beginDate);
        //OK dd($endDate);
        //OK dd($category);

        $weatherData = WeatherData::where('location_id', $id)
            ->whereBetween('statement_date', [$beginDate, $endDate])
            ->orderBy('statement_date', 'asc')
            ->get();
        
        //OK dd($weatherData);

        // Vérifier si des données ont été trouvées
        if ($weatherData->isEmpty()) {
            return new NoChartData('Pas de données météorologiques disponible pour cette période');
        }
    
        // Sélectionner la fonction de graphique appropriée
        $combiChart = new WeatherChart();
        //dd($combiChart);
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
        //dd($combiChart);
        return view('site.combi', ['combiChart' => $combiChart, 'location' => $location]);
        
    }
}
