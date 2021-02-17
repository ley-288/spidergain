{{-- Home/Cerca Campagne--}}




<script>
let log = document.getElementById('log');

document.onclick = inputChange;

function inputChange(e) {
  log.textContent = `Position: (${e.clientX}, ${e.clientY})`;
}


</script>

<style>


.im{  
   position: relative;    
   z-index: 1;       
}

{{-- full screen --}}
@media screen and (min-width: 480px) {

  .container {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 10px;
  
  }



.fa-facebook {
  font-size: 0.8em;
}
.fa-twitter {
  font-size: 0.8em;
}
.fa-instagram {
  font-size: 0.8em;
}
.fa-youtube {
  font-size: 0.8em;
}
.fa-linkedin {
  font-size: 0.8em;
}
.fa-laptop {
  font-size: 0.8em;
}
.fa-envelope-open-text {
  font-size: 0.8em;
}

#lock{
display: block;
color: white;
margin-left: 13px;
}

    .im{
    height: 20px;
    width: 20px;
    border-radius: 35px;
    margin-left: auto;
    margin-right: auto 
     
    }
    
    #para_desc{
    height: 90px;
    padding:2px;
    margin-left: 10px;
    font-size: 14px;
    text-align: left;
    }
    
    #vai_btn{
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 40%;
    background-color:#e72b38;
    border-radius: 30px;
    border:1px solid #e72b38;
    width: 200px;
    }
    
    #vai_btn:hover{
     transform: scale(1.2);
    }
    
    #border_box{
    border:1px solid transparent;
    margin-top: 20px;
    margin-right: 15px; 
    height:520px;
    
    background-color:white;
    }
    
    #border_box:hover{
    transition:0.2s;
    transform: scale(1.1);
    }
    
    iframe{
    display:block;
    margin-left:auto;
    margin-right:auto;
    }
}


{{-- mobile --}}
@media screen and (max-width: 480px) {

   body{
   scroll-snap-type: y mandatory;
   }
   
   #lock{
   display: block;
   color: white;
   margin-left: 13px;
   }


   .im{
    height: 20px;
    width: 20px;
    border-radius: 20px;   
    margin-left: auto;
    margin-right: auto;
     
    }
    
    #border_box{
    border:1px solid black;
    margin-top:-5px; 
    height:500px; 
    background-color:white;
    }
    
	
    #para{
    height: 80px;
    padding:10px;
    margin-left: 13px;
    }  
    
    #vai_btn{
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 40%;
    background-color:#e72b38;
    border-radius: 30px;
    border:1px solid #e72b38;
    width: 200px;
    }
    
     iframe{
    display:block;
    margin-left:auto;
    margin-right:auto;
    }
    
}

.im:hover{
    cursor: pointer;
}

</style>







<div class="col-xl-4 col-lg-12">
    <div class="kt-portlet kt-portlet--height-fluid"  id="border_box" style="border-radius: 20px; background-color:white;">  
      
        <div class="kt-portlet__head kt-portlet__head--noborder">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                </h3>
            </div>
        </div>
        
        <div class="kt-portlet__body"> 
            <div class="kt-widget kt-widget--user-profile-2">
                <div class="kt-widget__head">
                    @if(isset($campagna->users))
                    <div class="kt-widget__media">
                        @if($campagna->users->avatar_location)
                        <span class="kt-userpic kt-userpic--xl">
                            <img class="kt-widget3__img" src="{{asset('assets/media/icons/definitive_s.png')}}" style="margin-top:0px; margin-left:10px;border:2px solid white; border-radius: 50px;" alt="">
                        </span>
                        @endif
                    </div>
                    @endif
                    <div class="kt-widget__info">
                        <p class="kt-widget__titel" style="text-align:center; font-size:20px; font-weight: bold; color: red; text-transform:capitalize;">
                            BENVENUTO!
                        </p>
                    </div>
                </div>
                
                
                </br>
                
                
          <div class="kt-widget__body">
                    <div id="para_desc" class="kt-widget__section" style="text-align: center;">
                       DAL PRIMO APRILE POTRAI ACCEDERE ALLE CAMPAGNE E INIZIARE A INVIARE PREVENTIVI ALLE AZIENDE!<br>
                       </br>
                        </div>
<iframe src="https://free.timeanddate.com/countdown/i7n7b861/n3281/cf12/cm0/cu4/ct0/cs0/ca0/co0/cr0/ss0/cac5568da/cpc000/pcfff/tcfff/fn3/fs100/szw576/szh243/iso2021-04-01T00:00:00" allowTransparency="true" frameborder="0" width="194" height="50" android:layout_height="wrap_content"></iframe>



                   

                    </br>

                    @if(isset($campagna->canali_view))
			<div style="background-color: transparent; height: 40px;">
    				@foreach($campagna->canali_view as $item)
      					<span class="badge badge-sm badge-light" style="background-color:transparent;float:center; height:40px; width:40px;"><i class="{{$item['icon']}}" style="position: absolute; margin-top: 10px;"></i></span>                                            
    				@endforeach 
			</div>
		</br></br>
                    @endif                   
                </div>

 		<div class="kt-widget__footer">
                    <a class="btn btn-success btn-lg btn-upper"id="vai_btn"><i class="material-icons nav__icon"id="lock">lock</i></a>  
                </div>
{{--              
                <div class="kt-widget__footer">
                    <a href="#" class="btn btn-success btn-lg btn-upper" id="vai_btn">{{('GO!')}}</a>
                </div> 
--}}                            
            </div>
        </div>
    </div> 
</div>



</br>




{{-- SECOND BLOCK --}}

