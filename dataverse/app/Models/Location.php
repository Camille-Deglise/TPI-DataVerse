<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    /** 
    * Attributs assignables dans la base de données
    *
    */
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
