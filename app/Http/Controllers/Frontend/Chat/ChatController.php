<?php

namespace App\Http\Controllers\Frontend\Chat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\App\Messaggio;
use Illuminate\Support\Facades\Validator;
use App\Models\App\Campagna;
use App\Models\Auth\User;
use Response;
use Illuminate\Support\Facades\Auth;
use App\Models\App\Richiesta;
use App\Events\MessageSent;


class ChatController extends Controller {

    public function sendMessage(Request $request) {
        $validator = Validator::make($request->all(),[
            'messaggio' => 'required|max:500',
            'cmp' => 'required|UUID|exists:campagne,uuid',
            'i_id' => 'required|UUID|exists:users,uuid'
        ]);
         if ($validator->fails()) {

            return Response::json(array(
                        'success' => false,
                        'errors' => $validator->getMessageBag()->toArray()
                            ), 400);
        }
        $user = Auth::user();
        $campagna = Campagna::where('uuid', $request->cmp)->first();
        $influencer = User::where('uuid', $request->i_id)->first();
        $messaggio = new Messaggio;
        $richieste = Richiesta::where('campagna_id', $campagna->id)->select('influencer_id')->get();


        if ($user->id != $campagna->user_id && !$richieste->contains('influencer_id', $user->id)) {
            return Response::json(array(
                        'success' => false,
                        'errors' => $validator->getMessageBag()->toArray()
                            ), 400);
        }

        if (!$richieste->contains('influencer_id', $influencer->id)) {
            return Response::json(array(
                        'success' => false,
                        'errors' => $validator->getMessageBag()->toArray()
                            ), 400);
        }

        $messaggio->messaggio = $request->messaggio;
        $messaggio->campagna_id = $campagna->id;
        $messaggio->autore_id = $user->id;
        $messaggio->chat = 1;
        $messaggio->chat_influencer_id = $influencer->id;
        $messaggio->save();
       
        $nuovo_messaggio = Messaggio::where('id',$messaggio->id)->with('users')->first();
        $html  = view('frontend.chat.messaggio')->with('messaggio',$nuovo_messaggio)->with('campagna', $campagna)->render();
        return $html;
    }

    public function getMessages(Request $request) {
        
        
        
        //aggiungere check autore e influencer
        $validator = Validator::make($request->all(),[
            'influencer' => 'required|UUID|exists:users,uuid',
            'cmp' => 'required|UUID|exists:campagne,uuid',
        ]);
        if ($validator->fails()) {

            return Response::json(array(
                        'success' => false,
                        'errors' => $validator->getMessageBag()->toArray()
                            ), 400);
        }
        $influencer = User::where('uuid',$request->influencer)->first();
        $campagna = Campagna::where('uuid', $request->cmp)->first();
        $richieste = Richiesta::where('campagna_id', $campagna->id)->select('influencer_id')->get();
        $utente = Auth::user();
        if ($utente->id != $campagna->user_id && !$richieste->contains('influencer_id', $utente->id)) {
            return Response::json(array(
                        'success' => false,
                        'errors' => $validator->getMessageBag()->toArray()
                            ), 400);
        }

        if (!$richieste->contains('influencer_id', $influencer->id)) {
            return Response::json(array(
                        'success' => false,
                        'errors' => $validator->getMessageBag()->toArray()
                            ), 400);
        }
        
        
       
        $messaggi = Messaggio::where('chat',1)->where('chat_influencer_id', $influencer->id)->where('campagna_id',$campagna->id)->with('users')->orderBy('id','DESC')->paginate(10);
        
        $html  = view('frontend.chat.messaggi')->with('messaggi',$messaggi)->with('campagna',$campagna)->render();
        return $html;
        
    }

    public function getLastMessage(Request $request) {
        
        $validator = Validator::make($request->all(),[
            'influencer' => 'required|UUID|exists:users,uuid',
            'cmp' => 'required|UUID|exists:campagne,uuid',
            'last' => 'required|integer|exists:messaggi,id'
        ]);
        if ($validator->fails()) {

            return Response::json(array(
                        'success' => false,
                        'errors' => $validator->getMessageBag()->toArray()
                            ), 400);
        }
        
        $influencer = User::where('uuid',$request->influencer)->first();
        $campagna = Campagna::where('uuid', $request->cmp)->first();
        $richieste = Richiesta::where('campagna_id', $campagna->id)->select('influencer_id')->get();
        $utente = Auth::user();
        
        if ($utente->id != $campagna->user_id && !$richieste->contains('influencer_id', $utente->id)) {
            return Response::json(array(
                        'success' => false,
                        'errors' => $validator->getMessageBag()->toArray()
                            ), 400);
        }

        if (!$richieste->contains('influencer_id', $influencer->id)) {
            return Response::json(array(
                        'success' => false,
                        'errors' => $validator->getMessageBag()->toArray()
                            ), 400);
        }
        $messaggi = Messaggio::where('chat',1)->where('id','>',$request->last)->where('chat_influencer_id', $influencer->id)->where('campagna_id',$campagna->id)->with('users')->orderBy('id','DESC')->paginate(10);
        
        $html  = view('frontend.chat.messaggi')->with('messaggi',$messaggi)->with('campagna',$campagna)->render();
        return $html;
        
    }

}
