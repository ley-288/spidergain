<style>
@media screen and (max-width: 1024px) {

	#kt_aside_mobile_toggler{
	display: none;
	}
	
	#kt_header{
	display:none;
	}
    
}

#sub-item{

	height:28px;
	
	
}

#ico{
	margin-top:-6px;
}

#ico_web{
	color:#B0ABC2;
}

#para_men{
	margin-left: 20px;
	margin-top: -3px;
}

#ico_head{
	margin-right:15px;
	margin-top: 7px;
}

</style>



<!-- begin:: Header Mobile -->


<div style="background-color:#e72b38; border-top: 3px solid #e72b38;" id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed">
    <div class="kt-header-mobile__logo">
    @if(Auth::user()->hasRole('influencer'))
        <a href="{{url('/cerca-campagne')}}">
            <img alt="Logo" width="240px" src="{{url('/')}}/assets/media/logos/new/Spidergain-bianco.png" />
        </a>
        @endif
        @if(Auth::user()->hasRole('brand'))
        <a href="{{url('/')}}">
            <img alt="Logo" width="240px" src="{{url('/')}}/assets/media/logos/new/Spidergain-bianco.png" />
        </a>
        @endif 
    </div>
 
    <div class="kt-header-mobile__toolbar">
        <button class="kt-header-mobile__toolbar-toggler kt-header-mobile__toolbar-toggler--left" style="margin-right:20px;" id="kt_aside_mobile_toggler">		   
        <span></span></button>

        <a href="{{url('/')}}/dashboard" class="kt-menu__link kt-menu__toggle">
                    <i class="material-icons nav__icon" style="color:white;" id="ico_head">message</i>
                        <span class="kt-menu__link-icon"> </span>

        <div class="dropdown">
        
        	@if(Auth::user()->avatar_location != '')
                                
                                
                                <a class="dropdown-toggle" href="#" role="#" id="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:white;">
    <img alt="Pic" src="{{asset('storage/'.Auth::user()->avatar_location)}}" style="height:30px;width:30px;border:1px solid white; border-radius:20px;" />
  </a>
  
                @else
                                <a class="dropdown-toggle" href="#" role="#" id="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:white;">
    <img alt="Pic" src="{{asset('assets/media/icons/definitive_s.png')}}" style="height:30px;width:30px;border:1px solid white; border-radius:20px;" />
  </a>
                @endif
        
  
	
	
		@if(Auth::user()->hasRole('influencer'))
  <div class="dropdown-menu scrollable-menu" style="position:fixed; width:300px; z-index: 214748365;" aria-labelledby="dropdownMenuLink">
  
 {{--
   <a class="dropdown-item" id="sub-item" href="{{route('frontend.user.crediti')}}" ><img alt="Logo" src="{{url('/')}}/assets/media/icons/credits.png" />Crediti:{{$budget}}</a>
    <hr>   
--}}

   <a class="dropdown-item" id="sub-item" href="{{route('frontend.user.campagne.aperte.index')}}"><i class="material-icons nav__icon"id="ico">explore</i><p id="para_men">Le Mie Campagne</p></a>
   <hr>
   <a class="dropdown-item" id="sub-item" href="{{route('frontend.user.influencer.get',Auth::user()->uuid)}}"> <i class="material-icons nav__icon" id="ico">account_circle</i><p id="para_men">Il mio Profilo</p></a>
   <hr>
    <a class="dropdown-item" id="sub-item" href="{{url('/')}}/campagne/chiuse"><i class="material-icons nav__icon" id="ico">check_circle_outline</i><p id="para_men">Campagne Concluse</p></a>
   <hr>
   <a class="dropdown-item" id="sub-item" href="{{url('/')}}/profilo/completa/modifica"><i class="material-icons nav__icon" id="ico">create</i><p id="para_men">Modifica Profilo</p></a>
   <hr>
   <a class="dropdown-item" id="sub-item" href="{{url('/')}}/account"><i class="material-icons nav__icon"id="ico">construction</i><p id="para_men">Impostazioni Account</p></a>
   <hr>
   <a class="dropdown-item" id="sub-item" href="{{url('/')}}/faq"><i class="material-icons nav__icon" id="ico">help</i><p id="para_men">FAQ</p></a>
   <hr>
   <a class="dropdown-item" id="sub-item" href="{{url('/')}}/come-funziona"><i class="material-icons nav__icon" id="ico">psychology</i><p id="para_men">Come Funziona</p></a>
   <hr>
   <a class="dropdown-item" id="sub-item" href="{{route('frontend.privacy')}}"><i class="material-icons nav__icon" id="ico">privacy_tip</i><p id="para_men">Privacy</p></a>
   <hr>
  <a class="dropdown-item" id="sub-item" href="{{route('frontend.termini')}}"><i class="material-icons nav__icon" id="ico">public</i><p id="para_men">Termi e Condizioni</p></a>
   <hr>
   <a class="dropdown-item" id="sub-item" href="{{url('/')}}/logout" style="color:red;">Esci</a>                               
        	@endif
        
        
        	@if(Auth::user()->hasRole('brand'))
  <div class="dropdown-menu scrollable-menu" style="position:fixed; width:300px; z-index: 214748365;" aria-labelledby="dropdownMenuLink">
   <a class="dropdown-item" id="sub-item" href="{{route('frontend.user.campagne.aperte.index')}}"><i class="material-icons nav__icon" id="ico">explore</i><p id="para_men">Le Mie Campagne</p></a>
   <hr>
   <a class="dropdown-item" id="sub-item" href="{{route('frontend.user.brand.get',Auth::user()->uuid)}}"><i class="material-icons nav__icon" id="ico">account_circle</i><p id="para_men">Profilo azienda</p></a>
   <hr>
    <a class="dropdown-item" id="sub-item" href="{{url('/')}}/campagne/chiuse"><i class="material-icons nav__icon" id="ico">check_circle_outline</i><p id="para_men">Campagne Concluse</p></a>
   <hr>
   <a class="dropdown-item" id="sub-item" href="{{url('/')}}/profilo/brand/modifica"><i class="material-icons nav__icon" id="ico">create</i><p id="para_men">Modifica dettagli dell azienda</p></a>
   <hr>
   <a class="dropdown-item" id="sub-item" href="{{url('/')}}/account"><i class="material-icons nav__icon"id="ico">construction</i><p id="para_men">Impostazioni Account</p></a>
   <hr>
   <a class="dropdown-item" id="sub-item" href="{{url('/')}}/faq"><i class="material-icons nav__icon" id="ico">help</i><p id="para_men">FAQ</p></a>
   <hr>
   <a class="dropdown-item" id="sub-item" href="{{url('/')}}/come-funziona"><i class="material-icons nav__icon" id="ico">psychology</i><p id="para_men">Come Funziona</p></a>
   <hr>
   <a class="dropdown-item" id="sub-item" href="{{route('frontend.privacy')}}"><i class="material-icons nav__icon" id="ico">privacy_tip</i><p id="para_men">Privacy</p></a>
   <hr>
  <a class="dropdown-item" id="sub-item" href="{{route('frontend.termini')}}"><i class="material-icons nav__icon" id="ico">public</i><p id="para_men">Termi e Condizioni</p></a>
     <hr>         
     <a class="dropdown-item" id="sub-item" href="{{url('/')}}/logout" style="color:red;">Esci</a>                                      
        	@endif
    
    
    
  </div>
