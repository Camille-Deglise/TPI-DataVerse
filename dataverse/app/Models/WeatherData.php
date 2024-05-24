<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



//------------------------------
// ETML - TPI
// Auteur : Camille Déglise
// Date : 21.05.2024
// Description : Modèle pour les données météorologiques
// Modification :  
//-------------------------------
class WeatherData extends Model
{
    use HasFactory;

    protected $table = 'weather_datas';

    /** 
    * Attributs assignables dans la base de données
    *
    */
    protected $fillable =
    [
        'precipitation',
        'sunshine',
        'snow',
        'temperature',
        'humidity',
        'wind',
        'statement_date',
        'imported_at',
        'user_id',
        'location_id'
    ];

    /**
     * Fonction protégée correspondant à la liaison entre la table weather_data et la table user (fk)
     * Permet de retrouver l'utilisateur qui a inscrit les données météorologiques
     */
    protected function users()
    {
        return $this -> belongsTo(User::class, 'user_id');
    }

    /**
     * Fonction protégée correspondant à la liaison entre la table weather_data et la table location (fk)
     * Permet de retrouver la localisation qui sont reliée aux données météorologiques
     */
    public function locations()
    {
        return $this -> belongsTo(Location::class, 'location_id');
    }
}
