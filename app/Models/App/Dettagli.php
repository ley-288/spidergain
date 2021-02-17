<?php

namespace App\Models\App;

use Illuminate\Database\Eloquent\Model;
use App\Models\App\Categorie;
use App\Models\App\Comuni;

class Dettagli extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'campi_aggiuntivi';
    
    protected $fillable = [
        'residenza_citta',
        'descrizione',
        'ruolo',
        'residenza_nazione',
        'telefono',
        'ragione_sociale',
        'partita_iva',
        'azienda_via',
        'azienda_cap',
        'azienda_numero_civico',
        'azienda_citta',
        'azienda_provincia',
        'azienda_nazione',
        'facebook',
        'facebook_follower',
        'twitter',
        'instagram',
        'intagram_follower',
        'linkedin',
        'linkedin_follower',
        'twitter_follower',
        'instagram_follower',
        'youtube',
        'youtube_follower',
        'blog',
        'blog_visualizzazioni',
        'blog_follower',
        'mailing_list',
        'mailing_list_aperture',
        'mailing_list_click',
        'giornale_tiratura',
        'giornale_periodo',
        'giornale_area',
        'negozio_metri',
        'negozio_area',
        'negozio_posizione',
        'negozio_clienti',
        'eventi_numero',
        'eventi_partecipanti',
        'id_utente'
        ];
       

    public function categorie() {
        return $this->belongsToMany(Categorie::class,'categorie_utenti');
    }
    
    public function hasCategorie($categorie_id) {
        return in_array($categorie_id, $this->categorie->pluck('id')->toArray());
    }
    
     public function comuni() {
        return $this->belongsToMany(Comuni::class,'comuni_utenti');
    }
    
    public function hasComuni($comuni_id) {
        return in_array($comuni_id, $this->comuni->pluck('id')->toArray());
    }
    
    

}
