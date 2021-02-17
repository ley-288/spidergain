<?php

namespace App\Models\App;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\User;

class Messaggio extends Model
{
      protected $table = 'messaggi';
      
      public function users(){
        return $this->belongsTo(User::class,'autore_id','id');
    }
}
