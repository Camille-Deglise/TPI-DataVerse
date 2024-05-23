<?php

namespace App\Charts;

/**
 * Classe constructrice 
 * Utilisée dans le cas où il n'y pas de données pour générer un graphique
 * Ou pas suffisamment
 */
class NoChartData
{
    public $message;

    /**
     * Constructeur du message 
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    
}