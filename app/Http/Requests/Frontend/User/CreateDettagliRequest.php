<?php

namespace App\Http\Requests\Frontend\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateDettagliRequest extends FormRequest
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
            'descrizione' => 'nullable|max:1000',
            'ruolo' => 'required|max:500',
            'telefono' => ' nullable|max:40',
            'ragione_sociale' => 'nullable|max:200',
            'partita_iva' => ' nullable|max:50',
            'azienda_via' => ' nullable|max:200',
            'azienda_cap' => ' nullable|max:10',
            'azienda_numero_civico' => ' nullable|max:10',
            'azienda_citta' => ' nullable|max:40',
            'azienda_provincia' => ' nullable|integer',
            'azienda_nazione' => ' nullable|integer|max:249',
            'facebook' => ' nullable|max:250|url',
            'facebook_follower' => ' nullable|integer',
            'twitter' => ' nullable|max:250|url',
            'twitter_follower' => ' nullable|integer',
            'instagram' => ' nullable|max:250|url',
            'instagram_follower' => ' nullable|integer',
            'linkedin' => ' nullable|max:250|url',
            'linkedin_follower' => ' nullable|integer',
            'youtube' => ' nullable|max:2150|url',
            'youtube_follower' => ' nullable|integer',
            'blog' => ' nullable|max:150|url',
            'blog_follower' => ' nullable|integer',
            'blog_visualizzazioni' => ' nullable|integer',
            'mailing_list' => ' nullable|integer',
            'mailing_list_aperture' => ' nullable|numeric',
            'mailing_list_click' =>  'nullable|numeric',
            'giornale_tiratura' => ' nullable|integer',
            'giornale_periodo' => ' nullable|max:50',
            'giornale_area' => ' nullable|max:50',
            'negozio_metri' => ' nullable|integer',
            'negozio_area' => ' nullable|max:50',
            'negozio_posizione' => ' nullable|max:50',
            'negozio_clienti' => ' nullable|integer',
            'eventi_numero' => ' nullable|integer',
            'eventi_partecipanti' => ' nullable|integer' 
        ];
    }
}
