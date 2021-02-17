@extends('frontend.layouts.interna')

@section('title', app_name() . ' | ' . __('applicazione.completa_profilo'))

@section('content')
@push('before-styles')
<link href="{{url('/')}}/assets/vendors/general/select2/dist/css/select2.css" rel="stylesheet" type="text/css" />
@endpush

@push('after-styles')
<link href="{{url('/')}}/css/wizard-2.css" rel="stylesheet" type="text/css" />
<style>
    .select2-container{font-size:1rem !important}
</style>
<link href="{{url('/')}}/assets/vendors/general/summernote/dist/summernote.css" rel="stylesheet" type="text/css" />
@endpush

@push('after-scripts')
<script src="{{url('/')}}/js/wizard-2.js?v=0.3"></script>
<script src="{{url('/')}}/js/select2.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/vendors/general/select2/dist/js/i18n/{{Config::get('app.locale')}}.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/vendors/general/jquery-validation/dist/localization/messages_{{Lang::locale()}}.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/vendors/general/summernote/dist/summernote.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/vendors/general/summernote/dist/lang/summernote-it-IT.js" type="text/javascript"></script>
<script src="{{url('/')}}/js/editor.js?v=0.6" type="text/javascript"></script>
<script>
$(".comuni").select2({
    tags: false,
    multiple: true,
    tokenSeparators: [','],
    minimumInputLength: 3,
    placeholder: "@lang('Inizia a digitare')",
    language: "{{ Config::get('app.locale')}}",
    minimumResultsForSearch: 10,
    ajax: {
        url: "{{route('frontend.user.comuni')}}",
        dataType: "json",
        type: "GET",
        data: function (params) {

            var queryParameters = {
                search: params.term
            }
            return queryParameters;
        },
        processResults: function (data) {
            return {
                results: $.map(data, function (item) {
                    return {
                        text: item.nome,
                        id: item.id
                    }
                })
            };
        }
    }
});

