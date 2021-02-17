<?php

namespace App\Models\App;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\User;

class Recensioni extends Model
{
    protected $table = 'recensioni';
    
    public function users(){
        return $this->belongsTo(User::class,'influencer_id','id');
    }
    public function users_to(){
        return $this->belongsTo(User::class,'brand_id','id');
    }
}