</div>
        
       
    </div>
</div>

<!-- end:: Header Mobile -->








<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

            <!-- begin:: Header -->
            <div style="background-color:#e72b38; border-top: 3px solid #e72b38;"id="kt_header" class="kt-header kt-grid__item  kt-header--fixed data-kt-header-minimize=on">
                <div class="kt-container">

                    <!-- begin:: Brand -->
                    <div class="kt-header__brand " id="kt_header_brand">
                        <div class="kt-header__brand-logo">
                        @if(Auth::user()->hasRole('influencer'))
                            <a href="{{url('/')}}/cerca-campagne">
                                <img alt="Logo" width="300" src="{{url('/')}}/assets/media/logos/new/Spidergain-bianco.png" />
                            </a>
                        @endif
                        @if(Auth::user()->hasRole('brand'))
                            <a href="{{url('/')}}/dashboard">
                                <img alt="Logo" width="300" src="{{url('/')}}/assets/media/logos/new/Spidergain-bianco.png" />
                            </a>
                        @endif
                        </div>
                        
                        @if(Auth::user()->hasRole('brand'))
                        <div class="kt-header__brand-nav">
                            <a href="{{url('/')}}/campagne/crea" class="btn btn-brand"> Nuova campagna
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--warning">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect id="bound" x="0" y="0" width="24" height="24"/>
                                        <circle id="Oval-5" fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                        <path d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z" id="Combined-Shape" fill="#000000"/>
                                    </g>
                                </svg>
                            </a>
                        </div>
                        {{--@else
                        <div class="kt-header__brand-nav">
                            <a href="{{route('frontend.user.crediti')}}" class="btn btn-success"> {{__('applicazione.tuoi_crediti')}}: <span class="kt-badge kt-badge--rounded kt-badge--brand">{{$budget}}</span> 
                            </a>
                        </div>--}}
                        @endif
                    </div>

                    <!-- end:: Brand -->

                    <!-- begin:: Header Topbar -->
                    <div class="kt-header__topbar">

 				

                        <!--begin: User bar -->
                        <div class="kt-header__topbar-item kt-header__topbar-item--user">
                            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                            
                           
                            
                  
                          
                            
                       	
                            	
	
                                <span class="kt-header__topbar-username kt-visible-desktop" style="padding-right:15px; font-size: 16px;">
                                
                                 
                                
                                {{Auth::user()->first_name}} {{Auth::user()->last_name}} ▽   </span>
                                @if(Auth::user()->avatar_location != '')
                                <img alt="Pic" src="{{asset('storage/'.Auth::user()->avatar_location)}}" style="border:1px solid white; height:40px; width:40px; border-radius:25px;" />
                                @else
                                <img alt="Pic" src="{{asset('assets/media/icons/definitive_s.png')}}" style="border:1px solid white; height:50px; width:50px; border-radius:25px;" />
                                </span>
                                @endif
                                
                                
                               {{--
                                <a href="{{route('frontend.user.dashboard')}}">
                                <img alt="Pic" src="{{url('/')}}/assets/media/icons/message.png" style="border:1px solid white; height:40px;width:40px;border-radius:20px;"/>
                                </a>
                                --}}
                                
                                
                            </div>
                            
                           
                            
                            
                            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">

                                <!--begin: Head -->
                                
                                <div class="kt-user-card kt-user-card--skin-light kt-notification-item-padding-x">
                                    <div class="kt-user-card__avatar">
                                        @if(Auth::user()->avatar_location != '')
                                        <img style="max-width:70px; border:1px solid white; border-radius:50px;" class="kt-hidden-" alt="Pic" src="{{asset('storage/'.Auth::user()->avatar_location)}}" />
                                        @else
                                        <!--use below badge element instead the user avatar to display usernames first letter(remove kt-hidden class to display it) -->
                                        <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold kt-hidden">{{Auth::user()->first_name[0]}}</span>
                                        @endif
                                    </div>
                                    <div class="kt-user-card__name">
                                        {{Auth::user()->first_name}} {{Auth::user()->last_name}}
                                    </div>
                                </div>

                                <!--end: Head -->





                                <!--begin: Navigation -->
                                
                                
                                <div class="kt-notification">
                                
                               
