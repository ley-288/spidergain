<?php

namespace App\Models\Auth;

use App\Models\Auth\Traits\Scope\UserScope;
use App\Models\Auth\Traits\Method\UserMethod;
use App\Models\Auth\Traits\Attribute\UserAttribute;
use App\Models\Auth\Traits\Relationship\UserRelationship;

/**
 * Class User.
 */
class User extends BaseUser
{
    use UserAttribute,
        UserMethod,
        UserRelationship,
        UserScope;
    
    public function dettagli() {
        return $this->hasOne('App\Models\App\Dettagli','id_utente');
    }
    public function campagne() {
        return $this->hasMany('App\Models\App\Campagna','user_id','id');
    }
    public function messaggi() {
        return $this->hasMany('App\Models\App\Messaggio','autore_id','id');
    }
    public function chat() {
        return $this->hasMany('App\Models\App\Messaggio','chat_influencer_id','id');
    }
    public function richieste() {
        return $this->hasMany('App\Models\App\Richiesta','influencer_id','id');
    }
    public function recensioni() {
        return $this->hasMany('App\Models\App\Recensioni','influencer_id','id');
    }
    
     public function recensioni_to() {
        return $this->hasMany('App\Models\App\Recensioni','brand_id','id');
    }
    
}
