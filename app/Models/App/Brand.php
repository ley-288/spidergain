<?php

namespace App\Models\App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'campi_aggiuntivi';
    
    protected $fillable = [
        'ragione_sociale',
        'partita_iva',
        'descrizione',
        'azienda_via',
        'azienda_numero_civico',
        'azienda_citta',
        'azienda_provincia',
        'azienda_cap',
        'telefono',
        'azienda_email',
        'facebook',
        'twitter',
        'instagram',
        'youtube',
        'blog',
        'id_utente'
    ];
}
