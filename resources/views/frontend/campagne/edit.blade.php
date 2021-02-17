{{-- Create new campagne --}}

@extends('frontend.layouts.interna')

@section('title', app_name() . ' | ' . __('applicazione.modifica'))
@php
$value_immagine_0 = $value_immagine_1 = $value_immagine_2 = '';
@endphp
@section('content')
@push('after-styles')

<link href="{{url('/')}}/css/wizard-4.css" rel="stylesheet" type="text/css" />
<link href="{{url('/')}}/assets/vendors/general/select2/dist/css/select2.css" rel="stylesheet" type="text/css" />
<script src="{{url('/')}}/js/slim.kickstart.min.js"></script>
<style>
    .select2-container{
        font-size:1rem !important
    }
    .kt-avatar__holder{
        background-image: url('{{url('/')}}/img/frontend/add_file.jpg');
        background-size: contain
    }
</style>
<link href="{{url('/')}}/assets/vendors/general/summernote/dist/summernote.css" rel="stylesheet" type="text/css" />
<link href="{{url('/')}}/css/slim.min.css" rel="stylesheet" type="text/css" />
@endpush

@push('after-scripts')
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
function handleRequest(xhr){
        
        xhr.setRequestHeader('X-CSRF-TOKEN', '{{csrf_token() }}' );
    }
    
    
        function imageUpload(error, data, response) {
            
            if(error != 'fail'){
                
                $('#immagine_'+response.field).val(response.file);
                
            }

    }
    function handleImageRemoval(data) {

        
        // setup request and send
        var immagine = (typeof  data.meta.immagine !== 'undefined') ? data.meta.immagine : data.server.file
        var url = '{{route('frontend.user.immagine.delete')}}';
        var xhr = new XMLHttpRequest();
        console.log(immagine);
        xhr.open('DELETE', url+'?immagine='+immagine , true);
        xhr.setRequestHeader('X-CSRF-TOKEN', '{{csrf_token() }}' );
        xhr.send();
        $('#immagine_'+data.meta.allegato).val('');
    }

    function attiva(classe) {


    if (classe == 'digitali') {
    $('.canali').html('{{__('applicazione.descrizione_canali_digitali') }}');
    $('div.digitali').show();
    $('div.tradizionali input').prop('checked', false);
    $('div.tradizionali').hide();
    } else {
    $('.canali').html('{{__('applicazione.descrizione_canali_tradizionali') }}');
    $('div.digitali').hide();
    $('div.digitali input').prop('checked', false);
    $('div.tradizionali').show();
    }
    }
    $(document).ready(function () {

    $('input.tipologia').click(function () {
    attiva($(this).data('active'));
    });
    $('input.tipologia').each(function () {
    if ($(this).is(':checked')) {
    attiva($(this).data('active'));
    }
    });
    $('.cancella-allegato').click(function (e) {
    var target = $(this).data('input');
    $('#' + target).show();
    $(this).parent().hide();
    $('#kt_form').append('<input type="hidden" name="' + target + '" value="1" />');
    });
    $(".profile_avatar").change(function () {

    var token = '{{csrf_token()}}';
    var formData = new FormData();
    var posizione = $(this).data('posizione');
    formData.append('allegato', this.files[0]);
    formData.append('_token', token);
    formData.append('posizione', posizione);
    KTApp.block('#kt-avatar__holder_' + posizione);
    $.ajax({
    type: 'POST',
            url: '{{route('frontend.user.allegato')}}',
            data: formData,
            contentType: false,
            processData: false,
    }).done(function (data) {


    if (data.extension != 'pdf'){
        
    $('#kt-avatar__holder_' + posizione).css('background-image', 'url({{url('/')}}/storage/' + data.avatar_location + ')');
    } else{
        
    $('#kt-avatar__holder_' + posizione).css('background-image', 'url({{url('')}}/img/frontend/pdf.jpg)');
    }
    $('#h_allegato_' + posizione).remove();
    $('#kt_apps_user_add_avatar_' + posizione).append('<input type="hidden" id="h_allegato_' + posizione + '" name="h_allegato_' + posizione + '" value="' + data.id + '" />')

    KTApp.unblock('#kt-avatar__holder_' + posizione);
    $('#kt-avatar__cancel_' + posizione).css('display', 'flex');
    $('#kt-avatar__cancel_' + posizione).data('id', data.id);
    }).fail(function (jqXHR, textStatus, errorThrown) {
    KTApp.unblock('#kt-avatar__holder_' + posizione);
    swal.fire({
    "title": "",
            "text": "@lang('Sono consentiti solo file Pdf. Max 5MB')",
            "type": "error",
            "confirmButtonClass": "btn btn-secondary"
    });
    });
    });
    $('.kt-avatar__cancel').click(function () {

    var token = '{{csrf_token()}}';
    var formData = new FormData();
    var posizione = $(this).data('posizione');
    var id = $(this).data('id');
    KTApp.block('#kt-avatar__holder_' + posizione);
    formData.append('_token', token);
    formData.append('id', id);
    $.ajax({

    type: 'POST',
            url: '{{route('frontend.user.allegato.delete')}}',
            data: formData,
            contentType: false,
            processData: false,
    }).done(function (data) {
    KTApp.unblock('#kt-avatar__holder_' + posizione);
    swal.fire({
    "title": "",
            "text": "@lang('File Cancellato')",
            "type": "success",
            "confirmButtonClass": "btn btn-secondary"
    });
    $('#kt-avatar__holder_' + posizione).css('background-image', 'url({{url('/')}}/img/frontend/add_file.jpg)');
    $('#kt-avatar__cancel_' + posizione).css('display', 'none');
    $('#h_allegato_' + posizione).remove();
    $("#allegato_" + posizione).val('');
    }).fail(function (jqXHR, textStatus, errorThrown) {
    KTApp.unblock('#kt-avatar__holder_' + posizione);
    });
    });
    });</script>

