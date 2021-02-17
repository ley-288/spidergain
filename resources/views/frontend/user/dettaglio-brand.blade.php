{{--@extends('frontend.layouts.interna')

<style>

@media screen and (max-width: 1024px) {
	
	#prof_loc{
		margin-top:0px;
		max-width:130px;
	}
	
	
    
}

@media screen and (min-width: 1024px) {
	
	#prof_loc{
		margin-top:-15px;
		max-width:150px;
	}
	
	
    
}

</style>


@section('content')

<div class="kt-holder kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

    <!-- begin:: Subheader -->

    <div class="kt-subheader   kt-grid__item" id="kt_subheader">



    </div>



    <!-- begin:: Content -->

    <div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">



        @include('includes.partials.messages')



        <div class="row">

            <div class="col-xl-12">



                <!--begin:: Widgets/Applications/User/Profile3-->

                <div class="kt-portlet kt-portlet--height-fluid">
                
                	

                    <div class="kt-portlet__body">

                        <div class="kt-widget kt-widget--user-profile-3">

                            <div class="kt-widget__top">

                                @if($user->avatar_location != '')

                                <div class="kt-widget__media kt-hidden-">

                                   <img style="border:3px solid white;" id="prof_loc" src="{{asset('storage/'.$user->avatar_location)}}" alt="image">

                                </div>

                                @else

                               <div class="kt-widget3__user-img">
                                            <img style="border:3px solid white;" id="prof_loc" class="kt-widget__img kt-hidden-" src="{{asset('assets/media/icons/definitive_s.png')}}" alt="Immagine profilo">

                                   {{$user->first_name[0].$user->last_name[0]}}

                                </div>

                                @endif

                                <div class="kt-widget__content">

                                    <div class="kt-widget__head">

                                       <a href="#" class="kt-widget__username">

                                            {{$user->first_name.' '.$user->last_name}}

                                            <span class="kt-badge kt-badge--success kt-badge--inline">@lang('Aziendale')</span>

                                            - {{$user->dettagli->ragione_sociale}}

                                        </a>

                                       

                                        <div class="kt-widget__action">

                                           

                                        </div>

                                    </div>

                                   <div style="word-break: break-word" class="kt-widget__subhead">

                                        @if(isset($user->dettagli->azienda_email))

                                        <a href="#"><i class="flaticon2-new-email"></i>{{$user->dettagli->azienda_email}}</a>

                                        @endif

                                        @if(isset($user->dettagli->telefono))

                                        <a href="#"><i class="flaticon2-phone"></i>{{$user->dettagli->telefono}}</a>

                                        @endif

                                    </div>

                                   <div class="kt-widget__info">

                                        <div class="kt-widget__desc">

                                            <strong>{{$user->dettagli->ragione_sociale}}</strong> - {{$user->dettagli->azienda_citta.' - '.$user->dettagli->azienda_via.', '.$user->dettagli->azienda_numero_civico}}

                                        </div>
                                        @if($user->dettagli->descrizione)
                                        <div class="kt-widget__desc">

                                            {!! clean($user->dettagli->descrizione) !!}

                                        </div>
                                        @endif
                                    </div>

                                </div> 

                            </div> 

                            <div class="kt-widget__bottom">

                                 @if($user->dettagli->blog)

                                <div class="kt-widget__item">

                                  

                                    <div class="kt-widget__icon">

                                        <a href="{{$user->dettagli->blog}}" target="_blank">

                                        <i class="fa fa-globe"></i>

                                        </a>

                                    </div>

                                    <div class="kt-widget__details">

                                        <span class="kt-widget__title">@lang('Sito Web')</span>

                                         <a href="{{$user->dettagli->blog}}" target="_blank">

                                        <span class="kt-widget__value">@lang('Vai alla pagina')</span>

                                         </a>

                                    </div>

                                    </a>

                                </div>

                                @endif

                                @if($user->dettagli->facebook)

                                <div class="kt-widget__item">

                                  

                                    <div class="kt-widget__icon">

                                        <a href="{{$user->dettagli->facebook}}" target="_blank">

                                        <i class="fab fa-facebook"></i>

                                        </a>

                                    </div>

                                    <div class="kt-widget__details">

                                        <span class="kt-widget__title">Facebook</span>

                                         <a href="{{$user->dettagli->facebook}}" target="_blank">

                                        <span class="kt-widget__value">@lang('Vai alla pagina')</span>

                                         </a>

                                    </div>

                                    </a>

                                </div>

                                @endif

                                @if($user->dettagli->instagram)

                                <div class="kt-widget__item">

                                  

                                    <div class="kt-widget__icon">

                                        <a href="{{$user->dettagli->instagram}}" target="_blank">

                                        <i class="fab fa-instagram"></i>

                                        </a>

                                    </div>

                                    <div class="kt-widget__details">

                                        <span class="kt-widget__title">Instagram</span>

                                         <a href="{{$user->dettagli->instagram}}" target="_blank">

                                        <span class="kt-widget__value">@lang('Vai alla pagina')</span>

                                         </a>

                                    </div>

                                    </a>

                                </div>

                                @endif

                                @if($user->dettagli->twitter)

                                <div class="kt-widget__item">

                                  

                                    <div class="kt-widget__icon">

                                        <a href="{{$user->dettagli->twitter}}" target="_blank">

                                        <i class="fab fa-twitter"></i>

                                        </a>

                                    </div>

                                    <div class="kt-widget__details">

                                        <span class="kt-widget__title">Twitter</span>

                                        <a href="{{$user->dettagli->twitter}}" target="_blank">

                                        <span class="kt-widget__value">@lang('Vai alla pagina')</span>

                                        </a>

                                    </div>

                                    </a>

                                </div>

                                @endif

                                 @if($user->dettagli->youtube)

                                <div class="kt-widget__item">

                                  

                                    <div class="kt-widget__icon">

                                        <a href="{{$user->dettagli->youtube}}" target="_blank">

                                        <i class="fab fa-youtube"></i>

                                        </a>

                                    </div>

                                    <div class="kt-widget__details">

                                        <span class="kt-widget__title">YouTube</span>

                                          <a href="{{$user->dettagli->youtube}}" target="_blank">

                                        <span class="kt-widget__value">@lang('Vai alla pagina')</span>

                                          </a>

                                    </div>

                                    </a>

                                </div>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>



                <!--end:: Widgets/Applications/User/Profile3-->

            </div>

        </div>

    </div>

        @endsection--}}
        



























