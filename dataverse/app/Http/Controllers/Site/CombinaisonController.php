<?php

namespace App\Http\Controllers\Site;

use App\Charts\WeatherChart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Http\Controllers\Site\WeatherChartController;
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
    public function combinaisonChart(Request $request)
    {
        dd($request);
        

        switch ($request)
        {
            case $request['category'] = 'precipitation':
                $combiChart = app(WeatherChartController::class)->precipChart($request);
        
            case $request['category'] = 'sunshine':
                $combiChart = app(WeatherChartController::class)->sunshineChart($request); 
            
            case $request['category'] = 'snow' :
                $combiChart = app(WeatherChartController::class)->snowChart($request);

            case $request['category'] = 'wind':
                $combiChart =  app(WeatherChartController::class)->windChart($request);
                  
            case $request['category'] = 'temperature':
                $combiChart =  app(WeatherChartController::class)->tempChart($request);
            
            case $request['category'] = 'humidity':
                $combiChart =  app(WeatherChartController::class)->humiChart($request);
                
        } 
        
    }
}
