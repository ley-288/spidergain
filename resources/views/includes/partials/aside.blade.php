<style>

{{-- mobile --}}
@media screen and (max-width: 1024px) {

	#side-button{
	display: none;
	}
	
	#kt_aside{
	display: none;
	}
	
	#kt_aside_close_btn{
	display: none;
	}
	
	.sidebar{
	display: none;
	}
	
	.side_2{
	display: none;
	}
    
}
	
	button{
			background: rgb(158, 0, 250);
			cursor: pointer;
			will-change: background;
			transition: background 1s;
		
		
			&:hover{
				background: rgb(229, 0, 250);
			}
		}
	
	
	.overlay{
		opacity: 1;
		position: absolute;
		z-index: 0;
		top: 50px;
		left: -10;
		width: 100vw;
		height: 100vh;
		background: rgb(0,0,0,.5);
	}
	
	.share, .overlay{
		display: none;
	}
	
	.show-share{
		display: block;
	}
	
	.share{
		position: absolute;
		left: 0;
		right: 0;
		top: 30%;
		margin: auto;
		width: 50%;
		z-index: 1;
		padding: 1em;
		background: white;
		
		h2{
			margin: 0;
		}
		
		button{
			border: none;
			padding: 8em 1.2em;
			margin-top: 3em;
			width: 32%;
			cursor: pointer;
		}
	}
	
	
	#kt_aside_menu_wrapper{
	background-color:white;
	}
	
	#side-button{
	background-color:white;
	}

	#header{
	background-color:white;
	}

{{-- web --}}
@media screen and (min-width: 1024px) {	
	
	#mobile_nav{
	display:none;
	}
	
	#kt_aside{
	display: none;
	}
}


body {
    margin: 0 0 55px 0;
}

.nav_mobile {
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    height: 60px;
    box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
    background-color: #1E1E2D;
    display: flex;
    overflow-x: auto;
    z-index: 214748360;
   
    
}

.nav__link {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    flex-grow: 1;
    min-width: 50px;
    overflow: hidden;
    white-space: nowrap;
    font-family: poppins;
    font-size: 13px;
    color: white;
    text-decoration: none;
    -webkit-tap-highlight-color: transparent;
    transition: background-color 0.1s ease-in-out;
    
}

.nav__link:hover {
    background-color: #1E1E2D;
    color: white;
    
}

.nav__link--active {
    background-color: #e72b38;
    color: white;
}

.nav__icon {
    font-size: 18px;
    margin-top: 2px;
}



	
#ico_side{
	margin-top:5px;
	height:20px;
	width:20px;
}



{{-- NUOVA SIDE MENU AND ICONS --}}

.side_2 {
  height: 100%;
  width: 80px;
  position: fixed;
  transition: 0.5s;
  z-index: 2;
  top: 6;
  left: 0;
  background-color: #1E1E2D;
  overflow-x: hidden;
  padding-top: 30px;
}

.side_2:hover {
  height: 100%;
  width: 220px;
  position: fixed;
  z-index: 2;
  top: 6;
  left: 0;
  background-color: #1E1E2D;
  overflow-x: hidden;
  padding-top: 30px;
}

   
}

#par{
color:transparent;
}

.side_2 a {
  padding: 20px 20px 10px 25px;
  text-decoration: none;
  font-size: 20px;
  color: #F9F9FC;
  display: block;
}

/* Style links on mouse-over */
.side_2 a:hover {
  color: white;
  transform: scale(1.1)
}

/* Style the main content */
.main {
  margin-left: 160px; /* Same as the width of the sidenav */
  padding: 0px 10px;
}


</style>


@if(Auth::user()->hasRole('influencer'))
           
<div class="side_2">
  <a href="{{route('frontend.condividi')}}"><i class="material-icons nav__icon" id="ico_side" style="color:white;">share</i><p style="margin-top: -35px; margin-left:55px;"> Condividi</p></a>
  <a href="{{url('/')}}/cerca-campagne" ><i class="material-icons nav__icon" id="ico_side" style="color:white;">house</i><p style="margin-top: -35px;margin-left:55px;"> Home</p></a>
  <a href="{{url('/')}}/dashboard" ><i class="material-icons nav__icon" id="ico_side" style="color:white;">message</i><p style="margin-top: -35px;margin-left:55px;"> Messaggi</p></a>
  <a href="{{url('/')}}/richieste"><i class="material-icons nav__icon" id="ico_side" style="color:white;">swap_vertical_circle</i><p style="margin-top: -35px;margin-left:55px;"> Ricevuto</p></a>
  <a href="{{url('/')}}/campagne/aperte"><i class="material-icons nav__icon" id="ico_side" style="color:white;">explore</i><p style="margin-top: -35px;margin-left:55px;"> Aperte</p></a>
  <a href="{{url('/')}}/faq"><i class="material-icons nav__icon" id="ico_side" style="color:white;">help</i><p style="margin-top: -35px;margin-left:55px;"> FAQ</p></a>
  <a href="{{url('/')}}/come-funziona"><i class="material-icons nav__icon" id="ico_side" style="color:white;">psychology</i><p style="margin-top: -35px;margin-left:55px;">Come?</p></a>