<div class="col-xl-4 col-lg-12">

    <!--Begin::Portlet-->

    <div class="kt-portlet kt-portlet--height-fluid 
         @if(isset($campagna->cerca))
         @if (!isset($campagna->vista) )
         green
         @endif 
         @endif
         "id="border_box" style="border-radius: 20px; background-color: white;">
        @if(isset($campagna->cerca))
         @if (!isset($campagna->vista))
        <span class="badge badge-success badge-sm badge-absolute" style="border-radius:20px; margin-right: 20px; margin-top: 8px;">@lang('Nuova')</span>
        @endif 
        @endif
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
                    @if(isset($campagna->users))
                    <div class="kt-widget__media">
                        @if($campagna->users->avatar_location)


                        <span class="kt-userpic kt-userpic--xl">
                            <img class="kt-widget3__img" src="{{asset('storage/'.$campagna->users->avatar_location)}}" style="margin-top:0px; margin-left:10px;border:1px solid white; border-radius: 50px;" alt="">
                        </span>
                        @else
                        <div class="kt-widget__pic kt-widget__pic--success kt-font-success kt-font-boldest">
                            {{$campagna->users->first_name[0]}} {{$campagna->users->last_name[0]}}
                        </div>
                        @endif
                    </div>
                    @endif
                    <div class="kt-widget__info">
                        <p class="kt-widget__titel" style="text-align:center; font-size:20px; font-weight: bold; color: #5568DA; text-transform:capitalize;">
                        {{Str::limit(strip_tags($campagna->titolo),15)}}
                            {{--{{$campagna->titolo}}--}}
                        </p>
                        
{{--

                        @if(isset($campagna->users))
                        <p class="kt-widget__username" style="font-size:18px;" >
                            <a target="_blank" href="{{route('frontend.user.brand.get',$campagna->users->uuid)}}"> {{$campagna->users->first_name}} {{$campagna->users->last_name}}</a>
                        </p>
                        
                       
                        <span class="kt-widget__desc">
                            {{__('applicazione.autore')}}
                        </span>
                       
                        
                        @endif
--}}
                    </div>
                    
                </div>
                </br>
                
                   <div class="kt-widget__body">
                    <div id="para_desc" class="kt-widget__section">
                       {{Str::limit(strip_tags($campagna->descrizione),80,'...')}}<br>
                       </br>
                         </div>
          
<iframe src="https://free.timeanddate.com/countdown/i7n7b861/n3281/cf12/cm0/cu4/ct0/cs0/ca0/co0/cr0/ss0/cac5568da/cpc000/pcfff/tcfff/fn3/fs100/szw576/szh243/iso2021-04-01T00:00:00" allowTransparency="true" frameborder="0" width="194" height="50" android:layout_height="wrap_content"></iframe>

            
                                        
                  
                    
                    </br>
                    
                    
                    @if(isset($campagna->canali_view))
                    
                    
                                        
<div style="background-color: white; height: 40px; margin-left:auto; margin-right:auto;">
    @foreach($campagna->canali_view as $item)
      <span class="badge badge-sm badge-light" style="background-color:transparent;float:center; height:40px; width:40px;"><i class="{{$item['icon']}}" style="position: absolute; margin-top: 10px;"></i></span>                                            
    @endforeach 
</div>

</br></br>



{{-- 
                    <div class="alert alert-secondary" role="alert" >
                        <div class="alert-text "> @lang('applicazione.lista_canali')
                        <div class="canali d-flex">
                        @foreach($campagna->canali_view as $item)
                        <div class="kt-widget__item kt-margin-r-20">
                            <div class="kt-widget__icon">
                              <i data-container="body" data-toggle="kt-tooltip" data-placement="top" data-original-title="{{$item['name']}}" class="{{$item['icon']}}"></i>
                            </div>
                        </div>
                        @endforeach
                        </div>    
                    </div>
                    </div>
--}}
                    @endif
             
                    
                    
                   
                    
{{--
                   @if(isset($campagna->categorie))
                    @foreach($campagna->categorie as $categoria)
                    <span class="kt-badge kt-badge--unified-brand  kt-badge--inline" style="height: 30px;text-align: center; float:center;">{{$categoria->nome}}</span>
                    @endforeach
                    @endif
                    
                   
                   
                    <div class="kt-widget__item">
                        <div class="kt-widget__contact">
                            <span class="kt-widget__label">{{__('applicazione.inizio_campagna')}}</span>
                            <a href="#" class="kt-widget__data">{{$campagna->data_inizio->formatLocalized('%d %B %Y')}}</a>
                        </div>
                        <div class="kt-widget__contact">
                            <span class="kt-widget__label">{{__('applicazione.fine_campagna')}}</span>
                            <a href="#" class="kt-widget__data">{{$campagna->data_fine->formatLocalized('%d %B %Y')}}</a>
                        </div>
                    </div>
--}}
                    
                    
                </div>
                
               <div class="kt-widget__footer">
                    <a class="btn btn-success btn-lg btn-upper"id="vai_btn"><i class="material-icons nav__icon" id="lock" >lock</i></a>
                    
                </div>
              
              
{{--              
                <div class="kt-widget__footer">
                    <a href="{{route('frontend.user.campagna.dettaglio',['uuid' => $campagna->uuid])}}" class="btn btn-success btn-lg btn-upper" id="vai_btn">{{__('applicazione.guarda_campagna')}}</a>
                    
                </div>
--}}             
            </div>
 
 





            <!--end::Widget -->
        </div>
    </div>



    <!--End::Portlet--> 
</div>


</br>



