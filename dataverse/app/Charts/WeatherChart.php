<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;

/**
 * Classe constructrice des graphiques
 * Provient de l'API Laravel Chart 
 */
class WeatherChart extends Chart
{
    /**
     * Constructeur d'objet graphique.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

}