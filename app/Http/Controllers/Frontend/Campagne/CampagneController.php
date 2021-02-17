<?php

namespace App\Http\Controllers\Frontend\Campagne;

use App\Models\App\Campagna;
use App\Http\Requests\Frontend\Campagna\StoreCampagna;
use App\Http\Controllers\Controller;
use App\Models\App\Categorie;
use Auth;
use App\Models\Auth\User;
use Illuminate\Support\Facades\DB;
use App\Models\App\Richiesta;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Request;
use Response;
use App\Mail\RichiestaInviata;
use App\Mail\OffertaInviata;
use App\Mail\OffertaAccettata;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request as HttpRequest;
use App\Models\App\Messaggio;
use App\Models\App\Allegati;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Frontend\Crediti\CreditiController;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Config;
use App\Models\App\Visite;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;


class CampagneController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($stato) {

        $campagne = new Campagna;
        $campagne = $campagne->campagne($stato)->paginate(8);

        foreach ($campagne as $key => $item) {
            $item->setAttribute('canali_view', $this->canali(json_decode($item->canali, true)));
            $item->setAttribute('categorie', $this->getCategorie($item->id));
        }


        return view('frontend.campagne.campagne_campagne_aperte')->with('campagne', $campagne);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Campagna $campagna) {
        $categorie = Categorie::all();
        return view('frontend.campagne.edit')->with('categorie', $categorie);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCampagna $request) {


        $user = Auth::user();
        $request->request->add(['user_id' => $user->id]);

        $data_inizio = \DateTime::createFromFormat('d/m/Y', $request->data_inizio);
        $data_fine = \DateTime::createFromFormat('d/m/Y', $request->data_fine);

        $request->merge(['canali' => json_encode($request->canali), 'data_inizio' => $data_inizio, 'data_fine' => $data_fine]);

        $dati = $request->all();
        $dati['descrizione'] = clean($dati['descrizione']);

        $campagna = new Campagna($request->all());

        $campagna->user_id = $user->id;
        $allegati = [];
        $allegati['immagine_0'] = $request->immagine_0;
        $allegati['immagine_1'] = $request->immagine_1;
        $allegati['immagine_2'] = $request->immagine_2;
        $allegati = json_encode($allegati);
        
        $campagna->allegati = $allegati;

        $campagna->save();
        $campagna->comuni()->attach($request->comuni);
        $campagna->categorie()->attach($request->categorie);

        $uuid = $campagna->uuid;
        
        $allegati = [];
        $allegati['immagine_0'] = $request->immagine_0;
        $allegati['immagine_1'] = $request->immagine_1;
        $allegati['immagine_2'] = $request->immagine_2;
        $allegati = json_encode($allegati);

        if ($request->h_allegato_1) {
            $nuovo_file = Allegati::where('id', $request->h_allegato_1)->first();


            if (Auth::user()->id !== $nuovo_file->autore_id) {
                abort(403, 'Unauthorized action.');
            }
            $nuovo_file->campagna_id = $campagna->id;
            $nuovo_file->save();
        }
        if ($request->h_allegato_2) {
            $nuovo_file = Allegati::where('id', $request->h_allegato_2)->first();
            if (Auth::user()->id !== $nuovo_file->autore_id) {
                abort(403, 'Unauthorized action.');
            }
            $nuovo_file->campagna_id = $campagna->id;
            $nuovo_file->save();
        }
        if ($request->h_allegato_3) {
            $nuovo_file = Allegati::where('id', $request->h_allegato_3)->first();
            if (Auth::user()->id !== $nuovo_file->autore_id) {
                abort(403, 'Unauthorized action.');
            }
            $nuovo_file->campagna_id = $campagna->id;
            $nuovo_file->save();
        }

        if ($request->file1) {
            $filename = $uuid . 'file_1.' . $request->file('file1')->extension();
            $request->file1->storeAs('allegati', $filename);
            $nuovo_file = new Allegati;
            $nuovo_file->autore_id = $user->id;
            $nuovo_file->campagna_id = $campagna->id;
            $nuovo_file->filename = $filename;
            $nuovo_file->ext = $request->file('file1')->extension();
            $nuovo_file->posizione = 1;
            $nuovo_file->save();
        }
        if ($request->file2) {
            $filename = $uuid . 'file_2.' . $request->file('file2')->extension();
            $request->file1->storeAs('allegati', $filename);
            $nuovo_file = new Allegati;
            $nuovo_file->autore_id = $user->id;
            $nuovo_file->campagna_id = $campagna->id;
            $nuovo_file->filename = $filename;
            $nuovo_file->ext = $request->file('file2')->extension();
            $nuovo_file->posizione = 2;
            $nuovo_file->save();
        }
        if ($request->file3) {
            $filename = $uuid . 'file_3.' . $request->file('file3')->extension();
            $request->file1->storeAs('allegati', $filename);
            $nuovo_file = new Allegati;
            $nuovo_file->autore_id = $user->id;
            $nuovo_file->campagna_id = $campagna->id;
            $nuovo_file->filename = $filename;
            $nuovo_file->ext = $request->file('file3')->extension();
            $nuovo_file->posizione = 3;
            $nuovo_file->save();
        }


        return redirect(route('frontend.user.campagne.influencer', ['uuid' => $uuid]));
    }

    /**
     * Display the specified resource.
     *
     * @param  $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($uuid) {


        $user = Auth::user();

        $campagna = Campagna::where('uuid', $uuid)->with('users.dettagli')->with('comuni')->firstOrFail();
        if (Auth::user()->hasRole('brand')) {
            if (Auth::user()->id != $campagna->user_id) {
                abort(403, 'Unauthorized action.');
            }
        } else {
           // Salva visita
            
            $visita = Visite::firstOrNew([
                'user_id' => Auth::user()->id,
                'campagne_id' => $campagna->id,
                'created_at_campagna' => $campagna->created_at,
            ]);
            $visita->save();
        }



        $richieste = Richiesta::where('campagna_id', $campagna->id)->select('influencer_id')->get();

//        if ($user->id != $campagna->user_id && !$richieste->contains('influencer_id', $user->id)) {
//            abort(403, 'Unauthorized action.');
//        }
        //visualizza canali

        $canali = $this->canali(json_decode($campagna->canali, true));

        $days_tot = round((strtotime($campagna->data_fine) - strtotime($campagna->data_inizio)) / (60 * 60 * 24));

        $days_since_start = round((time() - strtotime($campagna->data_inizio)) / (60 * 60 * 24));

        $days_perc = ($days_since_start / $days_tot) * 100;
        $days_perc = ($days_perc > 100) ? 100 : $days_perc;
        $days_perc = ($days_perc < 0) ? 0 : $days_perc;
        $messaggi = Messaggio::where('campagna_id', $campagna->id)
                ->where('chat', 0)
                ->with('users.dettagli')
                ->get();
        $offerte_ricevute = Richiesta::where('accettata', 1)
                        ->where('campagna_id', $campagna->id)
                        ->whereNull('offerta_accettata')
                        ->whereNull('offerta_rifiutata')
                        ->with('users.dettagli')->get();
        $influencer_attivi = User::
                whereHas('richieste', function($q) use($campagna) {
                    $q->where('offerta_accettata', 1)
                    ->where('campagna_id', $campagna->id);
                })->with(['chat' => function($q) use ($campagna) {
                        $q->where('campagna_id', $campagna->id)
                        ->where('chat', 1);
                    }])
                ->with(['richieste' => function($q) use($campagna) {
                        $q->where('offerta_accettata', 1)
                        ->where('campagna_id', $campagna->id);
                    }])
                ->with(['recensioni' => function($q) use ($campagna) {
                        $q->where('campagna_id', $campagna->id);
                    }])->where('active',1)
                ->with('dettagli')
                ->get();
        $letto = true;
        
        foreach ($influencer_attivi as $key=>$item) {
           $letto = true;
            foreach ($item->chat as $chat) {
                
                if ($chat->autore_id != Auth::user()->id && $chat->letto == 0) {
                    $letto = false;
                    break;
                }
            }
           $item->letto = $letto;
        }
        

        $allegati = Allegati::where('campagna_id', $campagna->id)->get();
        $view = view('frontend.campagne.campagna_dettaglio')
                ->with('campagna', $campagna)
                ->with('canali_view', $canali)
                ->with('days_perc', $days_perc)
                ->with('messaggi', $messaggi)
                ->with('offerte_ricevute', $offerte_ricevute)
                ->with('influencer_attivi', $influencer_attivi)
                ->with('allegati', $allegati);
        if (Auth::user()->hasRole('brand')) {
            return $view;
        } else {
            $richiesta = Richiesta::where('campagna_id', $campagna->id)->where('influencer_id', $user->id)->first();
            $chat = Messaggio::where('campagna_id', $campagna->id)
                    ->where('chat', 1)
                    ->where('chat_influencer_id', Auth::user()->id)
                    ->with('users.dettagli')
                    ->get();
            $letto = true;
            foreach ($chat as $item) {
                if ($item->autore_id !== Auth::user()->id && $item->letto == 0) {
                    $letto = false;
                    break;
                }
            }

            return $view->with('richiesta', $richiesta)->with('chat', $chat)->with('letto', $letto);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Campagna  $campagna
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid) {
        $campagna = Campagna::where('uuid', $uuid)->firstOrFail();
        $categorie = Categorie::all();
        $allegati = Allegati::where('campagna_id', $campagna->id)->get();
        $allegati_v = ($campagna->allegati != '') ? json_decode($campagna->allegati,true) : '';
        return view('frontend.campagne.edit')->with('campagna', $campagna)->with('categorie', $categorie)->with('allegati', $allegati)->with('comuni')->with('allegati_v', $allegati_v);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Campagna  $campagna
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCampagna $request, $uuid) {
        $user = Auth::user();
        $data_inizio = \DateTime::createFromFormat('d/m/Y', $request->data_inizio);
        $data_fine = \DateTime::createFromFormat('d/m/Y', $request->data_fine);

        $campagna = Campagna::where('uuid', $uuid)->where('user_id', $user->id)->firstOrFail();
        $request->request->add(['user_id' => $user->id]);
        $request->merge([
            'canali' => json_encode($request->canali),
            'data_inizio' => $data_inizio,
            'data_fine' => $data_fine
        ]);
        $campagna->categorie()->sync($request->categorie);
        $campagna->comuni()->sync($request->comuni);
        if ($request->h_allegato_1) {
            $nuovo_file = Allegati::where('id', $request->h_allegato_1);
            if (Auth::user()->id !== $nuovo_file->first()->autore_id) {
                abort(403, 'Unauthorized action.');
            }
            $nuovo_file->update(['campagna_id' => $campagna->id]);
        }
        if ($request->h_allegato_2) {
            $nuovo_file = Allegati::where('id', $request->h_allegato_2);
            if (Auth::user()->id !== $nuovo_file->first()->autore_id) {
                abort(403, 'Unauthorized action.');
            }
            $nuovo_file->update(['campagna_id' => $campagna->id]);
        }
        if ($request->h_allegato_3) {
            $nuovo_file = Allegati::where('id', $request->h_allegato_3);
            if (Auth::user()->id !== $nuovo_file->first()->autore_id) {
                abort(403, 'Unauthorized action.');
            }
            $nuovo_file->update(['campagna_id' => $campagna->id]);
        }



        if ($request->file1) {

            $file_1_old = Allegati::where('posizione', 1)->where('campagna_id', $campagna->id)->first();
            if ($file_1_old) {
                Storage::delete('allegati/' . $file_1_old->filename);
                $filename = $campagna->uuid . 'file_1.' . $request->file('file1')->extension();
                $request->file1->storeAs('allegati', $filename);
                //$file_1_old->delete();
                $nuovo_file = $file_1_old;
                $nuovo_file->autore_id = $user->id;
                $nuovo_file->campagna_id = $campagna->id;
                $nuovo_file->filename = $filename;
                $nuovo_file->ext = $request->file('file1')->extension();
                $nuovo_file->posizione = 1;
                $nuovo_file->update();
            } else {
                $filename = $campagna->uuid . 'file_1.' . $request->file('file1')->extension();
                $request->file1->storeAs('allegati', $filename);
                $nuovo_file = new Allegati;
                $nuovo_file->autore_id = $user->id;
                $nuovo_file->campagna_id = $campagna->id;
                $nuovo_file->filename = $filename;
                $nuovo_file->ext = $request->file('file1')->extension();
                $nuovo_file->posizione = 1;
                $nuovo_file->save();
            }
        } else {
            if ($request->inputfile1) {
                $file_1_old = Allegati::where('posizione', 1)->where('campagna_id', $campagna->id)->first();
                if ($file_1_old) {
                    Storage::delete('allegati/' . $file_1_old->filename);
                    $file_1_old->delete();
                }
            }
        }
        if ($request->file2) {

            $file_2_old = Allegati::where('posizione', 2)->where('campagna_id', $campagna->id)->first();
            if ($file_2_old) {
                Storage::delete('allegati/' . $file_2_old->filename);
                $filename = $campagna->uuid . 'file_2.' . $request->file('file2')->extension();
                $request->file2->storeAs('allegati', $filename);
                //$file_1_old->delete();
                $nuovo_file = $file_2_old;
                $nuovo_file->autore_id = $user->id;
                $nuovo_file->campagna_id = $campagna->id;
                $nuovo_file->filename = $filename;
                $nuovo_file->ext = $request->file('file2')->extension();
                $nuovo_file->posizione = 2;
                $nuovo_file->update();
            } else {
                $filename = $campagna->uuid . 'file_2.' . $request->file('file2')->extension();
                $request->file2->storeAs('allegati', $filename);
                $nuovo_file = new Allegati;
                $nuovo_file->autore_id = $user->id;
                $nuovo_file->campagna_id = $campagna->id;
                $nuovo_file->filename = $filename;
                $nuovo_file->ext = $request->file('file2')->extension();
                $nuovo_file->posizione = 2;
                $nuovo_file->save();
            }
        } else {
            if ($request->inputfile2) {
                $file_2_old = Allegati::where('posizione', 2)->where('campagna_id', $campagna->id)->first();
                if ($file_2_old) {
                    Storage::delete('allegati/' . $file_2_old->filename);
                    $file_2_old->delete();
                }
            }
        }
        if ($request->file3) {

            $file_3_old = Allegati::where('posizione', 3)->where('campagna_id', $campagna->id)->first();
            if ($file_3_old) {
                Storage::delete('allegati/' . $file_3_old->filename);
                $filename = $campagna->uuid . 'file_3.' . $request->file('file3')->extension();
                $request->file3->storeAs('allegati', $filename);
                //$file_1_old->delete();
                $nuovo_file = $file_3_old;
                $nuovo_file->autore_id = $user->id;
                $nuovo_file->campagna_id = $campagna->id;
                $nuovo_file->filename = $filename;
                $nuovo_file->ext = $request->file('file3')->extension();
                $nuovo_file->posizione = 3;
                $nuovo_file->update();
            } else {
                $filename = $campagna->uuid . 'file_3.' . $request->file('file3')->extension();
                $request->file3->storeAs('allegati', $filename);
                $nuovo_file = new Allegati;
                $nuovo_file->autore_id = $user->id;
                $nuovo_file->campagna_id = $campagna->id;
                $nuovo_file->filename = $filename;
                $nuovo_file->ext = $request->file('file3')->extension();
                $nuovo_file->posizione = 3;
                $nuovo_file->save();
            }
        } else {
            if ($request->inputfile3) {
                $file_3_old = Allegati::where('posizione', 3)->where('campagna_id', $campagna->id)->first();
                if ($file_3_old) {
                    Storage::delete('allegati/' . $file_3_old->filename);
                    $file_3_old->delete();
                }
            }
        }
        $allegati = [];
        $allegati['immagine_0'] = $request->immagine_0;
        $allegati['immagine_1'] = $request->immagine_1;
        $allegati['immagine_2'] = $request->immagine_2;
        $allegati = json_encode($allegati);
        $request->merge(['allegati'=>$allegati]);
        $dati = $request->all();
        $dati['descrizione'] = clean($dati['descrizione']);
        $campagna->update($request->all());
        return redirect(route('frontend.user.campagne.influencer', ['uuid' => $uuid]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Campagna  $campagna
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid) {
        $user = Auth::user();
        $campagna = Campagna::where('uuid', $uuid)->where('user_id', $user->id)->firstOrFail();
        $campagna->comuni()->detach();
        $campagna->categorie()->detach();
        $allegati = Allegati::where('campagna_id', $campagna->id);
        if (count($allegati->get()) > 0) {
            foreach ($allegati->get() as $allegato) {
                Storage::delete('allegati/' . $allegato->filename);
            }
            $allegati->delete();
        }
        $campagna->delete();
        return redirect(route('frontend.user.dashboard'))->with('flash_success', __('applicazione.campagna_cancellata'));
    }

    public function disattiva($uuid) {
        $user = Auth::user();

        $campagna = Campagna::where('uuid', $uuid)->where('user_id', $user->id)->firstOrFail();
        if (isset($_GET['attiva'])) {
            $campagna->active = 1;
            $message = __('applicazione.campagna_attivata_successo');
        } else {
            $campagna->active = 0;
            $message = __('applicazione.campagna_disattivata_successo');
        }

        $campagna->update();
        return redirect()->back()->with('flash_success', $message);
    }

    public function influencer($uuid) {
        config()->set('database.connections.mysql.strict', false);
        \DB::reconnect();
        $user = Auth::user();
        $campagna = Campagna::with('categorie')->where('user_id', $user->id)->where('uuid', $uuid)->first();
        if (!$campagna) {
            abort(403, 'Unauthorized action.');
        }
        $categorie = $campagna->categorie->pluck('id');
        $comuni = $campagna->comuni->pluck('id');
        
        
        $users = User::role('influencer')
                ->join('campi_aggiuntivi as ca', 'ca.id_utente', '=', 'users.id')
                ->join('categorie_utenti as cu', 'cu.dettagli_id', '=', 'ca.id')
                ->whereIn('cu.categorie_id', $categorie)
                ->where('active',1);
        if(count($comuni) > 0){
            
            $users->join('comuni_utenti as co' ,'co.dettagli_id', '=', 'ca.id')
                    ->whereIn('co.comuni_id',$comuni);
        }
        
        $users = $users->where(function ($query) use ($campagna) {
            foreach (json_decode($campagna->canali, true) as $canale) {
                $query->orWhereNotNull('ca.' . $canale);
            }
        });


        $users->selectRaw('users.id as iduser,users.*,ca.*,'
                . '(select avg(`voto`) as voto from recensioni as re where re.influencer_id = users.id ) as recensione, '
                . '(select count(`id`) from recensioni as re where re.influencer_id = users.id ) as numero_recensioni,'
                . '(select count(`id`) from richieste where influencer_id = users.id and offerta_accettata = 1) as numero_campagne,'
                . 'exists (select * from richieste r where users.id = r.influencer_id and r.campagna_id = ?)  as `invitato`'
                . ', ((select avg(`voto`) as voto from recensioni as re where re.influencer_id = users.id ) + (select count(`id`) from richieste where influencer_id = users.id and offerta_accettata = 1)) as pop', [$campagna->id]);
        $request = new HttpRequest;
        if (isset($_GET['ord'])) {
            $order = $_GET['ord'];
        }
        if (isset($order)) {
            switch ($order) {
                case('recensioni'):
                    $users->orderBy('numero_recensioni', 'DESC');
                    break;
                case('campagne'):
                    $users->orderBy('numero_campagne', 'DESC');
                    break;
                case('popolarita'):
                    $users->orderBy('pop', 'DESC');
                    break;
                default:
            }
        }
        $users->groupBy('users.id');
        $users = $users->paginate(10);
        config()->set('database.connections.mysql.strict', true);
        \DB::reconnect();
        return view('frontend.campagne.ricerca')->with('users', $users)->with('campagna', $campagna);
    }

    public function add_richiesta(Request $request, Richiesta $richiesta) {

        $rules = array('cmp' => 'required|UUID|exists:campagne,uuid', 'i_id' => 'required|UUID|exists:users,uuid');
        $validator = Validator::make($request::all(), $rules);
        $user = auth()->user();
        $azienda = DB::table('campi_aggiuntivi')->where('id_utente',$user->id)->value('ragione_sociale');
        

        if ($validator->fails()) {
            return Response::json(array(
                        'success' => false,
                        'errors' => $validator->getMessageBag()->toArray()
                            ), 400);
        }
        $influencer_id = DB::table('users')->where('uuid', $request::input('i_id'))->value('id');
        $influencer_email = DB::table('users')->where('uuid', $request::input('i_id'))->value('email');
        $campagna_id = DB::table('campagne')->where('uuid', $request::input('cmp'))->value('id');

        $data = [
            "brand_id" => $user->id,
            "campagna_id" => $campagna_id,
            "influencer_id" => $influencer_id,
            "accettata" => 2
        ];
        //se l'utente non è mai stato invitato inseriscilo altrimenti no
        $richiesta = $richiesta::firstOrCreate(["campagna_id" => $campagna_id, "influencer_id" => $influencer_id], $data);
        $richiesta->accettata = 2;
        $richiesta->campagna_id = $campagna_id;
        $richiesta->save();


        //Avvisa l'utente è stato creato
        if ($richiesta->wasRecentlyCreated) {
            
            Mail::to($influencer_email)->send(new RichiestaInviata($user->first_name,$user->last_name,$azienda));

            return Response::json(array('success' => true), 200);
        } else {
            return Response::json(array(
                        'success' => false,
                        'errors' => 'user_already_invited'
                            ), 400);
        }
    }

    public function richieste() {

        $user = Auth::user();
        $campagne = Richiesta::where('influencer_id', $user->id)
                ->where('accettata', 2)
                ->where('ca.data_fine', '>', date('Y-m-d'))
                ->where('u.active',1)
//                ->whereHas('campagne', function($q) {
//                    $q->where('data_fine', '>', date('Y-m-d'));
//                })
                //->with('users')
                ->join('campagne as ca', 'ca.id', '=', 'richieste.campagna_id')
                ->join('users as u', 'u.id', '=', 'ca.user_id')
                ->select('ca.uuid', 'u.uuid as user_uuid', 'first_name', 'last_name', 'descrizione', 'titolo', 'ca.id', 'budget','budget_periodo','data_fine', 'avatar_location', 'data_inizio', 'canali')
                ->paginate(10);

        foreach ($campagne as $key => $item) {
            $item->setAttribute('canali_view', $this->canali(json_decode($item->canali, true)));
            $item->setAttribute('categorie', $this->getCategorie($item->id));
        }
        return view('frontend.campagne.campagne_richiesteaperte')->with('campagne', $campagne);
        //return view('frontend.campagne.campagne_campagne_aperte')->with('campagne', $campagne);
    }

    /**
     * Crea un array completo di icone per i canali in base al json salvato nella campagna
     *
     * @param  Campagna
     * @return array
     */
    public function canali($canali) {

        $canale_array = [];
        foreach ($canali as $key => $canale) {
            switch ($canale) {
                case 'mailing_list':
                    $icon = 'fa fa-envelope-open-text';
                    $name = 'Mailing List';
                    break;
                case 'blog':
                    $icon = 'fas fa-laptop';
                    $name = 'Blog/Web';
                    break;
                case 'giornale_tiratura':
                    $icon = 'fa fa-newspaper';
                    $name = __('applicazione.giornale');
                    break;
                case 'negozio_metri':
                    $icon = 'fa fa-store';
                    $name = __('applicazione.negozio_metri');
                    break;
                case 'eventi_numero':
                    $icon = 'fa fa-users';
                    $name = __('applicazione.eventi');
                    break;
                default:
                    $icon = 'fab fa-' . $canale;
                    $name = $canale;
            }
            $canale_array[$key]['icon'] = $icon;
            $canale_array[$key]['name'] = $name;
        }

        return $canale_array;
    }

    public function add_offerta(HttpRequest $request) {

        $request->validate([
            'offerta' => 'required|max:1000',
            'cmp' => 'required|UUID|exists:campagne,uuid',
            'importo' => 'required|max:100000|integer'
        ]);
        $user = Auth::user();
        $campagna = Campagna::where('uuid', $request->cmp)->first();
        $utente_email = User::where('id', $campagna->user_id)->first();

        $richiesta = Richiesta::where('influencer_id', $user->id)->where('campagna_id', $campagna->id)->first();


        if ($richiesta === null) {
//         //tutti possono inviare offerta tolgo il check
//            abort(403, 'Unauthorized action.');
            $richiesta = new Richiesta;
            $richiesta->campagna_id = $campagna->id;
            $richiesta->brand_id = $campagna->user_id;
            $richiesta->influencer_id = $user->id;
        }
        //  $richiesta->first();

        $richiesta->offerta = clean($request->offerta);
        $richiesta->importo = $request->importo;
        $richiesta->accettata = 1;
        $richiesta->accettata_at = date("Y-m-d H:i:s");
        $richiesta->offerta_creata_at = date("Y-m-d H:i:s");
        $richiesta->save();
        Mail::to($utente_email->email)->send(new OffertaInviata($user->first_name, $user->last_name, $campagna->titolo));
        return redirect()->back()->with('flash_success', __('applicazione.offerta_inviata'));
    }

    public function add_messaggio(HttpRequest $request) {

        $request->validate([
            'messaggio' => 'required|max:500',
            'cmp' => 'required|UUID|exists:campagne,uuid',
        ]);
        $user = Auth::user();
        $campagna = Campagna::where('uuid', $request->cmp)->first();
        $messaggio = new Messaggio;
        $richieste = Richiesta::where('campagna_id', $campagna->id)->select('influencer_id')->get();


        if ($user->id != $campagna->user_id && !$richieste->contains('influencer_id', $user->id)) {
            abort(403, 'Unauthorized action.');
        }

        $messaggio->messaggio = $request->messaggio;
        $messaggio->campagna_id = $campagna->id;
        $messaggio->autore_id = $user->id;
        $messaggio->save();
        //return redirect()->back()->with('flash_success', __('applicazione.messaggio_inserito'));
        return Redirect::to(URL::previous() . "#bacheca")->with('flash_success', __('applicazione.messaggio_inserito'));
    }

    public function add_chat(HttpRequest $request) {

        $request->validate([
            'messaggio' => 'required|max:500',
            'cmp' => 'required|UUID|exists:campagne,uuid',
            'i_id' => 'required|UUID|exists:users,uuid'
        ]);
        $user = Auth::user();
        $campagna = Campagna::where('uuid', $request->cmp)->first();
        $influencer = User::where('uuid', $request->i_id)->first();
        $messaggio = new Messaggio;
        $richieste = Richiesta::where('campagna_id', $campagna->id)->select('influencer_id')->get();


        if ($user->id != $campagna->user_id && !$richieste->contains('influencer_id', $user->id)) {
            abort(403, 'Unauthorized action.');
        }

        if (!$richieste->contains('influencer_id', $influencer->id)) {
            abort(403, 'Unauthorized action.');
        }

        $messaggio->messaggio = $request->messaggio;
        $messaggio->campagna_id = $campagna->id;
        $messaggio->autore_id = $user->id;
        $messaggio->chat = 1;
        $messaggio->chat_influencer_id = $influencer->id;
        $messaggio->save();
        return redirect()->back()->with('flash_success', __('applicazione.messaggio_inserito'));
    }

    public function accetta_offerta(HttpRequest $request) {

        $request->validate([
            'offerta_id' => 'required|integer|exists:richieste,id',
            'cmp' => 'required|UUID|exists:campagne,uuid',
        ]);
        $user = Auth::user();
        $campagna = Campagna::where('uuid', $request->cmp)->first();

        $richiesta = Richiesta::where('campagna_id', $campagna->id)->where('id', $request->offerta_id)->firstOrFail();
        $utente = User::find($richiesta->influencer_id);
        if ($user->id != $campagna->user_id) {
            abort(403, 'Unauthorized action.');
        }
        $budget = new CreditiController;
        $budget = $budget->budget($richiesta->influencer_id);
        if ($budget <= 0) {
            return redirect()->back()->with('flash_error', __('applicazione.no_budget'));
        }
        //  $richiesta->first();
        if (isset($request->rifiuta)) {
            $richiesta->offerta_rifiutata = 1;
            $richiesta->offerta_rifiutata_at = date("Y-m-d H:i:s");
        } else {
            $richiesta->offerta_accettata = 1;
            $richiesta->offerta_accettata_at = date("Y-m-d H:i:s");
        }

        $richiesta->save();

        if (isset($request->rifiuta)) {
            Mail::to($utente->email)->send(new OffertaAccettata(true, $user->first_name, $user->last_name, $campagna->titolo));
            return redirect()->back()->with('flash_success', __('applicazione.richiesta_rifiutata'));
        } else {
            Mail::to($utente->email)->send(new OffertaAccettata(false, $user->first_name, $user->last_name, $campagna->titolo));
            return redirect()->back()->with('flash_success', __('applicazione.richiesta_accettata'));
        }
    }

    public function get_influencer($uuid) {
        $user = User::where('uuid', $uuid);
    }
    
    
     public function add_immagine(HttpRequest $request) {
             
        $validator = Validator::make($request->all(), [
                    'slim_output_0' => 'image|mimes:jpeg,jpg,png|max:5120|dimensions:min_width=450,min_height=450',
                    'slim_output_1' => 'image|mimes:jpeg,jpg,png|max:5120|dimensions:min_width=450,min_height=450',
                    'slim_output_2' => 'image|mimes:jpeg,jpg,png|max:5120|dimensions:min_width=450,min_height=450'
        ]);

        if ($request->hasFile('slim_output_0')) {
            $extension = $request->slim_output_0->getClientOriginalExtension();
            $filename = Auth::user()->uuid . '-' . time() . '.' . $extension;
            $request->slim_output_0->storeAs('allegati', $filename);
            $image = Image::make('storage/allegati/' . $filename);
            $image->crop(450, 450);
            $image->save();
            return Response::json(array('success' => true, 'field' => 0,'file'=>'allegati/' . $filename), 200);
        }
        if ($request->hasFile('slim_output_1')) {
            $extension = $request->slim_output_1->getClientOriginalExtension();
            $filename = Auth::user()->uuid . '-' . time() . '.' . $extension;
            $request->slim_output_1->storeAs('allegati', $filename);
            $image = Image::make('storage/allegati/' . $filename);
            $image->crop(450, 450);
            $image->save();
            return Response::json(array('success' => true, 'field' => 1,'file'=>'allegati/' . $filename), 200);
        }
        if ($request->hasFile('slim_output_2')) {
            $extension = $request->slim_output_2->getClientOriginalExtension();
            $filename = Auth::user()->uuid . '-' . time() . '.' . $extension;
            $request->slim_output_2->storeAs('allegati', $filename);
            $image = Image::make('storage/allegati/' . $filename);
            $image->crop(450, 450);
            $image->save();
            return Response::json(array('success' => true, 'field' => 2,'file'=>'allegati/' . $filename), 200);
        }
     }
     
      public function delete_immagine(HttpRequest $request) {
          
          
          if(strpos( $request->immagine, Auth::user()->uuid)){
                Storage::delete($request->immagine);
          }
      }
    public function add_allegato(HttpRequest $request) {
        $validator = Validator::make($request->all(), [
                    'allegato' => 'required|file|mimes:pdf|max:5120',
                    'posizione' => 'required|integer|in:1,2,3'
        ]);
        //validator ha problemi con dei file tiff
        if ($validator->fails() || strtolower($request->allegato->getClientOriginalExtension() == 'tiff') || strtolower($request->allegato->getClientOriginalExtension() == 'tif')) {

            return Response::json(array(
                        'success' => false,
                        'errors' => $validator->getMessageBag()->toArray()
                            ), 400);
        }

        if ($request->hasFile('allegato')) {
            $extension = $request->allegato->getClientOriginalExtension();
            $filename = Auth::user()->uuid . '-' . time() . '.' . $extension;
            $request->allegato->storeAs('allegati', $filename);

            $thumb_location = 'allegati/' . $filename;

            $allegato = new Allegati;
            $allegato->autore_id = Auth::user()->id;
            $allegato->ext = $extension;
            $allegato->filename = $filename;
            $allegato->posizione = $request->posizione;
            $allegato->save();
            return Response::json(array('success' => true, 'avatar_location' => $thumb_location, 'extension' => $extension, 'id' => $allegato->id), 200);
        } else {
            return Response::json(array(
                        'success' => false,
                        'errors' => 'no file'
                            ), 400);
        }
    }

    public function delete_allegato(HttpRequest $request) {
        $validator = Validator::make($request->all(), [
                    'id' => 'integer'
        ]);
        //validator ha problemi con dei file tiff
        if ($validator->fails()) {
            return Response::json(array(
                        'success' => false,
                        'errors' => $validator->getMessageBag()->toArray()
                            ), 400);
        }
        $allegato = Allegati::where('id', $request->id)->first();
        if ($allegato->autore_id != Auth::user()->id) {
            return Response::json(array(
                        'success' => false,
                        'errors' => $validator->getMessageBag()->toArray()
                            ), 400);
        }
        Storage::delete('allegati/' . $allegato->filename);
        $allegato->delete();
        return Response::json(array('success' => true), 200);
    }

    public function cercacampagne() {
       
        $user = Auth::user();
        $user = User::where('id', $user->id)->with('dettagli')->first();
        $canali = Config::get('social');
        $dettagli = $user->dettagli->getAttributes();
        $categorie = $user->dettagli->categorie->pluck('id')->toArray();
        
        $campagne_viste_ids = Visite::where('user_id',$user->id)->select('campagne_id')->pluck('campagne_id')->toArray();
        
        
        
        $canaliToFilter = [];
        foreach ($canali as $canale) {

            if ($dettagli[$canale] != '' || $dettagli[$canale] !== null) {
                $canaliToFilter[] = $canale;
            }
        }

        $ids = DB::table('campagne')->select('campagne.id')
                        ->join('richieste', 'campagne.id', '=', 'richieste.campagna_id')
                        ->where('richieste.influencer_id', $user->id)
                        ->where('data_fine', '>=', date('Y-m-d'))
                        ->where(function($query) use ($canaliToFilter) {
                            if (!empty($canaliToFilter)) {
                                foreach ($canaliToFilter as $item) {
                                    $query->orWhere('canali', 'like', '%' . $item . '%');
                                };
                            };
                        })->pluck('id');


        config()->set('database.connections.mysql.strict', false);
        \DB::reconnect();
        $campagne = new Campagna;
        $campagne = $campagne->where('campagne.active', 1)
                ->where('data_fine', '>=', date('Y-m-d'))
                ->join('categorie_campagne as cu', 'cu.campagna_id', '=', 'campagne.id')
                
                ->leftJoin('visite_campagne as vi','vi.campagne_id' ,'=','campagne.id')
                
                ->whereIn('cu.categorie_id', $categorie)
                ->whereNotIn('id', $ids)
                ->where(function($query) use ($canaliToFilter) {
            if (!empty($canaliToFilter)) {
                foreach ($canaliToFilter as $item) {
                    $query->orWhere('canali', 'like', '%' . $item . '%');
                };
            }
        });
        $campagne->select('campagne.*','vi.campagne_id','vi.created_at_campagna');
        $campagne = $campagne->groupBy('campagne.id')
                ->orderByRaw('-vi.created_at_campagna ASC')
                ->orderBy('campagne.created_at','DESC');
                
                
        $campagne = $campagne->paginate(8);
       
        foreach ($campagne as $key => $item) {
            
            $item->setAttribute('canali_view', $this->canali(json_decode($item->canali, true)));
            if(in_array($item->id,$campagne_viste_ids)){
                $item->setAttribute('vista',false);
            }
            $item->setAttribute('cerca',true);
        }
       
        config()->set('database.connections.mysql.strict', true);
        \DB::reconnect();
        return view('frontend.campagne.campagne_campagne_aperte')->with('campagne', $campagne);
    }

    public function getCategorie($id) {
        $categorie = DB::table('categorie as ca')
                        ->join('categorie_campagne as cc', 'cc.categorie_id', '=', 'ca.id')
                        ->where('cc.campagna_id', $id)
                        ->select('ca.nome')
                        ->get()->toArray();
        return $categorie;
    }

    public function leggiChat(HttpRequest $request) {
        $validator = Validator::make($request->all(), [
                    'cmp' => 'required|UUID|exists:campagne,uuid',
                    'usr' => 'required|UUID|exists:users,uuid'
        ]);
         if ($validator->fails()) {
            return Response::json(array(
                        'success' => false,
                        'errors' => $validator->getMessageBag()->toArray()
                            ), 400);
        }
        $influencer = User::where('uuid', $request->usr)->first();
        $campagna = Campagna::where('uuid', $request->cmp)->first();
        if (Auth::user()->hasRole('brand')) {
            if ($campagna->user_id != Auth::user()->id) {
                return Response::json(array('error' => true), 400);
            }
        }
        $messaggi = new Messaggio;
        $messaggi = $messaggi->where('campagna_id', $campagna->id);
        $messaggi = $messaggi->where('autore_id', '!=', Auth::user()->id);
        if (Auth::user()->hasRole('brand')) {
            $messaggi = $messaggi->where('chat_influencer_id', $influencer->id);
        } else {
            $messaggi = $messaggi->where('chat_influencer_id', auth::user()->id);
        }
        $messaggi = $messaggi->where('chat', 1);

        $messaggi = $messaggi->update(['letto' => 1]);
        return Response::json(array('success' => true), 200);
    }

}
