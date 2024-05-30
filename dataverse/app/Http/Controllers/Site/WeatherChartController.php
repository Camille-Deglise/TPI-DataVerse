<?php

namespace App\Http\Controllers\Site;

use Carbon\Carbon;
use App\Charts\NoChartData;
use App\Charts\WeatherChart;
use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\WeatherData;
use Illuminate\Http\Request;


//------------------------------
// ETML - TPI
// Auteur : Camille Déglise
// Date : 21.05.2024
// Modification :  selon commit de git
//-------------------------------



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

            $availableDatas[$data] = $count;

        }
        
        return $availableDatas;
    }


    /**
     * Méthode publique de création de graphique aléatoire
     * Retourne un graphique
     */
    public function randomWeatherChart($location)
    {
        // Vérifier si une localisation a été fournie
        if (!$location) {
            return new NoChartData('Pas de localisation disponible');
        }
    
        // Déterminer les données météorologiques disponibles pour cette localisation
        $availableDatas = $this->getAvailableWeatherDatas($location->id);
    
        // Vérifier si des données météorologiques sont disponibles
        if (empty($availableDatas)) {
            return new NoChartData('Pas de données météos disponible');
        }
    
        // Sélectionner aléatoirement le type de données météorologiques à afficher
        $randomData = $availableDatas[array_rand($availableDatas)];
    
        // Reprendre les données météorologiques pour une date aléatoire
        $randomWeatherData = WeatherData::where('location_id', $location->id)
            ->inRandomOrder() // Choisir aléatoirement un enregistrement
            ->first();
    
        // Vérifier si des données météorologiques ont été trouvées
        if (!$randomWeatherData) {
            return new NoChartData('Pas de données météorologiques disponible pour cette localisation');
        }
    
        // Créer le graphique avec les données sélectionnées
        $randomChart = new WeatherChart;
        $randomChart->labels([$randomWeatherData->statement_date]);
        $randomChart->dataset(ucfirst($randomData), 'bar', [$randomWeatherData->$randomData])->backgroundColor('rgb(58, 129, 139)');
    
        return $randomChart;
    }

    /**
     * Méthode publique de création de graphique pour les précipitations
     * Retourne un graphique
     */
    public function precipChart($weatherData)
    {   
        //dd($weatherData);
        //Filtre les données récupérées si elles ne sont pas à null
        $weatherdatasFiltred = $weatherData->filter(function($data)
        {
            return $data ->precipitation != null;
        });
        
        //S'il n' y a pas suffisamment de valeurs pour générer un graphique 
        if($weatherdatasFiltred->pluck('precipitation')->count()<3)
        {
            return new NoChartData("Il manque des données pour générer un graphique");
        }
        //dd($weatherdatasFiltred);
        $precipChart = new WeatherChart;
 
        //Axe X
        $dates = $weatherdatasFiltred->pluck('statement_date');

        //Axe Y
        $precipitations = $weatherdatasFiltred->pluck('precipitation');
        //dd($precipitations);
        //Associations des axes 
        $precipChart->labels($dates);
        $precipChart->dataset('Précipitations', 'line', $precipitations)->backgroundColor('rgb(109, 204, 217)');

        return $precipChart;
    }

    public function sunshineChart($weatherData)
    {   
        //Filtre les données récupérées si elles ne sont pas à null
        $weatherdatasFiltred = $weatherData->filter(function($data)
        {
            return $data ->sunshine != null;
        });

        //S'il n' y a pas suffisamment de valeurs pour générer un graphique 
        if($weatherdatasFiltred->pluck('sunshine')->count()<3)
        {
            return new NoChartData("Il manque des données pour générer un graphique");
        }
        
        $sunChart = new WeatherChart;

        //Axe X
        $dates = $weatherdatasFiltred->pluck('statement_date');

        //Axe Y
        $sunshine = $weatherdatasFiltred->pluck('sunshine');

        //Associations des axes 
        $sunChart->labels($dates);
        $sunChart->dataset('Ensoleillement', 'line', $sunshine)->backgroundColor('rgb(239, 208, 35)');

        return $sunChart;
    }

    public function snowChart($weatherData)
    {   
        //Filtre les données récupérées si elles ne sont pas à null
        $weatherdatasFiltred = $weatherData->filter(function($data)
        {
            return $data ->snow != null;
        });

        //S'il n' y a pas suffisamment de valeurs pour générer un graphique 
        if($weatherdatasFiltred->pluck('snow')->count()<3)
        {
            return new NoChartData("Il manque des données pour générer un graphique");
        }
        
        $snowChart = new WeatherChart;

        //Axe X
        $dates = $weatherdatasFiltred->pluck('statement_date');

        //Axe Y
        $snow = $weatherdatasFiltred->pluck('snow');

        //Associations des axes 
        $snowChart->labels($dates);
        $snowChart->dataset('Neige', 'bar', $snow)->backgroundColor('rgb(176, 203, 201)');

        return $snowChart;
    }

    public function windChart($weatherData)
    {   
        //Filtre les données récupérées si elles ne sont pas à null
        $weatherdatasFiltred = $weatherData->filter(function($data)
        {
            return $data -> wind != null;
        });

        //S'il n' y a pas suffisamment de valeurs pour générer un graphique 
        if($weatherdatasFiltred->pluck('wind')->count()<3)
        {
            return new NoChartData("Il manque des données pour générer un graphique");
        }
        
        $windChart = new WeatherChart;

        //Axe X
        $dates = $weatherdatasFiltred->pluck('statement_date');

        //Axe Y
        $wind = $weatherdatasFiltred->pluck('wind');

        //Associations des axes 
        $windChart->labels($dates);
        $windChart->dataset('Vent', 'line', $wind)->backgroundColor('rgb(167, 214, 182)');

        return $windChart;
    }

    public function tempChart($weatherData)
    {   
        //Filtre les données récupérées si elles ne sont pas à null
        $weatherdatasFiltred = $weatherData->filter(function($data)
        {
            return $data -> temperature != null;
        });

        //S'il n' y a pas suffisamment de valeurs pour générer un graphique 
        if($weatherdatasFiltred->pluck('temperature')->count()<3)
        {
            return new NoChartData("Il manque des données pour générer un graphique");
        }
        
        $tempChart = new WeatherChart;

        //Axe X
        $dates = $weatherdatasFiltred->pluck('statement_date');

        //Axe Y
        $temperatures = $weatherdatasFiltred->pluck('temperature');

        //Associations des axes 
        $tempChart->labels($dates);
        $tempChart->dataset('Températures', 'line', $temperatures)->backgroundColor('rgb(243, 165, 67 )');

        return $tempChart;
    }

    public function humiChart($weatherData)
    {   
        //Filtre les données récupérées si elles ne sont pas à null
        $weatherdatasFiltred = $weatherData->filter(function($data)
        {
            return $data ->humidity != null;
        });

        //S'il n' y a pas suffisamment de valeurs pour générer un graphique 
        if($weatherdatasFiltred->pluck('humidity')->count()<3)
        {
            return new NoChartData("Il manque des données pour générer un graphique");
        }
        
        $humiChart = new WeatherChart;

        //Axe X
        $dates = $weatherdatasFiltred->pluck('statement_date');

        //Axe Y
        $humidity = $weatherdatasFiltred->pluck('humidity');

        //Associations des axes 
        $humiChart->labels($dates);
        $humiChart->dataset('Humidité', 'bar', $humidity)->backgroundColor('rgb(167, 116, 241)');

        return $humiChart;
    }

}
