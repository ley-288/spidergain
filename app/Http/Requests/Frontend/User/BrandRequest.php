<?php

namespace App\Http\Requests\Frontend\User;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            
            'telefono' => ' required|max:40',
            'ragione_sociale' => 'required|max:200',
            'partita_iva' => ' nullable|max:50',
            'azienda_via' => ' required|max:200',
            'azienda_cap' => ' required|max:10',
            'azienda_numero_civico' => ' required|max:10',
            'azienda_citta' => ' required|max:40',
            'azienda_provincia' => ' required|max:100',
            'facebook' => ' nullable|max:250|url',
            'twitter' => ' nullable|max:250|url',
            'instagram' => ' nullable|max:250|url',
            'youtube' => ' nullable|max:2150|url',
            'blog' => ' nullable|max:150|url',
            
        ];
    }
}