</div>

@endif

@if(Auth::user()->hasRole('brand'))
           
<div class="side_2">
  <a href="{{route('frontend.condividi')}}"><i class="material-icons nav__icon" id="ico_side" style="color:white;">share</i><p style="margin-top: -35px; margin-left:55px;"> Condividi</p></a>
  <a href="{{url('/')}}/dashboard" ><i class="material-icons nav__icon" id="ico_side" style="color:white;">house</i><p style="margin-top: -35px;margin-left:55px;"> Home</p></a>
  <a href="{{url('/')}}/campagne/aperte"><i class="material-icons nav__icon" id="ico_side" style="color:white;">explore</i><p style="margin-top: -35px;margin-left:55px;"> Aperte</p></a>
  <a href="{{url('/')}}/faq"><i class="material-icons nav__icon" id="ico_side" style="color:white;">help</i><p style="margin-top: -35px;margin-left:55px;"> FAQ</p></a>
  <a href="{{url('/')}}/come-funziona"><i class="material-icons nav__icon" id="ico_side" style="color:white;">psychology</i><p style="margin-top: -35px;margin-left:55px;">Come?</p></a>
</div>

@endif

   
{{-- MUST KEEP THIS CODE FOR LAYOUT OF WEBSITE --}}
<!-- begin:: Aside -->
<button class="kt-aside-close" style="background-color:#5579F6;" id="kt_aside_close_btn"><i class="la la-close"></i></button>
<div class="kt-aside kt-aside--fixed kt-scroll kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" data-scroll="true" id="kt_aside">


{{--  
    <!-- begin:: Aside Menu -->
<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" style="background-color: transparent;" id="kt_aside_menu_wrapper">
        <div id="kt_aside_menu" class="kt-aside-menu" data-ktmenu-vertical="1" data-ktmenu-scroll="1">
 
 
    
            <ul class="kt-menu__nav ">
             
            
            <li class="kt-menu__item  kt-menu__item--submenu"  id="side-button" data-ktmenu-submenu-toggle="hover">
                    <a href="{{route('frontend.condividi')}}" class="kt-menu__link kt-menu__toggle">
                    <i class="material-icons nav__icon" id="ico_side">share</i>
                        <span class="kt-menu__link-icon"> </span>
                        <span style="margin-left: -18px; margin-top:5px;" class="kt-menu__link-text">@lang('Condividi')</span>
                    </a>
                  </li>
--}}          
            
      
	





    <!-- end:: Aside Menu -->
</div>



{{-- mobile Nav --}}

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<nav class="nav_mobile" id="mobile_nav">
  @role('influencer')
  <a href="{{url('/')}}/richieste" class="nav__link nav__link--active">
    <i class="material-icons nav__icon">swap_vertical_circle</i>
    <span class="nav__text">Ricevuto</span>
  </a>
  @endrole
  @role('brand')
  <a href="{{url('/')}}/campagne/crea" class="nav__link nav__link--active">
    <i class="material-icons nav__icon">add_circle</i>
    <span class="nav__text">Nuova</span>
  </a>
  @endrole
  
  
  @role('influencer')
  <a href="{{url('/')}}/campagne/aperte" class="nav__link nav__link--active">
    <i class="material-icons nav__icon">explore</i>
    <span class="nav__text">Aperte</span>
  </a>
  @endrole
  @role('brand')
  <a href="{{url('/')}}/campagne/aperte" class="nav__link nav__link--active">
    <i class="material-icons nav__icon">explore</i>
    <span class="nav__text">Aperte</span>
  </a>
  @endrole
  
  
  @role('influencer')
  <a href="{{url('/')}}/cerca-campagne" class="nav__link nav__link--active">
    <i class="material-icons nav__icon">house</i>
    <span class="nav__text">Home</span>
  </a>
  @endrole
  @role('brand')
  <a href="{{url('/')}}/dashboard" class="nav__link nav__link--active">
    <i class="material-icons nav__icon">house</i>
    <span class="nav__text">Home</span>
  </a>
  @endrole
  
  
  @role('influencer')
  <a href="{{route('frontend.user.influencer.get',Auth::user()->uuid)}}" class="nav__link nav__link--active">
    <i class="material-icons nav__icon">account_circle</i>
    <span class="nav__text">Profilo</span>
  </a>
  @endrole
  @role('brand')
  <a href="{{route('frontend.user.brand.get',Auth::user()->uuid)}}" class="nav__link nav__link--active">
    <i class="material-icons nav__icon">account_circle</i>
    <span class="nav__text">Profilo</span>
  </a>
  @endrole
  
  <a href="{{route('frontend.condividi')}}" class="nav__link nav__link--active">
    <i class="material-icons nav__icon">share</i>
    <span class="nav__text">Condividi</span>
  </a>
</nav>

<!-- end:: Aside -->

