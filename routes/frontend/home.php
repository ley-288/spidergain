<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\User\AccountController;
use App\Http\Controllers\Frontend\User\ProfileController;
use App\Http\Controllers\Frontend\User\DashboardController;
use App\Http\Controllers\frontend\User\ProfiloDettagliController;
use App\Http\Controllers\Frontend\Campagne\CampagneController;
use App\Http\Controllers\Frontend\Influencer\InfluencerController;
use App\Http\Controllers\Frontend\Recensioni\RecensioniController;
use App\Http\Controllers\Frontend\Crediti\CreditiController;
use App\Http\Controllers\Frontend\Faq\FaqController;
use App\Http\Controllers\Frontend\User\BrandController;
use App\Http\Controllers\Frontend\Comuni\ComuniController;
use App\Http\Controllers\Frontend\Chat\ChatController;
use App\Http\Controllers\Frontend\CasaController;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/privacy', function(){return view('frontend.privacy');})->name('privacy');
Route::get('/cookie-policy', function(){return view('frontend.cookie');})->name('cookie');
Route::get('/termini-e-condizioni', function(){return view('frontend.termini');})->name('termini');
Route::get('/condividi', function(){return view('frontend.condividi');})->name('condividi');


Route::get('/testltn', function(){return view('frontend.testltn');})->name('testltn');


/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 * These routes can not be hit if the password is expired
 */
Route::group(['middleware' => ['auth'], 'namespace' => 'User', 'as' => 'user.'], function () {
    
    Route::get('comuni', [ComuniController::class, 'getComuni'])->name('comuni');

    Route::group(['middleware' => 'check_profile'], function () {
        // User Dashboard Specific
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // User Account Specific
        Route::get('account', [AccountController::class, 'index'])->name('account');
        
        
        // User Profile Specific
        Route::patch('profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('brand/{uuid}', [BrandController::class, 'getBrand'])->name('brand.get');
        Route::get('influencer/{uuid}', [InfluencerController::class, 'get_influencer'])->name('influencer.get');
        
        Route::group(['middleware' => 'role:brand'], function() {
            Route::get('campagne/crea', [CampagneController::class, 'create'])->name('campagne.crea');
            Route::get('campagne/{uuid}/influencer', [CampagneController::class, 'influencer'])->name('campagne.influencer');
            Route::get('campagne/modifica/{uuid}', [CampagneController::class, 'edit'])->name('campagne.modifica');
            Route::post('campagne/create', [CampagneController::class, 'store'])->name('campagne.store');
            Route::put('campagne/update/{uuid}', [CampagneController::class, 'update'])->name('campagne.update');
            Route::get('campagne/disattiva/{uuid}', [CampagneController::class, 'disattiva'])->name('campagne.disattiva');
            Route::get('campagne/cancella/{uuid}', [CampagneController::class, 'destroy'])->name('campagne.cancella');
            Route::post('richiesta/create', [CampagneController::class, 'add_richiesta'])->name('richiesta.create');
            Route::post('offerta/accetta', [CampagneController::class, 'accetta_offerta'])->name('accetta.offerta');
           
            Route::post('recensione/create', [RecensioniController::class, 'add_recensione'])->name('recensione.create');
            Route::post('allegato', [CampagneController::class, 'add_allegato'])->name('allegato');
            Route::post('allegato/delete', [CampagneController::class, 'delete_allegato'])->name('allegato.delete');
            Route::post('immagine', [CampagneController::class, 'add_immagine'])->name('immagine');
            Route::delete('immagine/delete', [CampagneController::class, 'delete_immagine'])->name('immagine.delete');
            
        });

        Route::group(['middleware' => 'role:influencer'], function() {
            Route::post('offerta/create', [CampagneController::class, 'add_offerta'])->name('offerta.create');
            Route::get('richieste', [CampagneController::class, 'richieste'])->name('campagne.richieste');
            Route::get('crediti', [CreditiController::class, 'crediti'])->name('crediti');
            Route::post('crediti/compra', [CreditiController::class, 'compra'])->name('crediti.compra');
            Route::get('crediti/pagamento', [CreditiController::class, 'getPaymentStatus'])->name('paymentstatus');
            Route::get('cerca-campagne', [CampagneController::class, 'cercacampagne'])->name('cercacampagne');
            
        });
        Route::post('chat/create', [CampagneController::class, 'add_chat'])->name('chat.create');
        Route::post('messaggio/create', [CampagneController::class, 'add_messaggio'])->name('messaggio.create');
        Route::get('campagna/{uuid}', [CampagneController::class, 'show'])->name('campagna.dettaglio');
        Route::get('campagne/aperte', [CampagneController::class, 'index'])->defaults('status', 1)->name('campagne.aperte.index');
        Route::get('campagne/chiuse', [CampagneController::class, 'index'])->defaults('status', 0)->name('campagne.chiuse.index');
        Route::post('avatar', [ProfiloDettagliController::class, 'avatarbrand'])->name('avatar');
        Route::delete('avatar/delete', [ProfiloDettagliController::class, 'avatarbranddelete'])->name('avatar.delete');
        Route::post('utente/delete', [ProfiloDettagliController::class, 'utentedelete'])->name('utente.delete');
        Route::get('faq', [FaqController::class, 'index'])->name('faq');
        Route::get('come-funziona', function(){return view('frontend.faq.tutorial');});
        Route::get('tutorial', function(){return view('frontend.faq.video');});
        Route::post('leggi', [CampagneController::class, 'leggiChat'])->name('leggi');
        Route::post('chat/send',[ChatController::class, 'sendMessage'])->name('chat.send');
        Route::get('chat/get',[ChatController::class, 'getMessages'])->name('chat.get');
        Route::get('chat/last',[ChatController::class, 'getLastMessage'])->name('chat.last');
         
    });


    Route::group(['middleware' => 'role:influencer'], function () {

        // Pagine per completare il profilo
        Route::get('profilo/completa', [ProfiloDettagliController::class, 'create'])->name('profile.completa');
        Route::get('profilo/completa/modifica', [ProfiloDettagliController::class, 'edit'])->name('profile.completa.modifica');
        Route::post('profilo/completa/create', [ProfiloDettagliController::class, 'store'])->name('profile.completa.store');
        Route::put('profilo/completa/update', [ProfiloDettagliController::class, 'update'])->name('profile.completa.update');
    });
    Route::group(['middleware' => 'role:brand'], function () {
       
        Route::get('profilo/brand/modifica', [BrandController::class, 'modifica'])->name('brand.modifica');
        Route::get('profilo/brand', [BrandController::class, 'edit'])->name('brand.edit');
        Route::post('profilo/brand/create', [BrandController::class, 'store'])->name('brand.store');
        Route::put('profilo/brand/update', [BrandController::class, 'update'])->name('brand.update');
        
    });
});
