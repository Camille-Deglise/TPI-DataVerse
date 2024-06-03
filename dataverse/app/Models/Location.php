<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//------------------------------
// ETML - TPI
// Auteur : Camille Déglise
// Date : 21.05.2024
// Description : Modèle pour les lieux
// Modification :  selon commit de git
//-------------------------------


class Location extends Model
{
    use HasFactory;

    /** 
    * Attributs assignables dans la base de données
    *
    */
    protected $table = 'locations';
    protected $fillable = 
    [
        'name',
        'zipcode'
    ];

    /**
     * Fonction protégée qui relie la table location à la table weather_data
     * Permet de récupérer les données météorologiques qui sont associés à la localisation
     */
    protected function weather_datas()
    {
        return $this->hasMany(WeatherData::class);
    }


}
