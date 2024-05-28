<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportRequest extends FormRequest
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

            'newLocationName' => ['nullable','string','max:163', 'regex:/^[a-zA-ZÀ-ÿ\-\' ]+$/'],
            'newLocationZip' => ['nullable','string', 'max:10', 'regex:/^[a-zA-Z0-9\-\ ]*$/']
        ];
    }
}
