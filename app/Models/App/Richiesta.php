<?php

namespace App\Models\App;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\User;
use App\Models\App\Campagna;

class Richiesta extends Model
{
     protected $table = 'richieste';
     
     protected $dates = ['data_inizio','data_fine'];
     
     protected $fillable = ['brand_id','influencer_id'];
     
     public function users(){
        return $this->belongsTo(User::class,'influencer_id','id');
    }
    
     public function campagne(){
        return $this->belongsTo(Campagna::class,'campagna_id','id');
    }
}
