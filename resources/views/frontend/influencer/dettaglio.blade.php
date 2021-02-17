@extends('frontend.layouts.interna')

@section('title', app_name() . ' | ' . __('applicazione.profilo_influencer'))

@section('content')
@push('after-styles')


@endpush

@push('after-scripts')

@endpush

<script>
function openPage(pageName,elmnt,color) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }
  document.getElementById(pageName).style.display = "block";
  elmnt.style.backgroundColor = color;
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>



  <style>
  
  	body{
  		
  	}
  	
  	
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

/* Style tab links */
.tablink {
  background-color: #555;
  color: white;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  font-size: 17px;
  width: 25%;
}

.tablink:hover {
  background-color: #777;
}

/* Style the tab content (and add height:100% for full page content) */
.tabcontent {
  color: white;
  display: none;
  padding: 100px 20px;
  height: 100%;
}

#Home {background-color: red;}
#News {background-color: green;}
#Contact {background-color: blue;}
#About {background-color: orange;}
  
  </style>  

<div class="kt-holder kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- begin:: Subheader -->
  

        

    <!-- begin:: Content -->
   
              
              
<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
        
        <div class="row">
            <div class="col-xl-12" >
                <div class="kt-portlet kt-portlet--height-fluid-" style="background-image:url({{url('assets/media/red.png')}}); background-repeat:no-repeat;position:relative; background-size:150% 200px;">
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
                                        <img style="border:3px solid white;" id="prof_loc" class="kt-widget__img kt-hidden-" src="{{asset('storage/'.$user->avatar_location)}}" alt="Immagine profilo">
                                            @else
                                            <div class="kt-widget3__user-img">
                                            <img style=" border:3px solid white;" id="prof_loc" class="kt-widget__img kt-hidden-" src="{{asset('assets/media/icons/definitive_s.png')}}" alt="Immagine profilo">
                                                {{--{{$user->first_name[0]}} {{$user->last_name[0]}}--}}
                                            
                                            </div>
                                            @endif
                                    </div>
                                </div>
                                <div class="kt-widget__info">
                                    <a href="#" class="kt-widget__username" style="color:white;">
                                        {{$user->first_name}} {{$user->last_name}}
                                    </a>
                                    <span class="kt-widget__desc" style="color:white;">
                                        {{$user->dettagli->ruolo}}
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

                        <!--end::Widget -->

                        <!--begin::Navigation -->


                        <!--end::Navigation -->
                    </div>
                </div>
              </div>
              
      
              
             
                               

              
                              
<div class="col-xl-6">
                @include('frontend.influencer.recensioni')
            </div>
            <div class="col-xl-6">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                {{__('applicazione.campagne_attive')}}
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect id="Rectangle-10" x="0" y="0" width="24" height="24"></rect>
                                    <path d="M16.3740377,19.9389434 L22.2226499,11.1660251 C22.4524142,10.8213786 22.3592838,10.3557266 22.0146373,10.1259623 C21.8914367,10.0438285 21.7466809,10 21.5986122,10 L17,10 L17,4.47708173 C17,4.06286817 16.6642136,3.72708173 16.25,3.72708173 C15.9992351,3.72708173 15.7650616,3.85240758 15.6259623,4.06105658 L9.7773501,12.8339749 C9.54758575,13.1786214 9.64071616,13.6442734 9.98536267,13.8740377 C10.1085633,13.9561715 10.2533191,14 10.4013878,14 L15,14 L15,19.5229183 C15,19.9371318 15.3357864,20.2729183 15.75,20.2729183 C16.0007649,20.2729183 16.2349384,20.1475924 16.3740377,19.9389434 Z" id="Path-3" fill="#000000"></path>
                                   <path d="M4.5,5 L9.5,5 C10.3284271,5 11,5.67157288 11,6.5 C11,7.32842712 10.3284271,8 9.5,8 L4.5,8 C3.67157288,8 3,7.32842712 3,6.5 C3,5.67157288 3.67157288,5 4.5,5 Z M4.5,17 L9.5,17 C10.3284271,17 11,17.6715729 11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L4.5,20 C3.67157288,20 3,19.3284271 3,18.5 C3,17.6715729 3.67157288,17 4.5,17 Z M2.5,11 L6.5,11 C7.32842712,11 8,11.6715729 8,12.5 C8,13.3284271 7.32842712,14 6.5,14 L2.5,14 C1.67157288,14 1,13.3284271 1,12.5 C1,11.6715729 1.67157288,11 2.5,11 Z" id="Combined-Shape" fill="#000000" opacity="0.3"></path>
                                </g>
                            </svg>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        @if( count($user->richieste) > 0 )


                        <?php
//                                $days_tot = round((strtotime($richiesta->campagne->data_fine) - strtotime($richiesta->campagne->data_inizio)) / (60 * 60 * 24));
//                                $days_since_start = round((time() - strtotime($richiesta->campagne->data_inizio)) / (60 * 60 * 24));
//                                $days_perc = ($days_since_start / $days_tot) * 100;
//                                $days_perc = ($days_perc > 100) ? 100 : $days_perc;
                        ?>
                        <div class="kt-section kt-section--space-md">
                            <div class="kt-widget24 kt-widget24--solid">
                                <div class="kt-widget24__details">
                                    <div class="kt-widget24__info">
                                        <a href="#" class="kt-widget24__title" title="Click to edit">
                                            {{__('applicazione.numero_campagne')}}
                                        </a>
                                        <span class="kt-widget24__desc">

                                        </span>
                                    </div>
                                    <span class="kt-widget24__stats kt-font-brand">

                                        {{count($user->richieste)}}
                                    </span>
                                </div>
                            </div>
                        </div>

                        @else
                        {{__('applicazione.no_campagne')}}
                        @endif

                    </div>
                </div>
            </div>

        </div>

</br></br>


    </div>
    
    
  {{--  
<button class="tablink" onclick="openPage('Home', this, 'red')">Home</button>
<button class="tablink" onclick="openPage('News', this, 'green')" id="defaultOpen">News</button>
<button class="tablink" onclick="openPage('Contact', this, 'blue')">Contact</button>
<button class="tablink" onclick="openPage('About', this, 'orange')">About</button>

<div id="Home" class="tabcontent">
  <h3>Home</h3>
  <p>Home is where the heart is..</p>
</div>

<div id="News" class="tabcontent">
  <h3>News</h3>
  <p>Some news this fine day!</p> 
</div>

<div id="Contact" class="tabcontent">
  <h3>Contact</h3>
  <p>Get in touch, or swing by for a cup of coffee.</p>
</div>

<div id="About" class="tabcontent">
  <h3>About</h3>
  <p>Who we are and what we do.</p>
</div>
--}}



    @endsection
