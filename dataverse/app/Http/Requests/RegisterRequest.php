<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

//------------------------------
// ETML - TPI
// Auteur : Camille Déglise
// Date : 21.05.2024
// Modification :  selon commit de git
//-------------------------------



/**
 * Classe de type FormRequest
 * Contient les méthodes gérant la validation des données
*/
class RegisterRequest extends FormRequest
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
     * Contient toutes les règles de validations des champs du formulaire d'enregistrement
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'lastname' => ['required', 'string', 'regex:/^[a-zA-ZÀ-ÿ\-\' ]+$/'],
            'firstname' => ['required', 'string', 'regex:/^[a-zA-ZÀ-ÿ\-\' ]+$/'],
            'email'=> ['required','email', 'unique:users,email', 'regex:/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}$/'], 
            'password'=> ['required', 'min:14'],
        ];
    }
}
