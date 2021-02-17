@push('after-styles')
<link href="{{url('/')}}/css/slim.min.css" rel="stylesheet" type="text/css" />
@endpush


@push('after-scripts')

<script src="{{url('/')}}/js/slim.kickstart.min.js"></script>
@endpush

<div class="col-xl-2">
    <form id="kt_form" action="{{route('frontend.user.avatar')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="slim" data-service-format="file" 
            data-will-request="handleRequest" 
            data-default-input-name="avatar" 
            data-force-size="450,450" 
            data-instant-edit="true" 
            data-push="true" 
            data-ratio="1:1" 
            data-service="{{route('frontend.user.avatar')}}" 
            data-did-upload="imageUpload"
            data-did-remove="handleImageRemoval"
            data-size="450,450" 
            data-status-file-size="{{__('applicazione.file_troppo_grande',['mb'=>5])}}"
            data-label="{{__('applicazione.trascina_file')}}"
            data-button-cancel-label="{{__('applicazione.reset')}}"
            data-button-cancel-title="{{__('applicazione.reset')}}"
            data-button-confirm-label="{{__('applicazione.confirm')}}"
            data-button-confirm-title="{{__('applicazione.confirm')}}"
            data-button-remove-label="{{__('applicazione.remove')}}"
            data-button-remove-title="{{__('applicazione.remove')}}"
            data-button-edit-label="{{__('applicazione.edit')}}"
            data-button-edit-title="{{__('applicazione.edit')}}"
            data-button-rotate-title="{{__('applicazione.rotate')}}"
            data-status-upload-success="{{__('applicazione.saved')}}"
            data-max-file-size="5">
            @if(Auth::user()->avatar_location)
            <img src="{{asset('storage/'.Auth::user()->avatar_location)}}" alt=""/> 
            @endif
    <input type="file" name="avatar"/>
            
        </div>
    </form>

<script>
    function handleRequest(xhr){
        
        xhr.setRequestHeader('X-CSRF-TOKEN', '{{csrf_token() }}' );
    }
    
    
        function imageUpload(error, data, response) {
            console.log(error, data, response);
            console.log('url({{asset('storage')}}/'+response.avatar_location+')');
            if(error != 'fail'){
                
                $('#img_holder').css('background-image','url({{asset('storage')}}/'+response.avatar_location+')');
                if($('.kt-header__topbar-wrapper img').length){
                    $('.kt-header__topbar-wrapper img').attr('src','{{asset('storage')}}/'+response.avatar_location);
                }else{
                    $('.kt-header__topbar-icon').remove();
                    $('.kt-header__topbar-wrapper').append('<img src="{{asset('storage')}}/'+response.avatar_location+'" />');
                          
                }
                
                
            }

    }
     function handleImageRemoval(data) {

        
        // setup request and send
       
        var url = '{{route('frontend.user.avatar.delete')}}';
        var xhr = new XMLHttpRequest();
        
        xhr.open('DELETE', url , true);
        xhr.setRequestHeader('X-CSRF-TOKEN', '{{csrf_token() }}' );
        xhr.send();
        $('#img_holder').css('background-image','url({{url('/')}}/img/frontend/placeholder.jpg)');
        $('.kt-header__topbar-wrapper img').remove();
        $('.kt-header__topbar-wrapper').append('<span class="kt-header__topbar-icon kt-bg-brand kt-hidden-"><b>{{Auth::user()->first_name[0]}}</b></span>');
    }
</script>
</div>