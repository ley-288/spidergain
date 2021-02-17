<?php

namespace App\Http\Controllers\Frontend\Influencer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Auth\User;
use App\Models\App\Recensioni;

class InfluencerController extends Controller
{
    public function get_influencer($uuid){
        $user = User::role('influencer')
                ->where('uuid',$uuid)
                ->where('active', 1)
                ->with('dettagli.comuni')
                ->with(['richieste' => function($q){
                    $q->where('offerta_accettata','1');
                }])
                
                ->with('recensioni.users.dettagli')
                ->firstOrfail();
                
       if($user){
            $canali = [];
            if($user->dettagli->facebook){
                $canali['facebook']['link'] = $user->dettagli->facebook;
                $canali['facebook']['count'] = $user->dettagli->facebook_follower;
                $canali['facebook']['icon'] = 'fab fa-facebook';
                $canali['facebook']['label'] = 'facebook_follower';
            }
            if($user->dettagli->instagram){
                $canali['instagram']['link'] = $user->dettagli->instagram;
                $canali['instagram']['count'] = $user->dettagli->instagram_follower;
                $canali['instagram']['icon'] = 'fab fa-instagram';
                $canali['instagram']['label'] = 'instagram_follower';
            }
            if($user->dettagli->twitter){
                $canali['twitter']['link'] = $user->dettagli->twitter;
                $canali['twitter']['count'] = $user->dettagli->twitter_follower;
                $canali['twitter']['icon'] = 'fab fa-twitter';
                $canali['twitter']['label'] = 'twitter_follower';
            }
            if($user->dettagli->youtube){
                $canali['youtube']['link'] = $user->dettagli->youtube;
                $canali['youtube']['count'] = $user->dettagli->youtube_follower;
                $canali['youtube']['icon'] = 'fab fa-youtube';
                $canali['youtube']['label'] = 'youtube_follower';
            }
            if($user->dettagli->linkedin){
                $canali['linkedin']['link'] = $user->dettagli->linkedin;
                $canali['linkedin']['count'] = $user->dettagli->linkedin_follower;
                $canali['linkedin']['icon'] = 'fab fa-linkedin';
                $canali['linkedin']['label'] = 'linkedin_follower';
            }
            if($user->dettagli->blog){
                $canali['blog']['link'] = $user->dettagli->blog;
                $canali['blog']['count'] = $user->dettagli->blog_follower;
                $canali['blog']['icon'] = 'fa fa-desktop';
                $canali['blog']['label'] = 'blog_follower';
            }
            if($user->dettagli->mailing_list){
                
                $canali['mailing_list']['count'] = $user->dettagli->mailing_list;
                $canali['mailing_list']['icon'] = 'fa fa-envelope-open-text';
                $canali['mailing_list']['label'] = 'mailing_list_follower';
            }
            if($user->dettagli->giornale_tiratura){
                
                $canali['giornale_tiratura']['count'] = $user->dettagli->giornale_tiratura;
                $canali['giornale_tiratura']['icon'] = 'fa fa-newspaper';
                $canali['giornale_tiratura']['label'] = 'giornale_tiratura';
            }
            if($user->dettagli->negozio_metri){
                $canali['negozio_metri']['count'] = $user->dettagli->negozio_metri;
                $canali['negozio_metri']['icon'] = 'fa fa-store';
                $canali['negozio_metri']['label'] = 'negozio_metri';
            }
            if($user->dettagli->eventi_numero){
                $canali['eventi_numero']['count'] =  $user->dettagli->eventi_numero;
                $canali['eventi_numero']['icon'] = 'fa fa-users';
                $canali['eventi_numero']['label'] = 'eventi';
            }
            
            $user->setAttribute('canali',$canali);
            $media_voto = 0;
            if(count($user->recensioni) > 0){
                $tot_voto = 0;
                foreach($user->recensioni as $recensione){
                    $tot_voto += $recensione->voto;
                }
                $media_voto = $tot_voto/count($user->recensioni);
                $recensioni = Recensioni::where('influencer_id',$user->id)
                                ->with('users_to.dettagli')
                        ->get();
                 $user->setAttribute('recensioni_to',$recensioni);
            }
            $user->setAttribute('media_voto',$media_voto);
            return view('frontend.influencer.dettaglio')->with('user',$user);
       } else {
           abort(404);
       }
      
    }
}
