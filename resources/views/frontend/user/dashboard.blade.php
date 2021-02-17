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


<br><br>






















































{{--
            <div class="col-xl-4">
                 <div class="kt-portlet kt-iconbox kt-iconbox--warning">

                                <div class="kt-portlet__body">

                                    <div class="kt-iconbox__body">

                                        <div class="kt-iconbox__icon">

                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">

                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">

                                            <polygon id="Shape" points="0 0 24 0 24 24 0 24"></polygon>

                                            <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" id="Mask" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>

                                            <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" id="Mask-Copy" fill="#000000" fill-rule="nonzero"></path>

                                            </g>

                                            </svg> </div>
      
      
                                            

@if(Auth::user()->hasRole('brand'))
                                        <div class="kt-iconbox__desc">

                                            <h3 class="kt-iconbox__title">



                                                <a href="{{route('frontend.user.brand.get',Auth::user()->uuid)}}" class="kt-link" href="#">Il tuo profilo</a>
                                                

                                            </h3>

                                            <div class="kt-iconbox__content">

                                                Guarda o modifica le tue informazioni

                                            </div>

                                        </div>
@endif
@if(Auth::user()->hasRole('influencer'))
<div class="kt-iconbox__desc">

                                            <h3 class="kt-iconbox__title">



                                                <a href="{{route('frontend.user.influencer.get',Auth::user()->uuid)}}" class="kt-link" href="#">Il tuo profilo</a>
                                                

                                            </h3>

                                            <div class="kt-iconbox__content">

                                                Guarda o modifica le tue informazioni

                                            </div>

                                        </div>
@endif

                                    </div>

                                </div>

                            </div>

                            <div class="kt-portlet kt-iconbox kt-iconbox--brand">

                                <div class="kt-portlet__body">

                                    <div class="kt-iconbox__body">

                                        <div class="kt-iconbox__icon">

                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">

                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">

                                            <rect id="bound" x="0" y="0" width="24" height="24"></rect>

                                            <path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" id="Combined-Shape" fill="#000000" opacity="0.3"></path>

                                            <path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" id="Combined-Shape" fill="#000000"></path>

                                            </g>

                                            </svg> </div>

                                        <div class="kt-iconbox__desc">

                                            <h3 class="kt-iconbox__title">

                                                <a class="kt-link" href="{{url('/')}}/campagne/aperte">Le tue Campagne</a>

                                            </h3>

                                            <div class="kt-iconbox__content">

                                                Vai alle tue campagne aperte

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="kt-portlet kt-iconbox kt-iconbox--success">

                                <div class="kt-portlet__body">

                                    <div class="kt-iconbox__body">

                                        <div class="kt-iconbox__icon">

                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">

                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">

                                            <rect id="bound" x="0" y="0" width="24" height="24"></rect>

                                            <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" id="Combined-Shape" fill="#000000" opacity="0.3"></path>

                                            <path d="M10.875,15.75 C10.6354167,15.75 10.3958333,15.6541667 10.2041667,15.4625 L8.2875,13.5458333 C7.90416667,13.1625 7.90416667,12.5875 8.2875,12.2041667 C8.67083333,11.8208333 9.29375,11.8208333 9.62916667,12.2041667 L10.875,13.45 L14.0375,10.2875 C14.4208333,9.90416667 14.9958333,9.90416667 15.3791667,10.2875 C15.7625,10.6708333 15.7625,11.2458333 15.3791667,11.6291667 L11.5458333,15.4625 C11.3541667,15.6541667 11.1145833,15.75 10.875,15.75 Z" id="check-path" fill="#000000"></path>

                                            <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" id="Combined-Shape" fill="#000000"></path>

                                            </g>

                                            </svg> </div>

                                        <div class="kt-iconbox__desc">

                                            <h3 class="kt-iconbox__title">

                                                <a class="kt-link" href="{{url('/')}}/tutorial">Tutorials</a>

                                            </h3>

                                            <div class="kt-iconbox__content">

                                                Guarda dei brevi video introduttivi sulle funzionalità di SpiderGain

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>
            </div>
        </div>



       

    </div>

--}}






@endsection