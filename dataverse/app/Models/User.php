<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;



//------------------------------
// ETML - TPI
// Auteur : Camille Déglise
// Date : 21.05.2024
// Description : Modèle pour les utilisateurs
// Modification :  selon commit de git
//-------------------------------


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Attributs assignables dans la base de données
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'lastname',
        'firstname',
        'email',
        'password',
        'email_verified_at'
    ];

    /**
     * Fonction servant à récupérer le nom et le prénom de l'utilisateur
     * 
     */
    public function fullName()
    {
        return $this->firstname . ' ' . $this->lastname;
    }    

    /**
     * Fonction protégée reliant la table user et la table weatherdata (fk)
     * Permet de récupérer les données météorologiques que l'utilisateur a importé
     */
    protected function weather_datats()
    {
        return $this->hasMany(WeatherData::class);
    }


    /**
     * Les fonctions ci-dessous sont implémentées de base par Laravel
     */


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