@if(Auth::user()->hasRole('influencer'))
{{--
<a href="{{route('frontend.user.crediti')}}" class="kt-notification__item">
 <div class="kt-notification__item-icon">
                                           <img alt="Logo" width="20px" margin-left"10px" src="{{url('/')}}/assets/media/icons/credits.png" />
                                        </div>
                                        <div class="kt-notification__item-details">
                                            <div class="kt-notification__item-title kt-font-bold">
                                               I tuoi Crediti:  
                            <span class="kt-badge kt-badge--rounded kt-badge--success">{{$budget}}
                            </span>
                                            </div>
                                            <div class="kt-notification__item-time">
                                                
                                            </div>
                                        </div>
                                    </a>
                                    --}}
                                    @endif
                                    
                                    
                                    <a href="{{route('frontend.user.campagne.aperte.index')}}" class="kt-notification__item">
                                        <div class="kt-notification__item-icon">
<i class="material-icons nav__icon" id="ico_web">explore</i>
                                            {{--<i class="flaticon2-rocket-1 kt-font-danger"></i>--}}
                                        </div>
                                        <div class="kt-notification__item-details">
                                            <div class="kt-notification__item-title kt-font-bold">
                                                Le mie campagne
                                            </div>
                                            <div class="kt-notification__item-time">
                                                
                                            </div>
                                        </div>
                                    </a>

