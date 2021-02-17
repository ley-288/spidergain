<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\App\Richiesta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

//Added




/**
 * Class DashboardController.
 */
class DashboardController extends Controller {

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        
        
        $messaggi = DB::table('messaggi as me')
                    ->join('campagne as ca','ca.id','=','me.campagna_id')
                    ->join('richieste as ri','ca.id','=','ri.campagna_id')
                    ->join('users as u','me.autore_id','=','u.id')
                    ->where('me.autore_id','!=',Auth::user()->id)
                    ->where('me.letto', 0)
                    ->where('me.chat', 1)
                    ->where('ca.data_fine','>=',date('Y-m-d'))
                    ->where('ca.active',1);
                    if(Auth::user()->hasRole('influencer')){                
                      $messaggi->where('me.chat_influencer_id',Auth::user()->id);
                    } else{
                         $messaggi=$messaggi->where('ca.user_id',Auth::user()->id);
                    }
                    $messaggi = $messaggi->groupBy('ca.id','u.avatar_location','u.last_name','u.first_name','ca.titolo','ca.uuid','me.created_at','u.uuid')
                            ->orderBy('me.created_at','DESC')
                            ->select('u.avatar_location','u.last_name','u.first_name','ca.titolo','ca.uuid','me.created_at','u.uuid as u_uuid')
                            ->get();
 
        if (Auth::user()->hasRole('brand')) {
            $richieste = Richiesta::where('brand_id', Auth::user()->id)
                    ->where('accettata', '1')
                    ->whereNull('offerta_accettata')
                    ->whereNull('offerta_rifiutata')
                    ->whereHas('users', function($q) {
                        $q->where('active', 1);
                    })
                    ->whereHas('campagne', function($q) {
                        $q->where('active', 1);
                    })
                    ->get();

            return view('frontend.user.dashboard')->with('richieste', $richieste)->with('messaggi',$messaggi);
        } else {
            
           $richieste = Richiesta::where('influencer_id', Auth::user()->id)
                ->where('accettata', 2)
                ->where('ca.data_fine', '>', date('Y-m-d'))
                ->where('u.active',1)
                ->join('campagne as ca', 'ca.id', '=', 'richieste.campagna_id')
                ->join('users as u', 'u.id', '=', 'ca.user_id')
                ->count();
            
            
            
            return view('frontend.user.dashboard')->with('messaggi',$messaggi)->with('richieste',$richieste);
        }
    }
    
    
    
    
    
    
    
    
    
    
    

}
