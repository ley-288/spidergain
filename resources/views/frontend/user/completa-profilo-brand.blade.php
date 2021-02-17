@extends('frontend.layouts.interna')
@push('after-styles')
<link href="{{url('/')}}/assets/vendors/general/summernote/dist/summernote.css" rel="stylesheet" type="text/css" />
@endpush
@push('after-scripts')
<script src="{{url('/')}}/assets/vendors/general/summernote/dist/summernote.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/vendors/general/summernote/dist/lang/summernote-it-IT.js" type="text/javascript"></script>
<script src="{{url('/')}}/js/editor.js?v=0.6" type="text/javascript"></script>
<script>
$('document').ready(function(){
    $('.url').blur(function(){
        if($(this).val().length > 0){
            setTimeout(validUrl($(this)),3000);
            $(this).valid();
        }
    });
});

function validUrl(el){
    var url = el.val();
    var pattern = /^((http|https|ftp):\/\/)/;

        if(!pattern.test(url)) {
           el.val("https://" + url);
        }
}
$(function(){
  registerSummernote('.summernote', '', 1000, function(max) {
    $('#maxContentPost').text(max);
  });
       
        
});
</script>

@endpush
@section('content')
<div class="kt-holder kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">

    </div>

    <!-- begin:: Content -->
    <div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
