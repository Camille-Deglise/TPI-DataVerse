<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
//------------------------------
// ETML - TPI
// Auteur : Camille Déglise
// Date : 28.05.2024
// Modification :  selon commit de git
//-------------------------------


/**
 * Classe de type FormRequest
 * Contient les méthodes gérant la validation des données
*/
class SettDataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
