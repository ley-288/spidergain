<?php

namespace App\Http\Controllers\frontend\User;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\App\Categorie;
use App\models\App\Comuni;
use App\Models\App\Dettagli;
use App\Http\Requests\Frontend\User\CreateDettagliRequest;
use App\Models\Auth\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;
use App\Classes\Slim\Slim;

class ProfiloDettagliController extends Controller {

    public function index() {
        
    }

    public function avatarbrand(Request $request) {
        
       
       

        $validator = Validator::make($request->all(), [
                    'slim_output_0' => 'required|image|mimes:jpeg,jpg,png|max:5120|dimensions:min_width=450,min_height=450'
        ]);
        //validator ha problemi con dei file tiff
        if ($validator->fails() || strtolower($request->slim_output_0->getClientOriginalExtension() == 'tiff') || strtolower($request->slim_output_0->getClientOriginalExtension() == 'tif')) {

            return Response::json(array(
                        'success' => false,
                        'errors' => $validator->getMessageBag()->toArray()
                            ), 400);
        }

        if ($request->hasFile('slim_output_0')) {
            $extension = $request->slim_output_0->getClientOriginalExtension();
            $filename = Auth::user()->uuid . '-' . time() . '.' . $extension;
            $request->slim_output_0->storeAs('avatar', $filename);
            $utente = User::where('id', Auth::user()->id)->first();
            if($utente->avatar_location != ''){
                Storage::delete($utente->avatar_location);
            }
            $utente->avatar_location = 'avatar/' . $filename;
            $utente->save();
            $image = Image::make('storage/' . $utente->avatar_location);
            $image->crop(450, 450);
            $image->save();
            return Response::json(array('success' => true, 'avatar_location' => $utente->avatar_location), 200);
        }
//       
//        $validator = Validator::make($request->all(), [
//             'avatar' => 'nullable|file|mimes:jpeg,jpg,png|max:2000'
//       ]);
//        
//       if ($validator->fails()) {
//           
//            return redirect()->back()->with('flash_warning',__('applicazione.file_non_valido'));
//       }
//        
//        if ($request->hasFile('profile_avatar')) {
//            $extension = $request->profile_avatar->getClientOriginalExtension();
//            $filename = Auth::user()->uuid . '-' . time() . '.' . $extension;
//            $request->profile_avatar->storeAs('avatar', $filename);
//            $utente = User::where('id', Auth::user()->id)->first();
//            $utente->avatar_location = 'avatar/' . $filename;
//            $utente->save();
//        } else {
//
//            if (Auth::user()->avatar_location != '') {
//                if ($request->del_image) {
//                    $utente = User::where('id', Auth::user()->id)->first();
//                    Storage::delete($utente->avatar_location);
//                    $utente->avatar_location = '';
//                    $utente->save();
//                }
//            }
//        }
//        return redirect()->back()->with('flash_success',__('applicazione.avatar_salvato'));
    }

    public function avatarbranddelete(Request $request) {
        
        $utente = User::where('id', Auth::user()->id)->first();
        Storage::delete($utente->avatar_location);
        $utente->avatar_location = '';
        $utente->save();
        return Response::json(array('success' => true), 200);
    }

    public function create() {
        $dettagli = new Dettagli;
        $user = Auth::user();
        if ($dettagli::where('id_utente', $user->id)->first()) {
            session()->flash('warning', 'Profilo già creato');
            return redirect(route('frontend.user.dashboard'));
        }
        $categorie = Categorie::all();
        $nazioni = DB::table('countries')->select('id', 'name')->get();
        return view('frontend.user.completa-profilo', compact('nazioni'))->with('categorie', $categorie);
    }

    public function utentedelete() {
        $user = Auth::user();
//        $user->first_name = __('applicazione.utente_cancellato');
//        $user->last_name = ' ';
//        $user->email = "----";
//        $user->password = 'xxx';
        $user->active = 0;
        $user->complete = 0;
        if ($user->avatar_location != '') {
            Storage::delete($user->avatar_location);
            $user->avatar_location = '';
        }

        if ($user->hasRole('influencer')) {
            $dettagli = Dettagli::where('id_utente', $user->id)->first();
            //$dettagli = DB::table('campi_aggiuntivi')->where('id_utente',$user->id);
            DB::table('categorie_utenti')->where('dettagli_id', $dettagli->id)->delete();
            $dettagli->delete();
        }

        if ($user->hasRole('brand')) {
            \App\Models\App\Campagna::where('user_id', $user->id)->update(['active' => 0]);
        }

        $user->save();
        Auth::logout();
        return \Illuminate\Support\Facades\Redirect::route('frontend.auth.login');
    }

    public function update(CreateDettagliRequest $request) {

        $dettagli = new Dettagli;
        $dettagli = Dettagli::where('id_utente', Auth::user()->id)->first();

        if ($request->hasFile('profile_avatar')) {
            $extension = $request->profile_avatar->getClientOriginalExtension();
            $filename = Auth::user()->uuid . '-' . time() . '.' . $extension;
            $request->profile_avatar->storeAs('avatar', $filename);
            $utente = User::where('id', Auth::user()->id)->first();
            $utente->avatar_location = 'avatar/' . $filename;
            $utente->save();
        } else {

            if (Auth::user()->avatar_location != '') {
                if ($request->del_image) {
                    $utente = User::where('id', Auth::user()->id)->first();
                    Storage::delete($utente->avatar_location);
                    $utente->avatar_location = '';
                    $utente->save();
                }
            }
        }
        $utente = User::where('id', Auth::user()->id);
        $dati = $request->all();
        $dati['descrizione'] = clean($dati['descrizione']);
        $dettagli->update($dati);


        $dettagli->categorie()->sync($request->categorie);
        
        $dettagli->comuni()->sync($request->comuni);
        session()->flash('flash_success', __('applicazione.profilo_aggiornato'));
        return redirect()->back();
    }

    public function store(CreateDettagliRequest $request) {

        $user = Auth::user();
        $dettagli = new Dettagli;
        $utente = User::where('id', Auth::user()->id)->first();
        if ($dettagli::where('id_utente', $user->id)->first()) {
            session()->flash('warning', 'Profilo già creato');
            return redirect(route('frontend.user.dashboard'));
        }
        if ($request->hasFile('profile_avatar')) {
            $extension = $request->profile_avatar->getClientOriginalExtension();
            $filename = Auth::user()->uuid . '-' . time() . '.' . $extension;
            $request->profile_avatar->storeAs('avatar', $filename);
            $utente->avatar_location = 'avatar/' . $filename;
            $utente->save();
        }
        $request->request->add(['id_utente' => $user->id]);
        //$dettagli->id_utente = $request->id_utente;
        $dati = $request->all();
        $dati['descrizione'] = clean($dati['descrizione']);
        $dettagli = Dettagli::create($dati);
        $dettagli->categorie()->attach($request->categorie);
        $dettagli->comuni()->attach($request->comuni);
        //complete user
        $utente->complete = 1;
        $utente->save();
        return redirect(route('frontend.user.dashboard', ['res' => 'ok']))->with('flash_success', __('applicazione.profilo_completo'));
    }

    public function edit() {
        $dettagli = new Dettagli;
        $dettagli = Dettagli::where('id_utente', Auth::user()->id)->with('comuni')->first();
        $categorie = Categorie::all();
        $nazioni = DB::table('countries')->select('id', 'name')->get();
        return view('frontend.user.completa-profilo', compact('nazioni'))->with('categorie', $categorie)->with('dettagli', $dettagli);
    }

}
