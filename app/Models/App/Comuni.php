<?php

namespace App\Models\App;

use Illuminate\Database\Eloquent\Model;
use App\Models\App\Dettagli;
use App\Models\App\Campagna;

class Comuni extends Model
{
      /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comuni';

    public function dettagli() {
        return $this->belongsToMany(Dettagli::class,'comuni_utenti');
    }
    
    public function campagna() {
         return $this->belongsToMany(Campagne::class,'comuni_campagne');
    }
}
