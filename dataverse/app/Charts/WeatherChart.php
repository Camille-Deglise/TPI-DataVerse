<?php

namespace App\Charts;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

//------------------------------
// ETML - TPI
// Auteur : Camille Déglise
// Date : 21.05.2024
// Modification : selon commits de gitHub
//-------------------------------


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