@extends('frontend.layouts.interna')

@section('content')

<div class="kt-holder kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

    <!-- begin:: Subheader -->

    <div class="kt-subheader   kt-grid__item" id="kt_subheader"></div>

    <!-- begin:: Content -->

    <div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">

        @include('includes.partials.messages')
        @role('brand')
        <div class="row">
            <div class="col-xl-4">
                <div class="kt-portlet kt-portlet--solid-dark kt-portlet--height-fluid">


                    <div style="margin-top:20px" class="kt-portlet__body">

                        <div class="kt-portlet__content">

                            <a href="{{route('frontend.user.campagne.crea')}}" style="background: #E03342; color: #fff" class="btn btn-lg btn-block">{{__('applicazione.nuova_campagna')}}</a>

                        </div>

                    </div>

                </div>
            </div>
        </div>
        @endrole
        <div class="row d-flex justify-content-start">
            
                @if(isset($_GET['res']) && Auth::user()->hasRole('influencer'))
            <div class="col-xl-4">
                <div class="kt-portlet kt-portlet--skin-solid kt-portlet-- kt-bg-success">

                    <div class="kt-portlet__head">

                        <div class="kt-portlet__head-label">

                            <span class="kt-portlet__head-icon">

                                <i class="flaticon2-checkmark"></i>

                            </span>

                            <h3 class="kt-portlet__head-title">

                                @lang('applicazione.pronto')

                            </h3>

                        </div>

                    </div>

                    <div class="kt-portlet__body">

                        @lang('applicazione.pronto_testo_1')

                        @lang('applicazione.pronto_testo_2')

                        @lang('applicazione.pronto_testo_3')

                    </div>

                </div>
            </div>
                @endif
                @if(isset($_GET['res']) && Auth::user()->hasRole('brand'))
                <div class="col-xl-4">
                <div class="kt-portlet kt-portlet--skin-solid kt-portlet-- kt-bg-success">

                    <div class="kt-portlet__head">

                        <div class="kt-portlet__head-label">

                            <span class="kt-portlet__head-icon">

                                <i class="flaticon2-checkmark"></i>

                            </span>

                            <h3 class="kt-portlet__head-title">

                                @lang('applicazione.pronto')

                            </h3>

                        </div>

                    </div>

                    <div class="kt-portlet__body">

                        @lang('applicazione.pronto_testo_brand')

                    </div>

                </div>
                </div>
                @endif
                @role('brand')
                @include('frontend.user.lista_offerte')
                @endrole

            
             
            
            <div class="col-xl-4">
                @role('influencer')
                 @if($richieste > 0)
                    <div class="alert alert-success" role="alert">
                        <div class="alert-text">
                            {{__('applicazione.nuove_richieste',['numero' => $richieste])}}
                            <a class="btn btn-small btn-brand" href="{{Route('frontend.user.campagne.richieste')}}">@lang('Vai')</a>
                        </div>
                    </div>
                    @endif
                   @endrole
                @include('frontend.user.lista_messaggi')
            </div>







@endsection