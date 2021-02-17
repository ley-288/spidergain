<?php

use App\Models\App\Campagna;
use App\Models\App\Messaggio;
/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('chat.{id}', function ($user, $id) {
    
    $messaggio = Messaggio::where('id',$id);
    if($messaggio){
        $campagna = Campagna::where('id',$messaggio->campagna_id);
        if($campagna){
            if($campgna->user_id == $user->id || $messaggio->chat_influencer_id == $user->id){
                return true;
            }
        }
    }
    return false;
});
