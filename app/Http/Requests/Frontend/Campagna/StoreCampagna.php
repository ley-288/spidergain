<?php

namespace App\Http\Requests\Frontend\Campagna;

use Illuminate\Foundation\Http\FormRequest;


class StoreCampagna extends FormRequest
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
        //'data_inizio' => 'date_format:d/m/Y|after_or_equal:today',
        return [
            'comuni' => 'nullable|array|max:10',
            'comuni.*' => 'integer|exists:comuni,id',
            'titolo' => 'required|max:50',
            'tipologia' => 'required|in:online,offline',
            'canali' => 'required|array|max:10',
            'canali.*'=> 'in:facebook,twitter,linkedin,instagram,youtube,blog,mailing_list,giornale_tiratura,eventi_numero,negozio_metri',
            'categorie' => 'required|array|max:10',
            'categorie.*' => 'exists:categorie,id',
            'data_inizio' => 'date_format:d/m/Y',
            'data_fine' => 'date_format:d/m/Y|after:data_inizio',
            'descrizione' => 'max:1000',
            'file1' => 'file|mimes:jpeg,jpg,jpe,png,pdf|max:5000',
            'file2' => 'file|mimes:jpeg,jpg,jpe,png,pdf|max:5000',
            'file3' => 'file|mimes:jpeg,jpg,jpe,png,pdf|max:5000',
            'budget' => 'nullable|integer|min:1|max:1000000000',
            'budget_periodo' => 'nullable|in:1,2,3',
            'h_allegato_1' => 'nullable|integer|exists:allegati,id',
            'h_allegato_2' => 'nullable|integer|exists:allegati,id',
            'h_allegato_3' => 'nullable|integer|exists:allegati,id',
            'immagine_0' => 'present|nullable|string',
            'immagine_1' => 'present|nullable|string',
            'immagine_2' => 'present|nullable|string',
            
        ];
    }
}
