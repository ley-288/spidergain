<?php

namespace App\Http\Controllers\Frontend\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Frontend\User\BrandRequest;
use App\Models\App\Brand;
use App\Models\Auth\User;
use Illuminate\Support\Facades\Config;

class BrandController extends Controller {

    public function edit() {
       
        $profilo = new Brand;
        $user = Auth::user();
       
        if ($profilo::where('id_utente', $user->id)->first()) {
            session()->flash('warning', 'Profilo già creato');
            return redirect(route('frontend.user.dashboard'));
        }
       
        return view('frontend.user.completa-profilo-brand');
    }
    
    public function store(BrandRequest $request){
        $user = Auth::user();
        $profilo = new Brand;
        $utente = User::where('id', Auth::user()->id)->first();
        if ($profilo::where('id_utente', $user->id)->first()) {
            session()->flash('warning', 'Profilo già creato');
            return redirect(route('frontend.user.dashboard'));
        }
        
        $request->request->add(['id_utente' => $user->id]);
        
        $dati = $request->all();
        
        $dati['descrizione'] = clean($dati['descrizione']);
        
        $profilo = Brand::create($dati);
        
        //complete user
        $utente->complete = 1;
        $utente->save();
        return redirect(route('frontend.user.dashboard', ['res' => 'ok']))->with('flash_success', __('applicazione.profilo_completo'));
    }
    
    public function modifica() {
        $profilo = new Brand;
        $profilo = Brand::where('id_utente', Auth::user()->id)->first();
    
        return view('frontend.user.completa-profilo-brand')->with('profilo', $profilo);
    }
    
    public function update(BrandRequest $request) {
        
       
        $profilo = new Brand;
        $profilo = Brand::where('id_utente', Auth::user()->id)->first();

       
        $utente = User::where('id', Auth::user()->id);
        
        $dati = $request->all();
        $dati['descrizione'] = clean($dati['descrizione'] );
        
        $profilo->update($dati);

        session()->flash('flash_success', __('applicazione.profilo_aggiornato'));
        return redirect()->back();
    }
    
    public function getBrand($uuid) {
          $user = User::role('brand')
                ->where('uuid',$uuid)
                ->where('active', 1)
                ->with('dettagli')
                ->firstOrFail();
          if(!isset($user->dettagli)){
              abort(404);
          }
          return view('frontend.user.dettaglio-brand')->with('user',$user);
    }

}
