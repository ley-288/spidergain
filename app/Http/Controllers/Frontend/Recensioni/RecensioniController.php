<?php

namespace App\Http\Controllers\Frontend\Recensioni;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\App\Recensioni;
use App\Models\App\Campagna;
use Auth;
use App\Models\Auth\User;

class RecensioniController extends Controller
{
    public function add_recensione(Request $request) {
        
        $request->validate([
            'radio6' => 'required|integer',
            'descrizione' => 'nullable|max:500',
            'campagna' => 'required|UUID',
            'influencer' => 'required|UUID'
        ]);
        
        $user = Auth::user();
        $recensione = new Recensioni;
        $recensione->brand_id = $user->id;
        $influencer = User::where('uuid',$request->influencer)->firstOrFail();
        $recensione->influencer_id = $influencer->id;
        $campagna = Campagna::where('uuid',$request->campagna)->firstOrFail();
        $recensione->campagna_id = $campagna->id;
        //controlla se esiste già per questa campagna
        $check_recensione = Recensioni::where('campagna_id',$campagna->id)->where('influencer_id',$influencer->id)->first();
        
        if($check_recensione){
            abort(404);
        }
        if($campagna->user_id != $user->id){
            abort(403);
        }
        
        $recensione->descrizione = $request->descrizione;
        $recensione->voto = $request->radio6;
        $recensione->save();        
        return redirect()->back()->with('flash_success','applicazione.recensione_aggiunta');
    }
}