@if(Auth::user()->complete == 0)
        <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-elevate alert-light" role="alert">
                        <div ><strong>@lang('applicazione.completa_iscrizione_avviso')</strong></div>
                    </div>
                </div>
            </div>
        @endif
        
  @include('includes.partials.messages')
        <div class="row">
            <div class="col-xl-12">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                @lang('Inserisci i tuoi dati aziendali')
                            </h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form action="{{ isset($profilo) ? route('frontend.user.brand.update') : route('frontend.user.brand.store') }}" method="POST" class="kt-form" id="kt_form" enctype="multipart/form-data">
                        @csrf
                        @if(isset($profilo))
                        @method('PUT')
                        @endif
                        <div class="kt-portlet__body">
                            <div class="kt-section kt-section--first">
                                <div class="form-group">
                                    <label>@lang('Ragione Sociale')*:</label>
                                    <input type="text" maxlength="200" required class="form-control" name="ragione_sociale" value="{{isset($profilo->ragione_sociale) ? $profilo->ragione_sociale : ''}}" placeholder="Ragione Sociale">
                                    <span class="form-text text-muted">@lang('Inserisci ragione sociale - Richiesto')</span>
                                </div>
                                <div class="form-group">
                                    <label>@lang('Partita Iva'):</label>
                                    <input type="text" class="form-control" maxlength="50" name="partita_iva" value="{{isset($profilo->partita_iva) ? $profilo->partita_iva : ''}}" placeholder="@lang('Partita Iva...')">
                                    <span class="form-text text-muted">@lang('Inserisci la tua partita Iva')</span>
                                </div>
                                <div class="form-group">
                                    <label>@lang('Descrizione'):</label>
                                    <textarea class="form-control summernote" maxlength="1500" name="descrizione"  placeholder="@lang('Descrizione...')">{{isset($profilo->descrizione) ? $profilo->descrizione : '' }}</textarea>
                                    <span class="form-text text-muted">@lang('Inserisci un breve testo per descrivere la tua azienda')</span>
                                </div>
                                <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
                                <h3 class="kt-section__title">@lang('Indirizzo aziendale'):</h3>
                                <div class="form-group row">
                                    <div class="col-xl-8">
                                        <label>@lang('Indirizzo')*:</label>
                                        <input type="text" class="form-control" maxlength="200" required name="azienda_via" value="{{isset($profilo->azienda_via) ? $profilo->azienda_via : ''}}" placeholder="@lang('Via, Piazza...')">
                                        <span class="form-text text-muted">@lang('Inserisci l\'indirizzo della tua azienda - Richiesto')</span>
                                    </div>
                                    <div class="col-xl-4">
                                        <label>@lang('Numero Civico')*:</label>
                                        <input type="text" class="form-control" maxlength="10" name="azienda_numero_civico" value="{{isset($profilo->azienda_numero_civico) ? $profilo->azienda_numero_civico : ''}}" placeholder="@lang('Inserisci il numero civico')">
                                        <span class="form-text text-muted">@lang('Inserisci il numero civico della tua azienda - Richiesto')</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-xl-6">
                                        <label>@lang('Città')*:</label>
                                        <input type="text" class="form-control" maxlength="40" name="azienda_citta" required value="{{isset($profilo->azienda_citta) ? $profilo->azienda_citta : ''}}" placeholder="@lang('Inserisci la città')">
                                        <span class="form-text text-muted">@lang('Inserisci la città dove si trova la tua azienda - Richiesto')</span>
                                    </div>
                                    <div class="col-xl-3">
                                        <label>@lang('Provincia')*:</label>
                                        <input type="text" class="form-control" maxlength="100" name="azienda_provincia" required value="{{isset($profilo->azienda_provincia) ? $profilo->azienda_provincia : ''}}" placeholder="@lang('Inserisci la provincia')">
                                        <span class="form-text text-muted">@lang('Inserisci la provincia dove si trova la tua azienda - Richiesto')</span>
                                    </div>
                                    <div class="col-xl-3">
                                        <label>@lang('CAP')*:</label>
                                        <input type="text" class="form-control" maxlength="100" name="azienda_cap" required value="{{isset($profilo->azienda_cap) ? $profilo->azienda_cap : ''}}" placeholder="@lang('Inserisci il CAP')">
                                        <span class="form-text text-muted">@lang('Inserisci il CAP dove si trova la tua azienda - Richiesto')</span>
                                    </div>
                                </div>
                                <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
                                <h3 class="kt-section__title">@lang('Contatti'):</h3>
                                <div class="form-group row">
                                    <div class="col-xl-6">
                                        <label>@lang('Telefono')*:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                                            <input type="tel" name="telefono" class="form-control" required value="{{isset($profilo->telefono) ? $profilo->telefono : ''}}" maxlength="40" placeholder="@lang('Inserisci un telefono')">
                                        </div>
                                        <span class="form-text text-muted">@lang('Inserisci un recapito telefonico')</span>
                                    </div>
                                    <div class="col-xl-6">
                                         <label>@lang('E-mail')*:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i class="la la-envelope"></i></span></div>
                                            <input type="email" name="azienda_email" required class="form-control" value="{{isset($profilo->azienda_email) ? $profilo->azienda_email : ''}}" maxlength="150" placeholder="@lang('Inserisci l\'email aziendale')">
                                        </div>
                                         <span class="form-text text-muted">@lang('Inserisci una e-mail')</span>
                                    </div>                     
                                </div>
                                <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
                                <div class="form-group row">
                                    <div class="col-xl-6">
                                         <label>@lang('Facebook'):</label>
                                        <div class="input-group">
                                           
                                            <div class="input-group-prepend"><span class="input-group-text"><i class="la la-facebook"></i></span></div>
                                            <input type="url" class="form-control url" name="facebook" value="{{isset($profilo->facebook) ? $profilo->facebook : ''}}" maxlength="250" placeholder="@lang('https://www.facebook.com...')">
                                            
                                        </div>
                                         <span class="form-text text-muted">@lang('Inserisci  l\'indirizzo della tua pagina Facebook compreso di https://')</span>
                                    </div>
                                    <div class="col-xl-6">
                                         <label>@lang('Instagram'):</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i class="la la-instagram"></i></span></div>
                                            <input type="url" class="form-control url" name="instagram" value="{{isset($profilo->instagram) ? $profilo->instagram : ''}}" maxlength="250" placeholder="@lang('https://www.instagram.com...')">
                                        </div>
                                          <span class="form-text text-muted">@lang('Inserisci  l\'indirizzo della tua pagina Instagram compreso di https://')</span>
                                    </div>
                                </div>         
                                <div class="form-group row">
                                    <div class="col-xl-6">
                                         <label>@lang('Youtube'):</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i class="la la-youtube"></i></span></div>
                                            <input type="url" class="form-control url" name="youtube" value="{{isset($profilo->youtube) ? $profilo->youtube : ''}}" maxlength="250" placeholder="@lang('https://www.youtube.com...')">
                                        </div>
                                         <span class="form-text text-muted">@lang('Inserisci  l\'indirizzo del tuo canale YouTube compreso di https://')</span>
                                    </div>
                                    <div class="col-xl-6">
                                        <label>@lang('Twitter'):</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i class="la la-twitter"></i></span></div>
                                            <input type="url" class="form-control url" name="twitter" value="{{isset($profilo->twitter) ? $profilo->twitter : ''}}" maxlength="250" placeholder="@lang('https://www.twitter.com...')">
                                        </div>
                                         <span class="form-text text-muted">@lang('Inserisci  l\'indirizzo del tuo Twitter aziendale compreso di https://')</span>
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <div class="col-xl-6">
                                         <label>@lang('Sito web aziendale'):</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i class="la la-globe"></i></span></div>
                                            <input type="url" class="form-control url" name="blog" value="{{isset($profilo->blog) ? $profilo->blog : ''}}" maxlength="250" placeholder="@lang('https://www.tuo-sito.com...')">
                                            
                                        </div>
                                         <span class="form-text text-muted">@lang('Inserisci  l\'indirizzo del tuo sito web aziendale compreso di https://')</span>
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <button type="submit" class="btn btn-primary">@lang('Invia')</button>
                                <button type="reset" class="btn btn-secondary">@lang('Cancella')</button>
                            </div>
                        </div>
                       
                    </form>

                    <!--end::Form-->
                </div>
            </div>
        </div>
    </div>
    @endsection