@extends('frontend.layouts.interna')

{{--@section('title', app_name() . ' | ' . __('applicazione.profilo_influencer'))--}}

@section('content')
{{--@push('after-styles')


@endpush

@push('after-scripts')

@endpush--}}

<div class="kt-holder kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- begin:: Subheader -->
  

       
              
              
<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
        
        <div class="row">
            <div class="col-xl-12" >
                <div class="kt-portlet kt-portlet--height-fluid-" style="background-image:url({{url('assets/media/bluebg.png')}}); background-repeat:no-repeat;position:relative; background-size:150% 200px;">
                    <div class="kt-portlet__head kt-portlet__head--noborder">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                            </h3>
                        </div>

                    </div>
                    <div class="kt-portlet__body">

                        <!--begin::Widget -->
                        <div class="kt-widget kt-widget--user-profile-2">
                            <div class="kt-widget__head">
                                <div class="kt-widget__media">
                                    <div class="kt-widget3__user-img">
                                        @if($user->avatar_location != '')
                                        <img style="max-width:150px; border:3px solid white;margin-top:-15px;" class="kt-widget__img kt-hidden-" src="{{asset('storage/'.$user->avatar_location)}}" alt="Immagine profilo">
                                            @else
                                            <div class="kt-widget3__user-img">
                                            <img style="max-width:150px; border:3px solid white;margin-top:-15px;" class="kt-widget__img kt-hidden-" src="{{asset('assets/media/icons/definitive_s.png')}}" alt="Immagine profilo">
                                                {{--{{$user->first_name[0]}} {{$user->last_name[0]}}--}}
                                            
                                            </div>
                                            @endif
                                    </div>
                                </div>
                                <div class="kt-widget__info">
                                    <a href="#" class="kt-widget__username" style="color:white;">
                                        {{$user->dettagli->ragione_sociale}}
                                    </a>
                                    {{--<span class="kt-widget__desc" style="color:white;">--}}
                                        <span class="kt-badge kt-badge--success kt-badge--inline">@lang('Aziendale')</span>
                                    </span>
                                    
                                </div>
                            </div>
                            </br></br></br>
                            <div class="kt-widget__body">
                                <div class="kt-widget__section">
                                    {!! clean($user->dettagli->descrizione) !!}
                                    @if(!empty($user->dettagli->comuni))
                                    <p>
                                        @foreach($user->dettagli->comuni as $comune)
                                         <span class="badge badge-sm badge-light" style="background-color:transparent;"><i class="fa fa-map-marker-alt" style="color:#5979FB;"></i> {{$comune->nome}}</span>
                                        @endforeach
                                    </p>
                                    @endif
                                </div>
                                </br>
                                @include('frontend.influencer.canali')

                                
                            </div>
                       	</div>
                        <div class="kt-widget__icon">

                                        <a href="{{$user->dettagli->blog}}" target="_blank">

                                        <i class="fa fa-globe"></i>

                                        </a>

                                    </div>
                                     <div class="kt-widget__details">

                                        

                                         <a href="{{$user->dettagli->blog}}" target="_blank">

                                        <span class="kt-widget__value">@lang('Vai alla pagina')</span>

                                         </a>

                                    </div>
                        

                        <!--end::Widget -->

                        <!--begin::Navigation -->


                        <!--end::Navigation -->
                    </div>
                </div>
              </div>
              
      
              
             
                               

              
                              

       


        </div>


    </div>

    @endsection
        
        
        
        
        