$(function(){
  registerSummernote('.summernote', '', 1000, function(max) {
    $('#maxContentPost').text(max);
  });
       
        
});

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
</script>
@endpush
<?php
?>
<div class="kt-holder kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">

    </div>

    <!-- end:: Subheader -->

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
        <div class="kt-portlet">
            @include('includes.partials.messages')
            
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="kt-grid  kt-wizard-v2 kt-wizard-v2--white" id="kt_wizard_v2"
                     data-ktwizard-state="step-first">
                    <div class="kt-grid__item kt-wizard-v2__aside">

                        <!--begin: Form Wizard Nav -->
                        <div class="kt-wizard-v2__nav">
                            <div class="kt-wizard-v2__nav-items">
                                <a class="kt-wizard-v2__nav-item" href="#"
                                   data-ktwizard-type="step" data-ktwizard-state="current">
                                    <div class="kt-wizard-v2__nav-body">
                                        <div class="kt-wizard-v2__nav-icon">
                                            <i class="flaticon-globe"></i>
                                        </div>
                                        <div class="kt-wizard-v2__nav-label">
                                            <div class="kt-wizard-v2__nav-label-title">
                                               @lang('applicazione.dati_generali')
                                            </div>
                                            <div class="kt-wizard-v2__nav-label-desc">
                                                @lang('applicazione.inserisci_dati_personali')
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a class="kt-wizard-v2__nav-item" href="#"
                                   data-ktwizard-type="step">
                                    <div class="kt-wizard-v2__nav-body">
                                        <div class="kt-wizard-v2__nav-icon">
                                            <i class="flaticon-responsive"></i>
                                        </div>
                                        <div class="kt-wizard-v2__nav-label">
                                            <div class="kt-wizard-v2__nav-label-title">
                                                @lang('applicazione.presenza_online')
                                            </div>
                                            <div class="kt-wizard-v2__nav-label-desc">
                                                Social, Blog, Mailing list
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a class="kt-wizard-v2__nav-item" href="#"
                                   data-ktwizard-type="step">
                                    <div class="kt-wizard-v2__nav-body">
                                        <div class="kt-wizard-v2__nav-icon">
                                            <i class="flaticon-map-location"></i>
                                        </div>
                                        <div class="kt-wizard-v2__nav-label">
                                            <div class="kt-wizard-v2__nav-label-title">
                                                @lang('applicazione.canali_tradizionali')
                                            </div>
                                            <div class="kt-wizard-v2__nav-label-desc">
                                                @lang('applicazione.descrizione_tradizionali')
                                            </div>
                                        </div>
                                    </div>
                                </a>

                            </div>
                        </div>

                        <!--end: Form Wizard Nav -->
                    </div>
                    <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v2__wrapper">

                        <!--begin: Form Wizard Form-->
                        <!-- <form class="kt-form" id="kt_form" action="" method="POST">-->

                        <form action="{{ isset($dettagli) ? route('frontend.user.profile.completa.update') : route('frontend.user.profile.completa.store') }}" method="POST" class="kt-form" id="kt_form" enctype="multipart/form-data">
                            @csrf
                            @if(isset($dettagli))
                            @method('PUT')
                            @endif
                            <!--begin: Form Wizard Step 1-->
                            <div class="kt-wizard-v2__content" data-ktwizard-type="step-content"
                                 data-ktwizard-state="current">


                                @if ($errors->any())

                                <div class="alert alert-danger fade show" role="alert">
                                    <div class="alert-icon"><i class="flaticon-warning"></i></div>
                                    <div class="alert-text">{{__('alerts.frontend.error_profile')}}</div>
                                    <div class="alert-close">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true"><i class="la la-close"></i></span>
                                        </button>
                                    </div>
                                </div>

                                @endif
                                <div class="kt-heading kt-heading--md">@lang('applicazione.inserisci_dati') </div>


                                <div class="kt-form__section kt-form__section--first">
                                    <div class="kt-wizard-v2__form">
                                        
                                         <div class="form-group row">
                                            <div class="col-xl-12">
                                                <div class="form-group">
                                                    <label>@lang('applicazione.professione')</label>
                                                    <input type="text" class="form-control" maxlength="500"
                                                           name="ruolo" placeholder="@lang('applicazione.placeholder_professione')"
                                                           value="{{isset($dettagli) ? $dettagli->ruolo:''}}">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-12">@lang('applicazione.descrizione_attivita')</label>
                                            <div class="col-lg-12">
                                                <textarea class="form-control summernote" maxlength="1000" required name="descrizione">{{isset($dettagli) ? $dettagli->descrizione: ''}}</textarea>
                                                <span class="form-text text-muted text-right" id="maxContentPost"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">

                                            <div class="col-xl-12">
                                                <label>Scegli le categorie della tua attività</label>
                                                <select class="form-control kt-select2" id="kt_select2_3" name="categorie[]" multiple="multiple">
                                                    @foreach($categorie as $categoria)
                                                    <option value="{{$categoria->id}}"
                                                            @if(isset($dettagli))

                                                            @if($dettagli->hasCategorie($categoria->id))
                                                            selected
                                                            @endif
                                                            @endif
                                                            >{{$categoria->nome}}</option>
                                                    @endforeach

                                                </select>

                                            </div>
                                        </div>
                                         
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label>@lang('applicazione.citta'):</label>
                                                   
                                                    <select multiple name="comuni[]" class="comuni form-control">
                                                        @if(!empty($dettagli->comuni))
                                                       
                                                            @foreach($dettagli->comuni as $comune)
                                                            <option selected value="{{$comune->id}}">{{$comune->nome}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label>@lang('applicazione.nazione'):</label>
                                                    <select name="residenza_nazione" class="form-control">
                                                        @foreach( $nazioni as $nazione)
                                                        <option value="{{$nazione->id}}"
                                                                @if(isset($dettagli))
                                                                @if( $nazione->id === $dettagli->residenza_nazione)
                                                                selected
                                                                @endif
                                                                @else
                                                                @if($nazione->name == 'Italy')
                                                                selected
                                                                @endif
                                                                @endif
                                                                >{{$nazione->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label>@lang('applicazione.telefono')</label>
                                                    <input type="tel" class="form-control" name="telefono" placeholder="@lang('applicazione.telefono')" value="{{isset($dettagli)?$dettagli->telefono:''}}">
                                                    <span class="form-text text-muted">@lang('applicazione.telefono_descrizione')</span>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!--end: Form Wizard Step 1-->


                            <!--begin: Form Wizard Step 3-->
                            <div class="kt-wizard-v2__content"
                                 data-ktwizard-type="step-content">
                                <div class="kt-heading kt-heading--md">
                                    @lang('applicazione.social')
                                    <p class="text-muted">@lang('applicazione.spiegazione_social')</p>
                                </div>
                                <div class="kt-form__section kt-form__section--first">
                                    <div class="kt-wizard-v2__form">
                                        <div class="row">
                                            <div class="form-group col-xl-8">
                                                <label>@lang('applicazione.pagina_facebook')</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="facebook_page">
                                                            <i class="fab fa-facebook-square kt-font-brand"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" name="facebook" class="form-control primary url" placeholder="https://www.facebook..." aria-describedby="facebook_page" value="{{isset($dettagli)?$dettagli->facebook:''}}">
                                                </div>
                                                <span class="form-text text-muted">@lang('applicazione.facebook_descrizione')</span>
                                            </div>
                                            <div class="form-group col-xl-4">
                                                <label>@lang('applicazione.mipiace')</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="facebook_like"><i class="flaticon-like kt-font-brand"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" data-sometimes="facebook" name="facebook_follower" class="form-control numeric" placeholder="" aria-describedby="facebook_like" value="{{isset($dettagli)?$dettagli->facebook_follower:''}}">
                                                </div>
                                                <span class="form-text text-muted">@lang('applicazione.mipiace_descrizione')</span>
                                            </div>
                                        </div>
                                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg">
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-xl-8">
                                                <label>Twitter</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="twitter"><i class="fab fa-twitter kt-font-brand"></i></span>
                                                    </div>
                                                    <input type="text" name="twitter" class="form-control primary url" placeholder="https://www.twitter..." aria-describedby="twitter" value="{{isset($dettagli)?$dettagli->twitter:''}}">
                                                </div>
                                                <span class="form-text text-muted">@lang('applicazione.twitter_descrizione')</span>
                                            </div>
                                            <div class="form-group col-xl-4">
                                                <label>@lang('applicazione.numero_follower')</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="twitter_follower"><i class="fa fa-user-friends kt-font-brand"></i></span>
                                                    </div>
                                                    <input type="text" name="twitter_follower" data-sometimes="twitter" class="form-control" placeholder="" aria-describedby="basic-addon1" value="{{isset($dettagli)?$dettagli->twitter_follower:''}}">
                                                </div>
                                                <span class="form-text text-muted">@lang('applicazione.numero_follower_descrizione')</span>
                                            </div>
                                        </div>
                                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg">
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-xl-8">
                                                <label>Instagram</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="instagram"><i class="fab fa-instagram kt-font-brand"></i></span>
                                                    </div>
                                                    <input type="text" name="instagram" class="form-control primary url" placeholder="https://www.instagram..." aria-describedby="instagram" value="{{isset($dettagli)?$dettagli->instagram:''}}">
                                                </div>
                                                <span class="form-text text-muted">@lang('applicazione.instagram_descrizione')</span>
                                            </div>
                                            <div class="form-group col-xl-4">
                                                <label>@lang('applicazione.numero_follower')</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text" id="instagram_follower"><i class="fa fa-user-friends kt-font-brand"></i></span>
                                                    </div>
                                                    <input type="text" name="instagram_follower" data-sometimes="instagram" class="form-control numeric" placeholder="" aria-describedby="instagram_follower" value="{{isset($dettagli)?$dettagli->instagram_follower:''}}">
                                                </div>
                                                <span class="form-text text-muted">@lang('applicazione.numero_follower_descrizione')</span>
                                            </div>
                                        </div>
                                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg">
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-xl-8">
                                                <label>@lang('YouTube')</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="youtube"><i class="fab fa-youtube kt-font-brand"></i></span>
                                                    </div>
                                                    <input type="text" name="youtube" class="form-control primary url" placeholder="https://youtube.com/iltuocanale" aria-describedby="youtube" value="{{isset($dettagli)?$dettagli->youtube:''}}">
                                                </div>
                                                <span class="form-text text-muted">@lang('applicazione.youtube_descrizione')</span>
                                            </div>
                                            <div class="form-group col-xl-4">
                                                <label>@lang('Iscritti')</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="youtube_iscritti"><i class="fa fa-user-friends kt-font-brand"></i></span>
                                                    </div>
                                                    <input type="text" name="youtube_follower" data-sometimes="youtube" class="form-control numeric" placeholder="" aria-describedby="youtube_iscritti" value="{{isset($dettagli)?$dettagli->youtube_follower:''}}">
                                                </div>
                                                <span class="form-text text-muted">@lang('Inserisci il numero di iscritti al canale')</span>
                                            </div>
                                        </div>
                                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg">
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-xl-8">
                                                <label>@lang('LinkedIn')</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="linkedin"><i class="fab fa-linkedin kt-font-brand"></i></span>
                                                    </div>
                                                    <input type="text" name="linkedin" class="form-control primary url" placeholder="https://www.linkedin.com..." aria-describedby="linkedin" value="{{isset($dettagli)?$dettagli->linkedin:''}}">
                                                </div>
                                                <span class="form-text text-muted">@lang('Inserisci l\'indirizzo del tuo account Linkedin')</span>
                                            </div>
                                            <div class="form-group col-xl-4">
                                                <label>@lang('Connessioni')</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="linkedin_iscritti"><i class="fa fa-user-friends kt-font-brand"></i></span>
                                                    </div>
                                                    <input type="text" name="linkedin_follower" data-sometimes="linkedin" class="form-control numeric" placeholder="" aria-describedby="linkedin_follower" value="{{isset($dettagli)?$dettagli->linkedin_follower:''}}">
                                                </div>
                                                <span class="form-text text-muted">@lang('Inserisci il numero di connessioni')</span>
                                            </div>
                                        </div>
                                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg">
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-xl-6">
                                                <label>@lang('Testata online/Blog')</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="blog"><i class="flaticon2-website kt-font-brand"></i></span>
                                                    </div>
                                                    <input type="text" name="blog" class="form-control primary url" placeholder="https://www..." aria-describedby="blog" value="{{isset($dettagli)?$dettagli->blog:''}}">
                                                </div>
                                                <span class="form-text text-muted">@lang('Inserisci l\'indirizzo web')</span>
                                            </div>
                                            <div class="form-group col-xl-3">
                                                <label>@lang('Utenti')</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="blog_utenti"><i class="fa fa-user-friends kt-font-brand"></i></span>
                                                    </div>
                                                    <input type="text" name="blog_follower" data-sometimes="blog" class="form-control numeric" placeholder="" aria-describedby="blog_utenti" value="{{isset($dettagli)?$dettagli->blog_follower:''}}">
                                                </div>
                                                <span class="form-text text-muted">@lang('Numero medio utenti unici mensili')</span>
                                            </div>
                                            <div class="form-group col-xl-3">
                                                <label>@lang('Visualizzazioni')</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="blog_visualizzazioni"><i class="flaticon-eye kt-font-brand"></i></span>
                                                    </div>
                                                    <input type="text" name="blog_visualizzazioni" data-sometimes="blog" class="form-control numeric" placeholder="" aria-describedby="blog_visualizzazioni" value="{{isset($dettagli)?$dettagli->blog_visualizzazioni:''}}">
                                                </div>
                                                <span class="form-text text-muted">@lang('Numero medio visualizzazioni di pagina mensili')</span>
                                            </div>
                                        </div>
                                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg">
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-xl-4">
                                                <label>@lang('Mailing list')</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="mailing_list"><i class="fa fa-user-friends kt-font-brand"></i></span>
                                                    </div>
                                                    <input type="text" name="mailing_list"  class="form-control numeric primary" placeholder="" aria-describedby="mailing_list" value="{{isset($dettagli)?$dettagli->mailing_list:''}}">
                                                </div>
                                                <span class="form-text text-muted">@lang('Inserisci il numero di iscritti')</span>
                                            </div>
                                            <div class="form-group col-xl-4">
                                                <label>@lang('% apertura')</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"  id="mailing_list_aperture"><i class="fa fa-envelope-open-text kt-font-brand"></i></span>
                                                    </div>
                                                    <input type="text" name="mailing_list_aperture" data-sometimes="mailing_list" class="form-control numeric" placeholder="" aria-describedby="mailing_list_aperture" value="{{isset($dettagli)?$dettagli->mailing_list_aperture:''}}">
                                                </div>
                                                <span class="form-text text-muted">@lang('% apertura e-mail')</span>
                                            </div>
                                            <div class="form-group col-xl-4">
                                                <label>@lang('%Click su link')</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="mailing_list_click"><i class="fa fa-hand-pointer kt-font-brand"></i></span>
                                                    </div>
                                                    <input type="text" name="mailing_list_click" data-sometimes="mailing_list" class="form-control numeric" placeholder="" aria-describedby="mailing_list_click" value="{{isset($dettagli)?$dettagli->mailing_list_click:''}}">
                                                </div>
                                                <span class="form-text text-muted">@lang('% click su link') </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--end: Form Wizard Step 3-->

                            <!--begin: Form Wizard Step 4-->
                            <div class="kt-wizard-v2__content"
                                 data-ktwizard-type="step-content">
                                <div class="kt-heading kt-heading--md">@lang('Canali tradizionali')
                                    <p class="text-muted">@lang('applicazione.spiegazione_canali_tradizionali')</p>
                                </div>
                                <div class="kt-form__section kt-form__section--first">
                                    <div class="kt-wizard-v2__form">
                                        <p style="font-weight:bold" class="kt-section__title">@lang('Testata giornalistica/Rivista:')</p>
                                        <div class="row">
                                            <div class="col-xl-4">
                                                <div class="form-group">
                                                    <label>@lang('Tiratura')</label>
                                                    <input type="text" name="giornale_tiratura" class="form-control numeric primary" placeholder="" value="{{isset($dettagli)?$dettagli->giornale_tiratura:''}}">
                                                    <span class="form-text text-muted">@lang('Inserisci la tiratura.')</span>
                                                </div>
                                            </div>
                                            <div class="col-xl-4">
                                                <div class="form-group">
                                                    <label>@lang('Periodicità')</label>
                                                    <input type="text" class="form-control" name="giornale_periodo" data-sometimes="giornale_tiratura"  placeholder="" value="{{isset($dettagli)?$dettagli->giornale_periodo:''}}">
                                                    <span class="form-text text-muted">@lang('Mensile/settimanale.')</span>
                                                </div>
                                            </div>
                                            <div class="col-xl-4">
                                                <div class="form-group">
                                                    <label>@lang('Area Geografica')</label>
                                                    <input type="text" class="form-control" name="giornale_area" data-sometimes="giornale_tiratura" placeholder="" value="{{isset($dettagli)?$dettagli->giornale_area:''}}">
                                                    <span class="form-text text-muted">@lang('Locale/nazionale')</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg">
                                        </div>
                                        <p style="font-weight:bold" class="kt-section__title">@lang('Negozio:')</p>
                                        <div class="row">

                                            <div class="col-xl-4">
                                                <div class="form-group">
                                                    <label>@lang('Metri quadrati')</label>
                                                    <input type="text" class="form-control numeric primary" name="negozio_metri" placeholder="" value="{{isset($dettagli)?$dettagli->negozio_metri:''}}">
                                                    <span class="form-text text-muted">@lang('Inserisci i metri quadrati.')</span>
                                                </div>
                                            </div>
                                            <div class="col-xl-4">
                                                <div class="form-group">
                                                    <label>@lang('Area Geografica')</label>
                                                    <input type="text" class="form-control" name="negozio_area" data-sometimes="negozio_metri" placeholder="" value="{{isset($dettagli)?$dettagli->negozio_area:''}}">
                                                    <span class="form-text text-muted">@lang('grande città / provincia / paese.')</span>
                                                </div>
                                            </div>
                                            <div class="col-xl-4">
                                                <div class="form-group">
                                                    <label>@lang('Posizione urbana')</label>
                                                    <input type="text" class="form-control" name="negozio_posizione" data-sometimes="negozio_metri" placeholder="" value="{{isset($dettagli)?$dettagli->negozio_posizione:''}}">
                                                    <span class="form-text text-muted">@lang('Centro periferia')</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-4">
                                                <div class="form-group">
                                                    <label>@lang('Pubblico mensile')</label>
                                                    <input type="text" class="form-control numeric" name="negozio_clienti" data-sometimes="negozio_metri" placeholder="" value="{{isset($dettagli)?$dettagli->negozio_clienti:''}}">
                                                    <span
                                                        class="form-text text-muted">@lang('Numero di clienti medi mensili')</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg">
                                        </div>
                                        <p style="font-weight:bold"
                                           class="kt-section__title">@lang('Eventi:')</p>
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label>@lang('Numero di eventi all\'anno')</label>
                                                    <input type="text" class="form-control numeric primary" name="eventi_numero" placeholder="" value="{{isset($dettagli)?$dettagli->eventi_numero:''}}">

                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label>@lang('Numero medi di partecipanti')</label>
                                                    <input type="text" class="form-control numeric" name="eventi_partecipanti" data-sometimes="eventi_numero" placeholder="" value="{{isset($dettagli)?$dettagli->partecipanti:''}}">

                                                </div>
                                            </div>

                                        </div>


                                    </div>
                                </div>
                            </div>

                            <!--end: Form Wizard Step 4-->

                            <!--begin: Form Wizard Step 5-->


                            <!--end: Form Wizard Step 5-->

                            <!--begin: Form Actions -->
                            <div class="kt-form__actions">
                                <div class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"
                                     data-ktwizard-type="action-prev">
                                    @lang('Precedente')
                                </div>
                                <div class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"
                                     data-ktwizard-type="action-submit">
                                    @lang('Completa')
                                </div>
                                <div class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"
                                     data-ktwizard-type="action-next">
                                    @lang('applicazione.avanti')
                                </div>
                            </div>

                            <!--end: Form Actions -->
                        </form>

                        <!--end: Form Wizard Form-->
                    </div>
                </div>
            </div>
        </div>

    </div>
    @endsection