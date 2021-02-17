@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.register_box_title'))
@push('after-styles')

<link href="css/login-1.css" rel="stylesheet" type="text/css">
<link href="css/c4s.css" rel="stylesheet" type="text/css">
<style>
    label.kt-option {
    cursor: pointer;
    transition: all 0.35s 
}
label.kt-option:hover{
    box-shadow: 1px 1px 20px 1px rgba(0,0,0,0.08);
}
</style>
@endpush
@push('after-scripts')
<script src="{{url('/')}}/js/show-password.min.js" type="text/javascript"></script>
@if($errors->any())
<script>
    document.getElementById('register-form').scrollIntoView(true);
</script>
@endif
@endpush
@section('content')

<div class="kt-grid kt-grid--ver kt-grid--root">
    <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v1" id="kt_login">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile">
        
         

            <!--begin::Aside-->
            <div class="kt-grid__item kt-grid__item--order-tablet-and-mobile-2 kt-grid kt-grid--hor kt-login__aside" style="background:#ea2b38">
                <div class="kt-grid__item">
                    <a href="#" class="kt-login__logo">
                        <img width="366" height="62" src="./assets/media/logos/new/Spidergain-bianco.png">
                    </a>
                </div>
                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver">
                    <div class="kt-grid__item kt-grid__item--middle benvenuto-box">
                        <h1 style="font-size: 40px" class="kt-login__title">Benvenuti in Spidergain</h1>
                        <h4 class="kt-login__subtitle">La rete nella quale tutti possono guadagnare, dal più piccolo al più grande influencer, dall’artigiano alla grande distribuzione</h4>
                    </div>
                </div>
                <div class="kt-grid__item">
                    <div style="font-size: 1.2em" class="kt-login__info">
                        <div class="kt-login__copyright">
                            &copy 2021 SpiderGain
                        </div>
                        <div class="kt-login__menu">
                            <a href="{{route('frontend.privacy')}}" class="kt-link">Privacy</a>
                            <a href="{{route('frontend.termini')}}" class="kt-link">{{__('applicazione.termini')}}</a>
                        </div>
                    </div>
                </div>
            </div>

            <!--begin::Aside-->

            <!--begin::Content-->
            <div class="kt-grid__item kt-grid__item--fluid  kt-grid__item--order-tablet-and-mobile-1  kt-login__wrapper">

                <!--begin::Head-->
                <div class="kt-login__head">
                    <span class="kt-login__signup-label">Hai già un account?</span>&nbsp;&nbsp;
                    <a href="{{route('frontend.auth.login')}}" class="kt-link kt-login__signup-link">Effettua il login</a>
                </div>

                <!--end::Head-->

                <!--begin::Body-->
                <div style="margin-top: 50px" class="kt-login__body">

                    <!--begin::Signin-->
                    <div id="register-form" class="kt-login__form">
                        <div class="kt-login__title">
                            <h1>Crea il tuo Spider Account</h1>
                        </div>
                        @include('includes.partials.messages')
                        <!--begin::Form-->
                        {{ html()->form('POST', route('frontend.auth.register.post'))->class('kt-form')->open() }}
                        <div class="row">
                            <div class="col">
                                <div class="form-group">


                                    {{ html()->text('first_name')
                                        ->class('form-control')
                                        ->placeholder(__('applicazione.nome'))
                                        ->attribute('maxlength', 191)
                                        ->required()}}
                                </div><!--col-->
                            </div><!--row-->
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">


                                    {{ html()->text('last_name')
                                        ->class('form-control')
                                        ->placeholder(__('applicazione.cognome'))
                                        ->attribute('maxlength', 191)
                                        ->required() }}
                                </div><!--form-group-->
                            </div><!--col-->
                            
                            
                        </div><!--row-->

                        <div class="row">
                            <div class="col">
                                <div class="form-group">


                                    {{ html()->email('email')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.email'))
                                        ->attribute('maxlength', 191)
                                        ->required() }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                        <div class="input-group">    
                                <input placeholder="{{__('validation.attributes.frontend.password')}}" type="password" required name="password" id="password" class="form-control" data-toggle="password">   
                                <div style="margin-top: 1.25rem;" class="input-group-append">  
                                    <span style="border: 2px solid #ccc" class="input-group-text">                     
                                        <i class="fa fa-eye"></i>
                                    </span>
                                </div>
                                
                            </div>
                                <span class="text-muted form-text">@lang('auth.password_rules')</span>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                        <div class="input-group">    
                                <input placeholder="{{__('validation.attributes.frontend.password_confirmation')}}" type="password" required name="password_confirmation" id="password_confirmation" class="form-control" data-toggle="password">   
                                <div style="margin-top: 1.25rem;" class="input-group-append">  
                                    <span style="border: 2px solid #ccc" class="input-group-text">                     
                                        <i class="fa fa-eye"></i>
                                    </span>
                                </div>
                                
                            </div>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col">
                                <div style="margin-top:20px" class="form-group">

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label class="kt-option">
                                                <span class="kt-option__control">
                                                    <span
                                                        class="kt-radio kt-radio--check-bold">
                                                        <input type="radio"
                                                               name="register_as"
                                                               value="brand" checked="">
                                                        <span></span>
                                                    </span>
                                                </span>
                                                <span class="kt-option__label">
                                                    <span class="kt-option__head">
                                                        <span
                                                            class="kt-option__title">
                                                            @lang('applicazione.iscrizione_brand')
                                                        </span>
                                                        <span
                                                            class="kt-option__focus">
                                                          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect id="bound" x="0" y="0" width="24" height="24"/>
        <path d="M5.84026576,8 L18.1597342,8 C19.1999115,8 20.0664437,8.79732479 20.1528258,9.83390904 L20.8194924,17.833909 C20.9112219,18.9346631 20.0932459,19.901362 18.9924919,19.9930915 C18.9372479,19.9976952 18.8818364,20 18.8264009,20 L5.1735991,20 C4.0690296,20 3.1735991,19.1045695 3.1735991,18 C3.1735991,17.9445645 3.17590391,17.889153 3.18050758,17.833909 L3.84717425,9.83390904 C3.93355627,8.79732479 4.80008849,8 5.84026576,8 Z M10.5,10 C10.2238576,10 10,10.2238576 10,10.5 L10,11.5 C10,11.7761424 10.2238576,12 10.5,12 L13.5,12 C13.7761424,12 14,11.7761424 14,11.5 L14,10.5 C14,10.2238576 13.7761424,10 13.5,10 L10.5,10 Z" id="Combined-Shape" fill="#000000"/>
        <path d="M10,8 L8,8 L8,7 C8,5.34314575 9.34314575,4 11,4 L13,4 C14.6568542,4 16,5.34314575 16,7 L16,8 L14,8 L14,7 C14,6.44771525 13.5522847,6 13,6 L11,6 C10.4477153,6 10,6.44771525 10,7 L10,8 Z" id="Path-53" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
    </g>
</svg>
                                                        </span>
                                                    </span>
                                                    <span class="kt-option__body">
                                                        @lang('applicazione.iscrizione_brand_descrizione')
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                        <div class="col-lg-12">
                                            <label class="kt-option">
                                                <span class="kt-option__control">
                                                    <span
                                                        class="kt-radio kt-radio--check-bold">
                                                        <input type="radio"
                                                               name="register_as"
                                                               value="influencer">
                                                        <span></span>
                                                    </span>
                                                </span>
                                                <span class="kt-option__label">
                                                    <span class="kt-option__head">
                                                        <span
                                                            class="kt-option__title">
                                                            @lang('applicazione.iscrizione_influencer')
                                                        </span>
                                                        <span
                                                            class="kt-option__focus">
                                                          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon id="Shape" points="0 0 24 0 24 24 0 24"/>
        <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" id="Mask" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
        <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" id="Mask-Copy" fill="#000000" fill-rule="nonzero"/>
    </g>
</svg>
                                                        </span>
                                                    </span>
                                                    <span class="kt-option__body">
                                                       @lang('applicazione.iscrizione_influencer_descrizione')
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                    </div>

                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->
{!! $captcha !!}
                        @if(config('access.captcha.registration'))
                        <div class="row">
                            <div class="col capt">
                                @captcha
                                {{ html()->hidden('captcha_status', 'true') }}
                            </div><!--col-->
                        </div><!--row-->
                        @endif

                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-0 clearfix">
                                    <div class="kt-login__actions">
                                    {{ form_submit(__('labels.frontend.auth.register_button'))->class('btn btn-primary btn-block btn-elevate register kt-login__btn-primary') }}
                                    </div>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-0 clearfix">
                                <p style="font-size: 0.85em" class="text-muted text-black text-small">Cliccando su registrati accetti le nostre <a href="{{route('frontend.termini')}}">note legali</a>, la nostra policy sulla <a target="_blank" href="{{route('frontend.privacy')}}">privacy</a> e la nostra policy sui <a href="{{route('frontend.cookie')}}">Cookie</a></p>
                                </div>
                                </div>
                        </div>
                        {{ html()->form()->close() }}
                        
                        <!--end::Form-->
<!--
                        begin::Divider
                        <div class="kt-login__divider">
                            <div class="kt-divider">
                                <span></span>
                                <span>o</span>
                                <span></span>
                            </div>
                        </div>

                        end::Divider

                        begin::Options
                        <div class="kt-login__options">
                            <a href="#" class="btn btn-primary kt-btn">
                                <i class="fab fa-facebook-f"></i>
                                Facebook
                            </a>
                            <a href="#" class="btn btn-info kt-btn">
                                <i class="fab fa-twitter"></i>
                                Twitter
                            </a>
                            <a href="#" class="btn btn-danger kt-btn">
                                <i class="fab fa-google"></i>
                                Google
                            </a>
                        </div>-->

                        <!--end::Options-->
                    </div>

                    <!--end::Signin-->
                </div>

                <!--end::Body-->
            </div>

            <!--end::Content-->
        </div>
    </div>
</div>



@endsection

@push('after-scripts')
@if(config('access.captcha.registration'))
@captchaScripts
@endif
@endpush