@if(Auth::user()->hasRole('influencer'))
<a href="{{route('frontend.user.influencer.get',Auth::user()->uuid)}}" class="kt-notification__item">
 <div class="kt-notification__item-icon">
                                             <i class="material-icons nav__icon" id="ico_web">account_circle</i>
                                        </div>
                                        <div class="kt-notification__item-details">
                                            <div class="kt-notification__item-title kt-font-bold">
                                               Il Mio Profilo
                                            </div>
                                            <div class="kt-notification__item-time">
                                                
                                            </div>
                                        </div>
                                    </a>
                                    @endif
                                    
                                    @if(Auth::user()->hasRole('brand'))
                                    <a href="{{route('frontend.user.brand.get',Auth::user()->uuid)}}" class="kt-notification__item">
 <div class="kt-notification__item-icon">
                                            <i class="material-icons nav__icon" id="ico_web">account_circle</i>
                                        </div>
                                        <div class="kt-notification__item-details">
                                            <div class="kt-notification__item-title kt-font-bold">
                                               Profilo azienda
                                            </div>
                                            <div class="kt-notification__item-time">
                                                
                                            </div>
                                        </div>
                                    </a>
                                    @endif


                                    
				@if(Auth::user()->hasRole('influencer'))
 <a href="{{url('/')}}/profilo/completa/modifica" class="kt-notification__item">
                                        <div class="kt-notification__item-icon">
                                            <i class="material-icons nav__icon" id="ico_web">create</i>
                                        </div>
                                        <div class="kt-notification__item-details">
                                            <div class="kt-notification__item-title kt-font-bold">
                                                Modifica profilo 
                                            </div>
                                            <div class="kt-notification__item-time">
                                                
                                            </div>
                                        </div>
                                    </a>
                                   @endif
                                   
                                     @if(Auth::user()->hasRole('brand'))
 					<a href="{{url('/')}}/profilo/brand/modifica" class="kt-notification__item">
                                        <div class="kt-notification__item-icon">
                                            		<i class="material-icons nav__icon" id="ico_web">create</i>
                                        	</div>
                                        	<div class="kt-notification__item-details">
                                           		 <div class="kt-notification__item-title kt-font-bold">
                                                		Modifica dettagli dell azienda 
                                            		 </div>
                                            	<div class="kt-notification__item-time">
                                                
                                            	</div>
                                       	 </div>
                               		</a>
                                    @endif

                                    <a href="{{url('/')}}/account" class="kt-notification__item">
                                        <div class="kt-notification__item-icon">
						<i class="material-icons nav__icon" id="ico_web">construction</i>
                                           {{-- <i class="flaticon2-calendar-3 kt-font-success"></i> --}}
                                        </div>
                                        <div class="kt-notification__item-details">
                                            <div class="kt-notification__item-title kt-font-bold">
                                                Impostazioni Account
                                            </div>
                                        	<div class="kt-notification__item-time">
                                                
                                       		</div>
                                        </div>
                                    </a>
                                   
 <a href="{{url('/')}}/campagne/chiuse" class="kt-notification__item">
                                        <div class="kt-notification__item-icon">
<i class="material-icons nav__icon" id="ico_web">check_circle_outline</i>
                                            {{--<i class="flaticon2-rocket-1 kt-font-danger"></i>--}}
                                        </div>
                                        <div class="kt-notification__item-details">
                                            <div class="kt-notification__item-title kt-font-bold">
                                                Campagne Concluse
                                            </div>
                                            <div class="kt-notification__item-time">
                                                
                                            </div>
                                        </div>
                                    </a>


                                    
                                    <div class="kt-notification__custom kt-space-between">
                                        <a href="{{url('/')}}/logout" target="_blank" class="btn btn-label btn-label-brand btn-sm btn-bold" style="background-color:red; color:white; border-radius:20px;">Esci</a>
                                    
                                    </div>
                                </div>

                                <!--end: Navigation -->
                            </div>
                        </div>

                        <!--end: User bar -->
                    </div>

                    <!-- end:: Header Topbar -->
                </div>
            </div>

            <!-- end:: Header -->
              