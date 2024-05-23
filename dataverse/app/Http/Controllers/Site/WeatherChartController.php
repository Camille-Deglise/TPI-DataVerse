<?php

namespace App\Http\Controllers\Site;

use Carbon\Carbon;
use App\Charts\NoChartData;
use App\Charts\WeatherChart;
use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\WeatherData;
use Illuminate\Http\Request;

/**
 * Controller pour les graphiques des données 
 * Contient les méthodes de création des graphiques
 */
class WeatherChartController extends Controller
{
    /**
     * Méthode privée pour retrouver les données météos qui contiennent 
     * des valeurs
     * Retourne un tableau de valeurs qui contient les données avec des valeurs
     */
    private function getAvailableWeatherDatas($locationId)
    {
        //Tableau contenant toutes les donneés météos
        $weatherdatas = ['precipitation', 'sunshine', 'snow', 'temperature', 'humidity', 'wind' ];
        
        $availableDatas = [];
        //Recherche dans les données météos les valeurs qui ne sont pas à null 
        //Insértion dans un autre tableau les données qui sont utilisables.
        foreach ($weatherdatas as $data)
        {
            $count = WeatherData::where('location_id', $locationId)
                        ->whereNotNull($data)
                        ->count();
            if($count >= 3)
            {
                $availableDatas[] = $data;
            }
            
        }
        
        return $availableDatas;
    }


    /**
     * Méthode publique de création de graphique aléatoire
     * Retourne un graphique
     */
    public function randomWeatherChart($location)
    {   
        
        //S'il n'y a pas de localisation disponible
        if(!$location)
        {
            return new NoChartData('Pas de localisation disponible');
        }

        //Déterminer les données disponibles dans cette localité
        $availablesDatas = $this->getAvailableWeatherDatas($location->id);
        
        //S'il n'y pas de données valables 
        if(empty($availablesDatas))
        {
            return new NoChartData('Pas de données météos disponible');
        }

        //Effectuer un random pour quelle donnée sera sur le graphique
        $randomData = $availablesDatas[array_rand($availablesDatas)];

        //Obtenir le mois actuel et reprendre une date aléatoire 
        $currentMonth = Carbon::now()->month();
        $randomYear = Carbon::now()->year() - rand(0,10);
        $randomDate = Carbon::create($randomYear, $currentMonth, 1)->startOfMonth();

        //Reprendre les données de la date aléatoire générée avant
        $weatherData = WeatherData::where('location_id', $location->id)
            ->whereBetween('statement_date', $randomDate)
            ->orderBy('statement_date', 'asc')
            ->get();

        $randomChart = new WeatherChart;
        
        $dateChart = $randomDate;
        $dataChart = $weatherData;

        $randomChart->labels($dateChart);
        $randomChart->dataset(ucfirst($randomData), 'line', $dataChart)->backgroudColor('rgb(58, 129, 139)');

        return $randomChart;

    }

    /**
     * Méthode publique de création de graphique pour les précipitations
     * Retourne un graphique
     */
    public function precipitationChart($weatherdatas)
    {   
        //Filtre les données récupérées si elles ne sont pas à null
        $weatherdatasFiltred = $weatherdatas->filter(function($weatherdatas)
        {
            return $weatherdatas -> data != null;
        });

        //S'il n' y a pas suffisamment de valeurs pour générer un graphique 
        if($weatherdatasFiltred->pluck('precipitation')->count()<3)
        {
            return new NoChartData("Il manque des données pour générer un graphique");
        }
        
        
        $precipChart = new WeatherChart;

        //Axe X
        $dates = $weatherdatasFiltred->pluck('statement_date');

        //Axe Y
        $precipitations = $weatherdatasFiltred->pluck('precipitation');

        //Associations des axes 
        $precipChart->labels($dates);
        $precipChart->dataset('Précipitations', 'bar', $precipitations)->backgroudColor('rgb(109, 204, 217)');

        return $precipChart;
    }
}
