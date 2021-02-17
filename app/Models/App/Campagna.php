<?php

namespace App\Models\App;

use Illuminate\Database\Eloquent\Model;
use App\Models\App\Categorie;
use App\Models\App\Comuni;
use App\Models\Traits\Uuid;
use App\Models\Auth\User;
use Auth;
use App\Models\App\Richiesta;

class Campagna extends Model {

    use Uuid;

    protected $table = 'campagne';
    protected $fillable = [
        'titolo',
        'canali',
        'descrizione',
        'tipologia',
        'active',
        'data_fine',
        'data_inizio',
        'budget',
        'budget_periodo',
        'allegati'
    ];
    protected $dates = ['data_inizio','data_fine'];
    public function categorie() {
        return $this->belongsToMany(Categorie::class, 'categorie_campagne');
    }

    public function hasCategorie($categorie_id) {
        return in_array($categorie_id, $this->categorie->pluck('id')->toArray());
    }
    
     public function comuni() {
        return $this->belongsToMany(Comuni::class, 'comuni_campagne');
    }

    public function hasComuni($comuni_id) {
        return in_array($comuni_id, $this->comuni->pluck('id')->toArray());
    }

    public function users() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function richieste() {
        return $this->hasMany(Richiesta::class, 'campagna_id', 'id');
    }

    public function campagne($stato) {



        if ($stato == 1) {
            $campagne = $this::where('active', 1)->where('data_fine', '>=', date('Y-m-d'));
        } else {
            $campagne = $this::where(function($query){
            $query->where('active', 0)->orWhere('data_fine', '<', date('Y-m-d'));
            });
        }


        if (Auth::user()->hasRole('brand')) {
            $campagne->where('user_id', Auth::user()->id);
        }
        if (Auth::user()->hasRole('influencer')) {
            $campagne->join('richieste as ri', 'ri.campagna_id', '=', 'campagne.id');
            $campagne->where('ri.influencer_id', Auth::user()->id);
            $campagne->where('ri.accettata', 1);
        }

        $campagne->with('users.dettagli')
                ->orderBy('campagne.created_at', 'DESC');
        return $campagne;
    }

}
