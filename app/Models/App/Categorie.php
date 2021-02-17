<?php

namespace App\Models\App;

use Illuminate\Database\Eloquent\Model;
use App\Models\App\Dettagli;
use App\Models\App\Campagna;

class Categorie extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categorie';

    public function dettagli() {
        return $this->belongsToMany(Dettagli::class,'categorie_utenti');
    }
    
    public function campagna() {
         return $this->belongsToMany(Campagne::class,'categorie_campagne');
    }

}