<script src="{{url('/')}}/js/wizard-4.js?v=0.7"></script>
<script src="{{url('/')}}/js/select2.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/vendors/general/select2/dist/js/i18n/{{Config::get('app.locale')}}.js" type="text/javascript"></script>
<script src="{{url('/')}}/js/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/vendors/general/bootstrap-datepicker/js/locales/bootstrap-datepicker.it.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/vendors/general/bootstrap-maxlength/src/bootstrap-maxlength.js" type="text/javascript"></script>
<script src="{{url('/')}}/js/bootstrap-maxlength.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/vendors/general/summernote/dist/summernote.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/vendors/general/summernote/dist/lang/summernote-it-IT.js" type="text/javascript"></script>
<script src="{{url('/')}}/js/editor.js" type="text/javascript"></script>
<script>
    $(function(){
    registerSummernote('.summernote', '', 1000, function(max) {
    $('#maxContentPost').text(max)
    });
    });

</script>
<script>


</script>

@endpush

<div class="kt-holder kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">

    </div>
    <!-- begin:: Content -->
    <div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="kt-wizard-v4" id="kt_wizard_v4" data-ktwizard-state="step-first">

            @if ($errors->any())

            <div class="alert alert-danger fade show" role="alert">
                <div class="alert-icon"><i class="flaticon-warning"></i></div>
                <div class="alert-text">{{__('alerts.frontend.error_profile')}}<br>@foreach($errors->all() as $error)
                    {{$error}}
                    @endforeach</div>
                <div class="alert-close">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-close"></i></span>
                    </button>
                </div>
            </div>

            @endif
            <!--begin: Form Wizard Nav -->
            <div class="kt-wizard-v4__nav">
                <div class="kt-wizard-v4__nav-items">
                    <a class="kt-wizard-v4__nav-item" href="#" data-ktwizard-type="step"
                       data-ktwizard-state="current">
                        <div class="kt-wizard-v4__nav-body">
                            <div class="kt-wizard-v4__nav-number">
                                1
                            </div>
                            <div class="kt-wizard-v4__nav-label">
                                <div class="kt-wizard-v4__nav-label-title">
                                    @lang('Scegli la tipologia')
                                </div>
                                <div class="kt-wizard-v4__nav-label-desc">
                                    @lang('Digitale / Tradizionale')
                                </div>
                            </div>
                        </div>
                    </a>
                    <a class="kt-wizard-v4__nav-item" href="#" data-ktwizard-type="step">
                        <div class="kt-wizard-v4__nav-body">
                            <div class="kt-wizard-v4__nav-number">
                                2
                            </div>
                            <div class="kt-wizard-v4__nav-label">
                                <div class="kt-wizard-v4__nav-label-title">
                                    @lang('applicazione.canali')
                                </div>
                                <div class="kt-wizard-v4__nav-label-desc canali">
                                    @if(isset($campagna))
                                   {{($campagna->tipologia == 'online') ? __('applicazione.descrizione_canali_digitali') : __('applicazione.descrzione_canali_tradizionali') }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                    <a class="kt-wizard-v4__nav-item" href="#" data-ktwizard-type="step">
                        <div class="kt-wizard-v4__nav-body">
                            <div class="kt-wizard-v4__nav-number">
                                3
                            </div>
                            <div class="kt-wizard-v4__nav-label">
                                <div class="kt-wizard-v4__nav-label-title">
                                    Categoria
                                </div>
                                <div class="kt-wizard-v4__nav-label-desc">

                                </div>
                            </div>
                        </div>
                    </a>
                    <a class="kt-wizard-v4__nav-item" href="#" data-ktwizard-type="step">
                        <div class="kt-wizard-v4__nav-body">
                            <div class="kt-wizard-v4__nav-number">
                                4
                            </div>
                            <div class="kt-wizard-v4__nav-label">
                                <div class="kt-wizard-v4__nav-label-title">
                                    @lang('Descrizione')
                                </div>
                                <div class="kt-wizard-v4__nav-label-desc">
                                    @lang('Completa Campagna')
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!--end: Form Wizard Nav -->
            <div class="kt-portlet">
                <div class="kt-portlet__body kt-portlet__body--fit">
                    <div class="kt-grid">
                        <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper">

                            <!--begin: Form Wizard Form-->
                            <form action="{{ isset($campagna) ? route('frontend.user.campagne.update',$campagna->uuid) : route('frontend.user.campagne.store') }}" method="POST" class="kt-form" id="kt_form" enctype="multipart/form-data">
                                @csrf
                                @if(isset($campagna))
                                @method('PUT')
                                @endif
                                <!--begin: Form Wizard Step 1-->
                                <div class="kt-wizard-v4__content"
                                     data-ktwizard-type="step-content"
                                     data-ktwizard-state="current">
                                    <div class="kt-heading kt-heading--md">Scegli la tipologia</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v4__form">
                                            <div class="form-group form-group-marginless">
                                                <label>@lang('Inserisci un titolo per la tua campagna. Max 15 caratteri')</label>
                                                <input type="text" class="form-control" maxlength="15" value="{{isset($campagna) ? $campagna->titolo : ''}}" name="titolo" placeholder="@lang('Iserisci titolo')" />
                                            </div>
                                           
                                                <div class="mt-3 form-group">
                                                    <label>@lang('(Facoltativo) Se vuoi che la tua campagna sia specifica per un determinato comune indicalo qui:')</label>
                                                   
                                                    <select multiple name="comuni[]" class="comuni form-control">
                                                        @if(!empty($campagna->comuni))
                                                       
                                                            @foreach($campagna->comuni as $comune)
                                                            <option selected value="{{$comune->id}}">{{$comune->nome}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    
                                                </div>
                                            
                                            
                                            <div class="form-group form-group-marginless">
                                                <label></label>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label class="kt-option">
                                                            <span class="kt-option__control">
                                                                <span
                                                                    class="kt-radio kt-radio--check-bold">
                                                                    <input type="radio" name="tipologia" value="online" class="tipologia" data-active="digitali" 
                                                                           {{ (isset($campagna) && $campagna->tipologia == 'online') ? 'checked' : ''}} 
                                                                    />
                                                                    <span></span>
                                                                </span>
                                                            </span>
                                                            <span class="kt-option__label">
                                                                <span class="kt-option__head">
                                                                    <span
                                                                        class="kt-option__title">
                                                                        @lang('Digitale')
                                                                    </span>
                                                                    <span
                                                                        class="kt-option__focus">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                             xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                             width="24px"
                                                                             height="24px"
                                                                             viewBox="0 0 24 24"
                                                                             version="1.1"
                                                                             class="kt-svg-icon">
                                                                        <g stroke="none"
                                                                           stroke-width="1"
                                                                           fill="none"
                                                                           fill-rule="evenodd">
                                                                        <rect id="bound"
                                                                              x="0" y="0"
                                                                              width="24"
                                                                              height="24" />
                                                                        <path
                                                                            d="M11,20 L11,17 C11,16.4477153 11.4477153,16 12,16 C12.5522847,16 13,16.4477153 13,17 L13,20 L15.5,20 C15.7761424,20 16,20.2238576 16,20.5 C16,20.7761424 15.7761424,21 15.5,21 L8.5,21 C8.22385763,21 8,20.7761424 8,20.5 C8,20.2238576 8.22385763,20 8.5,20 L11,20 Z"
                                                                            id="Combined-Shape"
                                                                            fill="#000000"
                                                                            opacity="0.3" />
                                                                        <path
                                                                            d="M3,5 L21,5 C21.5522847,5 22,5.44771525 22,6 L22,16 C22,16.5522847 21.5522847,17 21,17 L3,17 C2.44771525,17 2,16.5522847 2,16 L2,6 C2,5.44771525 2.44771525,5 3,5 Z M4.5,8 C4.22385763,8 4,8.22385763 4,8.5 C4,8.77614237 4.22385763,9 4.5,9 L13.5,9 C13.7761424,9 14,8.77614237 14,8.5 C14,8.22385763 13.7761424,8 13.5,8 L4.5,8 Z M4.5,10 C4.22385763,10 4,10.2238576 4,10.5 C4,10.7761424 4.22385763,11 4.5,11 L7.5,11 C7.77614237,11 8,10.7761424 8,10.5 C8,10.2238576 7.77614237,10 7.5,10 L4.5,10 Z"
                                                                            id="Combined-Shape"
                                                                            fill="#000000" />
                                                                        </g>
                                                                        </svg>
                                                                    </span>
                                                                </span>
                                                                <span class="kt-option__body">
                                                                    @lang('Social / Blog / Mailing List')
                                                                </span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label class="kt-option">
                                                            <span class="kt-option__control">
                                                                <span
                                                                    class="kt-radio kt-radio--check-bold">
                                                                    <input type="radio"
                                                                           name="tipologia"
                                                                           class="tipologia"
                                                                           data-active="tradizionali"
                                                                           value="offline"
                                                                           {{ (isset($campagna) && $campagna->tipologia == 'offline') ? 'checked' : ''}} 
                                                                    >
                                                                    <span></span>
                                                                </span>
                                                            </span>
                                                            <span class="kt-option__label">
                                                                <span class="kt-option__head">
                                                                    <span
                                                                        class="kt-option__title">
                                                                        @lang('Canali Tradizionali')
                                                                    </span>
                                                                    <span
                                                                        class="kt-option__focus">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                             xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                             width="24px"
                                                                             height="24px"
                                                                             viewBox="0 0 24 24"
                                                                             version="1.1"
                                                                             class="kt-svg-icon">
                                                                        <g stroke="none"
                                                                           stroke-width="1"
                                                                           fill="none"
                                                                           fill-rule="evenodd">
                                                                        <rect id="bound"
                                                                              x="0" y="0"
                                                                              width="24"
                                                                              height="24" />
                                                                        <path
                                                                            d="M13.6855025,18.7082217 C15.9113859,17.8189707 18.682885,17.2495635 22,17 C22,16.9325178 22,13.1012863 22,5.50630526 L21.9999762,5.50630526 C21.9999762,5.23017604 21.7761292,5.00632908 21.5,5.00632908 C21.4957817,5.00632908 21.4915635,5.00638247 21.4873465,5.00648922 C18.658231,5.07811173 15.8291155,5.74261533 13,7 C13,7.04449645 13,10.79246 13,18.2438906 L12.9999854,18.2438906 C12.9999854,18.520041 13.2238496,18.7439052 13.5,18.7439052 C13.5635398,18.7439052 13.6264972,18.7317946 13.6855025,18.7082217 Z"
                                                                            id="Combined-Shape"
                                                                            fill="#000000" />
                                                                        <path
                                                                            d="M10.3144829,18.7082217 C8.08859955,17.8189707 5.31710038,17.2495635 1.99998542,17 C1.99998542,16.9325178 1.99998542,13.1012863 1.99998542,5.50630526 L2.00000925,5.50630526 C2.00000925,5.23017604 2.22385621,5.00632908 2.49998542,5.00632908 C2.50420375,5.00632908 2.5084219,5.00638247 2.51263888,5.00648922 C5.34175439,5.07811173 8.17086991,5.74261533 10.9999854,7 C10.9999854,7.04449645 10.9999854,10.79246 10.9999854,18.2438906 L11,18.2438906 C11,18.520041 10.7761358,18.7439052 10.4999854,18.7439052 C10.4364457,18.7439052 10.3734882,18.7317946 10.3144829,18.7082217 Z"
                                                                            id="Path-41-Copy"
                                                                            fill="#000000"
                                                                            opacity="0.3" />
                                                                        </g>
                                                                        </svg>
                                                                    </span>
                                                                </span>
                                                                <span class="kt-option__body">
                                                                    @lang('Eventi / Riviste / Negozi')
                                                                </span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--end: Form Wizard Step 1-->

                                <!--begin: Form Wizard Step 2-->
                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                    @php 
                                    if(isset($campagna)){
                                    $canali = json_decode($campagna->canali, true);

                                    }
                                    @endphp
                                    <div class="kt-heading kt-heading--md">@lang('Scegli il tuo canale')</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v4__form">
                                            <div class="form-group row digitali">
                                                <label class="col-3 col-form-label"><button type="button" class="btn btn-label-primary btn-sm btn-icon facebook" data-toggle="kt-popover" title="" data-content="{{__('applicazione.facebook_spiegazione')}}" data-original-title="Facebook"><i class="fa fa-info-circle"></i></button>  Facebook</label>
                                                <div class="col-xl-3 col-9">
                                                    <span
                                                        class="kt-switch kt-switch--lg kt-switch--icon">
                                                        <label>
                                                            <input type="checkbox" name="canali[]" value="facebook" {{(isset($campagna) && in_array('facebook',$canali)) ? 'checked' : ''}} >
                                                                   <span></span>
                                                        </label>
                                                    </span>

                                                </div>
                                               <label class="col-3 col-form-label"><button type="button" class="btn btn-label-primary btn-sm btn-icon twitter" data-toggle="kt-popover" title="" data-content="{{__('applicazione.twitter_spiegazione')}}" data-original-title="Twitter"><i class="fa fa-info-circle"></i></button>  Twitter  </label>
                                                <div class="col-xl-3 col-9">
                                                    <span
                                                        class="kt-switch kt-switch--lg kt-switch--icon">
                                                        <label>
                                                            <input type="checkbox"
                                                                   name="canali[]" value="twitter" {{(isset($campagna) && in_array('twitter',$canali)) ? 'checked' : ''}} >
                                                                   <span></span>
                                                        </label>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group row digitali">
                                                <label class="col-3 col-form-label"><button type="button" class="btn btn-label-primary btn-sm btn-icon instagram" data-toggle="kt-popover" title="" data-content="{{__('applicazione.instagram_spiegazione')}}" data-original-title="Instagram"><i class="fa fa-info-circle"></i></button>  Instagram</label>
                                                <div class="col-xl-3 col-9">
                                                    <span
                                                        class="kt-switch kt-switch--lg kt-switch--icon">
                                                        <label>
                                                            <input type="checkbox"
                                                                   name="canali[]" value="instagram" {{(isset($campagna) && in_array('instagram',$canali)) ? 'checked' : ''}}>
                                                                   <span></span>
                                                        </label>
                                                    </span>
                                                </div>
                                                <label class="col-3 col-form-label"><button type="button" class="btn btn-label-primary btn-sm btn-icon youtube" data-toggle="kt-popover" title="" data-content="{{__('applicazione.youtube_spiegazione')}}" data-original-title="Youtube"><i class="fa fa-info-circle"></i></button>  Youtube</label>
                                                <div class="col-xl-3 col-9">
                                                    <span
                                                        class="kt-switch kt-switch--lg kt-switch--icon">
                                                        <label>
                                                            <input type="checkbox"
                                                                   name="canali[]" value="youtube" {{(isset($campagna) && in_array('youtube',$canali)) ? 'checked' : ''}}>
                                                                   <span></span>
                                                        </label>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group row digitali">
                                                <label class="col-3 col-form-label"><button type="button" class="btn btn-label-primary btn-sm btn-icon linkedin" data-toggle="kt-popover" title="" data-content="{{__('applicazione.linkedin_spiegazione')}}" data-original-title="LinkedIn"><i class="fa fa-info-circle"></i></button> LinkedIn</label>
                                                <div class="col-xl-3 col-9">
                                                    <span
                                                        class="kt-switch kt-switch--lg kt-switch--icon">
                                                        <label>
                                                            <input type="checkbox"
                                                                  name="canali[]" value="linkedin" {{(isset($campagna) && in_array('linkedin',$canali)) ? 'checked' : ''}}>
                                                                   <span></span>
                                                        </label>
                                                    </span>
                                                </div>
                                                <label class="col-3 col-form-label"><button type="button" class="btn btn-label-primary btn-sm btn-icon " data-toggle="kt-popover" title="" data-content="{{__('applicazione.blog_spiegazione')}}" data-original-title="Blog"><i class="fa fa-info-circle"></i></button> @lang('Testata Online / Blog')</label>
                                                <div class="col-xl-3 col-9">
                                                    <span
                                                        class="kt-switch kt-switch--lg kt-switch--icon">
                                                        <label>
                                                            <input type="checkbox"
                                                                   name="canali[]" value="blog" {{(isset($campagna) && in_array('blog',$canali)) ? 'checked' : ''}}>
                                                                   <span></span>
                                                        </label>
                                                    </span>
                                                </div>
                                                
                                            </div>
                                            <div class="form-group row digitali">
                                                <label class="col-3 col-form-label"><button type="button" class="btn btn-label-primary btn-sm btn-icon " data-toggle="kt-popover" title="" data-content="{{__('applicazione.mailing_spiegazione')}}" data-original-title="Mailing List"><i class="fa fa-info-circle"></i></button>  Mailing list</label>
                                                <div class="col-xl-3 col-9">
                                                    <span
                                                        class="kt-switch kt-switch--lg kt-switch--icon">
                                                        <label>
                                                            <input type="checkbox"
                                                                  name="canali[]" value="mailing_list" {{(isset($campagna) && in_array('mailing_list',$canali)) ? 'checked' : ''}}>
                                                                   <span></span>
                                                        </label>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group row tradizionali">
                                                <label class="col-3 col-form-label"><button type="button" class="btn btn-label-primary btn-sm btn-icon " data-toggle="kt-popover" title="" data-content="{{__('applicazione.rivista_spiegazione')}}" data-original-title="Rivista"><i class="fa fa-info-circle"></i></button>  @lang('Rivista cartacea')</label>
                                                <div class="col-xl-3 col-9">
                                                    <span
                                                        class="kt-switch kt-switch--lg kt-switch--icon">
                                                        <label>
                                                            <input type="checkbox"
                                                                   name="canali[]" value="giornale_tiratura" {{(isset($campagna) && in_array('giornale_tiratura',$canali)) ? 'checked' : ''}}>
                                                                   <span></span>
                                                        </label>
                                                    </span>
                                                </div>
                                                <label class="col-3 form-label"><button type="button" class="btn btn-label-primary btn-sm btn-icon " data-toggle="kt-popover" title="" data-content="{{__('applicazione.eventi_spiegazione')}}" data-original-title="Eventi"><i class="fa fa-info-circle"></i></button>  @lang('Eventi')</label>
                                                <div class="col-xl-3 col-9">
                                                    <span
                                                        class="kt-switch kt-switch--lg kt-switch--icon">
                                                        <label>
                                                            <input type="checkbox"
                                                                   name="canali[]" value="eventi_numero" {{(isset($campagna) && in_array('eventi_numero',$canali)) ? 'checked' : ''}}>
                                                                   <span></span>
                                                        </label>
                                                    </span>
                                                </div>
                                                <label class="col-3 col-form-label"><button type="button" class="btn btn-label-primary btn-sm btn-icon " data-toggle="kt-popover" title="" data-content="{{__('applicazione.negozio_spiegazione')}}" data-original-title="Negozio"><i class="fa fa-info-circle"></i></button>  @lang('Negozio')</label>
                                                <div class="col-xl-3 col-9">
                                                    <span
                                                        class="kt-switch kt-switch--lg kt-switch--icon">
                                                        <label>
                                                            <input type="checkbox" name="canali[]" value="negozio_metri" {{(isset($campagna) && in_array('negozio_metri',$canali)) ? 'checked' : ''}}>
                                                                   <span></span>
                                                        </label>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--end: Form Wizard Step 2-->

                                <!--begin: Form Wizard Step 3-->
                                <div class="kt-wizard-v4__content"
                                     data-ktwizard-type="step-content">
                                    <div class="kt-heading kt-heading--md">@lang('Scegli la categoria')</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v4__form">

                                            <select style="width:100%" class="form-control kt-select2"
                                                    id="kt_select2_3" name="categorie[]"
                                                    multiple="multiple">
                                                @foreach($categorie as $categoria)
                                                <option value="{{$categoria->id}}"
                                                        @if(isset($campagna))

                                                        @if($campagna->hasCategorie($categoria->id))
                                                        selected
                                                        @endif
                                                        @endif
                                                        >{{$categoria->nome}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                <style>.select-2{ width: 100% !important}</style>
                                <!--end: Form Wizard Step 3-->

                                <!--begin: Form Wizard Step 4-->
                                <div class="kt-wizard-v4__content"
                                     data-ktwizard-type="step-content">
                                    <div class="kt-heading kt-heading--md">@lang('Descrivi la tua campagna e indica delle date')</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v4__form">
                                            <div class="form-group form-group-last">
                                                <div class="form-group row">
                                                    <label class="col-xl-12" for="descrizione">@lang('applicazione.descrizione_campagna')</label>
                                                    <div class="col-xl-12">
                                                        <textarea name="descrizione" style="margin-bottom:25px" class="form-control summernote" maxlength="1000" id="descrizione" rows="3">{{isset($campagna) ? $campagna->descrizione : ''}}</textarea>
                                                        <span class="form-text text-muted text-right" id="maxContentPost"></span>
                                                        <div class="progress" style="height: 5px;">
                                                            <div class="progress-bar kt-bg-brand" role="progressbar" style="width: {{isset($campagna) ? (strlen($campagna->descrizione) / 1000 ) * 100 : '0'}}%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">                                    

                                                    <label class="col-form-label col-xl-12">@lang('Data Iniziale')</label>
                                                    <div class="col-xl-3">
                                                        <div class="input-group date">
                                                            <input type="text" class="form-control" name="data_inizio" autocomplete="off" placeholder="Seleziona data" id="data_inizio" value="{{isset($campagna) ? date('d/m/Y',strtotime($campagna->data_inizio)) : ''}}" />

                                                            <div class="input-group-append">
                                                                <span class="input-group-text">
                                                                    <i class="la la-calendar-check-o"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-form-label col-xl-12">@lang('Data Finale')</label>
                                                    <div class="col-xl-3">
                                                        <div class="input-group date">
                                                            <input type="text" class="form-control" name="data_fine" autocomplete="off" placeholder="Seleziona Data" id="data_fine" value="{{isset($campagna) ? date('d/m/Y',strtotime($campagna->data_fine)) : ''}}" />

                                                            <div class="input-group-append">
                                                                <span class="input-group-text">
                                                                    <i class="la la-calendar-check-o"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-lg-6">
                                                        <div class="kt-heading kt-heading--md">Budget</div>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <select name="budget_periodo" class="custom-select form-control">
                                                                    @for($i=1; $i<=3; $i++)
                                                                    <option
                                                                        @if(isset($campagna))
                                                                        {{($campagna->budget_periodo == $i) ? 'selected' : ''}}
                                                                        @endif
                                                                        value="{{$i}}">@lang('applicazione.budget_'.$i)</option>
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                            <input type="number" name="budget" class="form-control" value="{{isset($campagna) ? $campagna->budget : ''}}" aria-label="Budget">
                                                            <div class="input-group-append"><span class="input-group-text" id="basic-addon1">€</span></div>
                                                        </div>
                                                        <span class="form-text text-muted">@lang('applicazione.budget_messaggio')</span>
                                                    </div>
                                                </div>
                                                <div class="kt-heading kt-heading--md">
                                                    @lang('Immagini')
                                                     <span class="form-text text-muted">@lang('Se hai immagini per la tua campagna inseriscile qui')</span>
                                                </div>
                                               
                                                <div style="margin-top:50px" class="form-group row">
                                                    <div class="col-xl-4 col-md-4 col-12">
                                                        <div class="slim" data-service-format="file" 
                                                             data-will-request="handleRequest" 
                                                             data-default-input-name="allegato"
                                                             data-meta-allegato ="2"
                                                             @if(isset($campagna) && isset($allegati_v['immagine_2']) && $allegati_v['immagine_2'] != '')
                                                             data-meta-immagine = "{{$allegati_v['immagine_2']}}"
                                                             @endif
                                                             data-force-size="450,450" 
                                                             data-instant-edit="true" 
                                                             data-push="true" 
                                                             data-ratio="1:1" 
                                                             data-service="{{route('frontend.user.immagine')}}" 
                                                             data-did-upload="imageUpload"
                                                             data-did-remove="handleImageRemoval"
                                                             data-size="450,450" 
                                                             data-status-file-size="{{__('applicazione.file_troppo_grande',['mb'=>5])}}"
                                                             data-label="{{__('applicazione.trascina_file')}}"
                                                             data-button-cancel-label="{{__('applicazione.reset')}}"
                                                             data-button-cancel-title="{{__('applicazione.reset')}}"
                                                             data-button-confirm-label="{{__('applicazione.confirm')}}"
                                                             data-button-confirm-title="{{__('applicazione.confirm')}}"
                                                             data-button-remove-label="{{__('applicazione.remove')}}"
                                                             data-button-remove-title="{{__('applicazione.remove')}}"
                                                             data-button-edit-label="{{__('applicazione.edit')}}"
                                                             data-button-edit-title="{{__('applicazione.edit')}}"
                                                             data-button-rotate-title="{{__('applicazione.rotate')}}"
                                                             data-status-upload-success="{{__('applicazione.saved')}}"
                                                             data-max-file-size="5">
                                                            @if(isset($campagna) && isset($allegati_v['immagine_2']) && $allegati_v['immagine_2'] != '')
                                                             @php
                                                             $value_immagine_2 = $allegati_v['immagine_0'];
                                                             @endphp
                                                            <img src="{{asset('storage/'.$allegati_v['immagine_2'])}}" alt=""/> 
                                                            @endif
                                                           <input type="file" name="allegato"/>

                                                        </div>
                                                    </div>
                                                    <input type="hidden" id="immagine_2" value="{{$value_immagine_2}}" name="immagine_2" />
                                                    <div class="col-xl-4 col-md-4 col-12">
                                                        <div class="slim" data-service-format="file" 
                                                             data-will-request="handleRequest" 
                                                             data-default-input-name="allegato" 
                                                             data-meta-allegato ="1"
                                                             @if(isset($campagna) && isset($allegati_v['immagine_1']) && $allegati_v['immagine_1'] != '')
                                                             data-meta-immagine = "{{$allegati_v['immagine_1']}}"
                                                             @endif
                                                             data-force-size="450,450" 
                                                             data-instant-edit="true" 
                                                             data-push="true" 
                                                             data-ratio="1:1" 
                                                             data-service="{{route('frontend.user.immagine')}}" 
                                                             data-did-upload="imageUpload"
                                                             data-did-remove="handleImageRemoval"
                                                             data-size="450,450" 
                                                             data-status-file-size="{{__('applicazione.file_troppo_grande',['mb'=>5])}}"
                                                             data-label="{{__('applicazione.trascina_file')}}"
                                                             data-button-cancel-label="{{__('applicazione.reset')}}"
                                                             data-button-cancel-title="{{__('applicazione.reset')}}"
                                                             data-button-confirm-label="{{__('applicazione.confirm')}}"
                                                             data-button-confirm-title="{{__('applicazione.confirm')}}"
                                                             data-button-remove-label="{{__('applicazione.remove')}}"
                                                             data-button-remove-title="{{__('applicazione.remove')}}"
                                                             data-button-edit-label="{{__('applicazione.edit')}}"
                                                             data-button-edit-title="{{__('applicazione.edit')}}"
                                                             data-button-rotate-title="{{__('applicazione.rotate')}}"
                                                             data-status-upload-success="{{__('applicazione.saved')}}"
                                                             data-max-file-size="5">
                                                            @if(isset($campagna) && isset($allegati_v['immagine_1']) && $allegati_v['immagine_1'] != '')
                                                             @php 
                                                             $value_immagine_1 = $allegati_v['immagine_1'];
                                                             @endphp
                                                            <img src="{{asset('storage/'.$allegati_v['immagine_1'])}}" alt=""/> 
                                                            @endif
                                                           <input type="file" name="allegato"/>

                                                        </div>
                                                    </div>
                                                    <input type="hidden" id="immagine_1" value="{{$value_immagine_1}}" name="immagine_1" />
                                                    <div class="col-xl-4 col-md-4 col-12">
                                                        <div class="slim" data-service-format="file" 
                                                             data-will-request="handleRequest" 
                                                             data-default-input-name="allegato" 
                                                             data-meta-allegato ="0"
                                                             @if(isset($campagna) && isset($allegati_v['immagine_0']) && $allegati_v['immagine_0'] != '')
                                                             data-meta-immagine = "{{$allegati_v['immagine_0']}}"
                                                             @endif
                                                             data-force-size="450,450" 
                                                             data-instant-edit="true" 
                                                             data-push="true" 
                                                             data-ratio="1:1" 
                                                             data-service="{{route('frontend.user.immagine')}}" 
                                                             data-did-upload="imageUpload"
                                                             data-did-remove="handleImageRemoval"
                                                             data-size="450,450" 
                                                             data-status-file-size="{{__('applicazione.file_troppo_grande',['mb'=>5])}}"
                                                             data-label="{{__('applicazione.trascina_file')}}"
                                                             data-button-cancel-label="{{__('applicazione.reset')}}"
                                                             data-button-cancel-title="{{__('applicazione.reset')}}"
                                                             data-button-confirm-label="{{__('applicazione.confirm')}}"
                                                             data-button-confirm-title="{{__('applicazione.confirm')}}"
                                                             data-button-remove-label="{{__('applicazione.remove')}}"
                                                             data-button-remove-title="{{__('applicazione.remove')}}"
                                                             data-button-edit-label="{{__('applicazione.edit')}}"
                                                             data-button-edit-title="{{__('applicazione.edit')}}"
                                                             data-button-rotate-title="{{__('applicazione.rotate')}}"
                                                             data-status-upload-success="{{__('applicazione.saved')}}"
                                                             data-max-file-size="5">
                                                            @if(isset($campagna) && isset($allegati_v['immagine_0']) && $allegati_v['immagine_0'] != '')
                                                            @php $value_immagine_0 = $allegati_v['immagine_0'];
                                                            @endphp
                                                            <img src="{{asset('storage/'.$allegati_v['immagine_0'])}}" alt=""/> 
                                                            @endif
                                                           <input type="file" name="allegato"/>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" value="{{$value_immagine_0}}" id="immagine_0" name="immagine_0" />
                                                </div>
                                                <div class="kt-heading kt-heading--md">
                                                    @lang('Documenti')
                                                    <span class="form-text text-muted">@lang('Inserisci qui eventuali documenti in PDF')</span>
                                                
                                                </div>
                                                
                                                <div style="margin-top:50px" class="form-group row">
                                                    <div class="col-lg-12">
<?php ?>
                                                        @for($i=1 ; $i<=3; $i++)
<?php $found = false; ?>
                                                        @if(isset($allegati))
                                                        @foreach($allegati as $key=>$allegato)
                                                        @if($allegato->posizione == $i)
<?php
$found = true;
return false;
?>
                                                        @endif
                                                        @endforeach
                                                        @endif
                                                        <div class="kt-avatar kt-avatar--outline kt-avatar--circle-" style="margin-right: 50px" id="kt_apps_user_add_avatar_{{$i}}">

                                                            @if(!$found)
                                                            <div class="kt-avatar__holder" id="kt-avatar__holder_{{$i}}" style="overflow: hidden; ">
                                                            </div>

                                                            @else
                                                            @if($allegati[$key]->ext != 'pdf')
                                                            <div class="kt-avatar__holder"  id="kt-avatar__holder_{{$i}}" style="overflow: hidden; background-image: url('{{asset('storage/allegati/'.$allegati[$key]->filename)}}')">

                                                            </div>
                                                            @else
                                                            <div class="kt-avatar__holder" id="kt-avatar__holder_{{$i}}" style="overflow: hidden; background-image: url('{{asset('img/frontend/pdf.jpg')}}')">

                                                            </div>
                                                            @endif

                                                            @endif



                                                            <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="@lang('applicazione.allegato')">
                                                                <i class="fa fa-pen"></i>
                                                                <input type="file" name="allegato" class="profile_avatar" id="allegato_{{$i}}" data-posizione="{{$i}}">
                                                            </label>

                                                            <span class="kt-avatar__cancel" data-id="{{($found) ? $allegati[$key]->id : ''}}" data-posizione="{{$i}}" id="kt-avatar__cancel_{{$i}}" {{($found) ? ' style=display:flex !important ': ''}} data-toggle="kt-tooltip" title="" data-original-title="@lang('applicazione.cancella_allegato')">
                                                                <i class="fa fa-times"></i>
                                                            </span>

                                                            @if($found)
                                                            <input type="hidden" id="h_allegato_{{$i}}" name="h_allegato_{{$i}}" value="{{$allegati[$key]->id}}" /> 
                                                            @endif

                                                        </div>
<?php $found = false; ?>

                                                        @endfor

                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <!--end: Form Wizard Step 4-->

                                <!--begin: Form Actions -->
                                <div class="kt-form__actions">
                                    <div class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"
                                         data-ktwizard-type="action-prev">
                                        @lang('Precedente')
                                    </div>
                                    <div class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"
                                         data-ktwizard-type="action-submit">
                                        @lang('Cerca influencer')
                                    </div>
                                    <div class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"
                                         data-ktwizard-type="action-next">
                                        @lang('Prossimo')
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


        <!--End::Section-->
    </div>
    <!-- end:: Content -->


    @endsection