@extends('frontend.layouts.interna')



@section('content')
@push('after-styles')


@endpush

@push('after-scripts')

@endpush

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
  height: 200px;
}

.social {
  position: relative;
  display: inline-block;
  float: left;
  padding: 10px;
}

    .im{
    	 height: 70px;
         width: 70px;
         border-radius: 35px;
         
         margin-top:-100px;
    margin-left: auto;
    margin-right: auto 
     
    }
    
    .im:hover{
    transition:0.2s;
    transform: scale(1.1);
    }
    
}


{{-- mobile --}}
@media screen and (max-width: 480px) {

.container {
  display: flex;
  table-layout: fixed;
  align-items: center;
  justify-content: center;
  height: 200px;
}

.social {
  position: relative;
  display: inline-block;
  float: left;
  padding: 10px;
}

   .im{
    	 height: 40px;
         width: 40px;
         border-radius: 20px;
       
        margin-top:-50px;
    margin-left: auto;
    margin-right: auto 
     
    }
    
}

 .im:hover{
    	
    	cursor: pointer;
    }

</style>

<div class="kt-holder kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- begin:: Subheader -->
  

        

    <!-- begin:: Content -->
    
         
              
              
           
<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
        
        <div class="row">
            <div class="col-xl-12" >
                <div class="kt-portlet kt-portlet--height-fluid-">
                    <div class="kt-portlet__head kt-portlet__head--noborder">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title" style="color: transparent;"> Share </h3>
                        </div>
                    </div>
                    
                    </br>
                    
                    
 
            
                       <!--begin::Widget -->
                        <div class="kt-widget kt-widget--user-profile">
                            <div class="kt-widget__head">
                                
                                <h1 style="text-align: center;">Condividici sui tuoi social media!</h1>
                
            
                            </div>                      
                        </div>
                       	
                       	</br></br></br>
                       	
 <div class="kt-widget kt-widget--user-profile-2">
                            <div class="kt-widget__head">
                            
                           
                     
                                  
                <div class="container">
            		   <div align="center;" class="social">                
       			   <img class="im" id="log" src="{{url('/')}}/assets/media/icons/socialbuttons/facebook.png" alt="Share on Facebook" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent('https://www.spidergain.com/register'),'facebook-share-dialog','width=626,height=636'); return false; ismap">
              		   </div>         
              
              		   <div align="center;" class="social">     
                           <img class="im" id="log" src="{{url('/')}}/assets/media/icons/socialbuttons/twitter.png"  alt="Share on Twitter" onclick="javascript:window.open('https://twitter.com/share?text=Registrati%20anche%20tu%20su%20Italian%20Spidergain&amp;url=https://www.spidergain.com/register','Twitter-dialog','width=626,height=436'); return false; ismap">
                      	   </div>     
                           
                           <div align="center;" class="social"> 
                           <a id="share" id="log" href="https://linkedin.com/shareArticle?url=https://www.spidergain.com/register/&title=Spidergain" target="_blank"><img class="im" src="{{url('/')}}/assets/media/icons/socialbuttons/linkedin.png" </a>
                            </div> 
                           
                           <div align="center;" class="social"> 
                           <img class="im" id="log" src="{{url('/')}}/assets/media/icons/socialbuttons/whatsapp.png"  alt="Share on Whatsapp" onclick="window.open('whatsapp://send?text=Spidergain%20'+encodeURIComponent('https://www.spidergain.com/register'),'width=626,height=636'); return false; ismap">
			   </div>

			   <div align="center;" class="social">                         
       			   <a href="mailto:?subject=Registrati su Spidergain ora!&amp;body=http://www.spidergain.com/register"
   				title="Share by Email">
  			   <img class="im" id="log" src="{{url('/')}}/assets/media/icons/socialbuttons/email.png" >
			   </a>        

             
     </div>    
        </div>
        
			  
			  
			   
			   
			
                            </div>                      
                        </div>
                        
                         <div class="kt-widget kt-widget--user-profile-2">
                            <div class="kt-widget__head">
                                
                                
                </br></br></br>
            
                            </div>                      
                        </div>

                    </div>
                </div>
           </div>                         
      </div>

    




    @endsection
    
    