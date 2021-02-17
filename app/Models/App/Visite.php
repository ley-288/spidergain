<?php

namespace App\Models\App;

use Illuminate\Database\Eloquent\Model;

class Visite extends Model
{
    protected $table = 'visite_campagne';
    
    protected $fillable = ['user_id','campagne_id','created_at_campagna'];
    
    public $timestamps = false;
}
