<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

//------------------------------
// ETML - TPI
// Auteur : Camille Déglise
// Date : 21.05.2024
// Modification :  v2_23.05.2024
//-------------------------------



class SettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'lastname' => ['required', 'string', 'regex:/^[-a-zA-ZÀ-ÿ]+$/'],
            'firstname' => ['required', 'string', 'regex:/^[-a-zA-ZÀ-ÿ]+$/'],
            'email'=> ['required','email'], 
            'password' =>['confirmed', 'min:14'],
            'password_confirmation' => ['']
        ];
    }
}
