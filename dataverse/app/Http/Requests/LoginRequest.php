<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


//------------------------------
// ETML - TPI
// Auteur : Camille Déglise
// Date : 23.05.2024
// Modification :  selon commit de git
//-------------------------------


/**
 * Classe de type FormRequest
 * Contient les méthodes gérant la validation des données
*/
class LoginRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur a le droit d'effectuer cette requête
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Méthode de validation pour les requêtes.
     * Contient toutes les règles de validations des champs du formulaire de connexion 
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email'=> 'required|email',
            'password'=> 'required|min:14'
        ];
    }
}
