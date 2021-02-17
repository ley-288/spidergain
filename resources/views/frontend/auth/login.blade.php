@extends('frontend.layouts.app')



@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@push('after-styles')

<link href="css/login-1.css" rel="stylesheet" type="text/css">

<link href="css/c4s.css?v=1" rel="stylesheet" type="text/css">


@endpush

@push('after-scripts')

<script src="{{url('/')}}/js/show-password.min.js" type="text/javascript"></script>
@if($errors->any())
<script>
    document.getElementById('login-form').scrollIntoView(true);
</script>
@endif

@endpush

@section('content')

<div class="kt-grid kt-grid--ver kt-grid--root" >

    <div class="kt-grid kt-grid--hor kt-grid--root kt-login kt-login--v1" id="kt_login">

        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile">



            <!--begin::Aside-->

            <div class="kt-grid__item kt-grid__item--order-tablet-and-mobile-2 kt-grid kt-grid--hor kt-login__aside" style="background:#ea2b38">

                <div class="kt-grid__item">

                    <a href="#" class="kt-login__logo">

                        <img width="366" height="62" src="./assets/media/logos/new/Spidergain-bianco.png">

                    </a>

                </div>

                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver">

                    <div class="kt-grid__item kt-grid__item--middle">

                        <h1 style="font-size: 40px" class="kt-login__title">Benvenuti in Spidergain</h1>

                        <h4 class="kt-login__subtitle">La rete nella quale tutti possono guadagnare, dal più piccolo al più grande influencer, dall’artigiano alla grande distribuzione</h4>

                    </div>

                </div>

                <div class="kt-grid__item">

                    <div style="font-size: 1.2em"  class="kt-login__info">

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

            <div class="kt-grid__item kt-grid__item--fluid  kt-grid__item--order-tablet-and-mobile-1  kt-login__wrapper" >



                <!--begin::Head-->

                



                <!--end::Head-->



                <!--begin::Body-->

                <div style="margin-top:50px" class="kt-login__body">



                    <!--begin::Signin-->

                    <div class="kt-login__form">

                        <div id="login-form" class="kt-login__title">

                            <h1>Effettua il log-in!</h1>

                        </div>

                        @include('includes.partials.messages')



                        {{ html()->form('POST', route('frontend.auth.login.post'))->class('kt-form')->open() }}

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

                                    <!-- {{ html()->label(__('validation.attributes.frontend.password'))->for('password') }}-->

                                <div class="input-group">    
                                <input placeholder="{{__('validation.attributes.frontend.password')}}" type="password" required name="password" id="password" class="form-control" data-toggle="password">   
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

                                <div class="form-group">

                                    <div style="margin-top:20px" class="checkbox">



                                        <label class="kt-checkbox kt-checkbox--bold kt-checkbox--brand">

                                            <input type="checkbox" name="remember"> @lang('labels.frontend.auth.remember_me')

                                            <span></span>

                                        </label>

                                    </div>

                                </div><!--form-group-->

                            </div><!--col-->

                        </div><!--row-->



                        <div class="row">

                            <div class="col">

                                <div class="form-group clearfix">

                                    <div class="kt-login__actions">

                                        <a class="kt-link kt-login__link-forgot" href="{{ route('frontend.auth.password.reset') }}">@lang('labels.frontend.passwords.forgot_password')</a>



                                        {{ form_submit(__('labels.frontend.auth.login_button'))->class('btn btn-primary btn-elevate kt-login__btn-primary')->id('kt_login_signin_submit') }}

                                    </div>



                                </div><!--form-group-->

                            </div><!--col-->

                        </div><!--row-->



                        <div class="row">

                            <div class="col">

                                <div class="form-group text-right">



                                </div><!--form-group-->

                            </div><!--col-->

                        </div><!--row-->

                        {{ html()->form()->close() }}



                        <!--end::Form-->




                        <!--begin::Divider-->

                       <div class="kt-login__divider">

                            <div class="kt-divider">

                                <span></span>

                                <span>o</span>

                                <span></span>

                            </div>

                        </div>






                     

<!-- 

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

                        <div class="row">

                        <div class="col text-center">

                            <h2>@lang('applicazione.registrati')</h2>

                            <p class="text-justify">@lang('applicazione.descrizione_registrati')</p>

                            <a class="btn btn-lg btn-danger text-uppercase font-weight-bold " style="background-color:#ea2b38;" href="register">@lang('applicazione.registrati_ora')</a>

                        </div>

                    </div>

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





@endpush

