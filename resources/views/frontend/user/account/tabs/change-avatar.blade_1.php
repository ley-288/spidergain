@push('after-styles')
<link href="{{url('/')}}/css/slim.min.css" rel="stylesheet" type="text/css" />
@endpush


@push('after-scripts')

<script src="{{url('/')}}/js/slim.kickstart.min.js"></script>
@endpush

<div class="form-group row">
    <form id="kt_form" action="{{route('frontend.user.avatar')}}" method="post" enctype="multipart/form-data">
        @csrf
        <label class="col-xl-12 col-lg-12 col-form-label">@lang('applicazione.immagine')</label>
        <div class="col-lg-12 col-xl-12">
            <div class="kt-avatar kt-avatar--outline kt-avatar--circle-" id="kt_apps_user_add_avatar">

                @if(Auth::user()->avatar_location == '')
                <div id="img_holder" class="kt-avatar__holder" style="overflow: hidden; background-image: url('{{url('/img/frontend/placeholder.jpg')}}')">

                    

                </div>

                @else
                <div id="img_holder" class="kt-avatar__holder" style="overflow: hidden; background-image: url('{{asset('storage/'.Auth::user()->avatar_location)}}')">
                    
                </div>
                @endif



                <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="@lang('applicazione.cambia_immagine')">
                    <i class="fa fa-pen"></i>
                    <input type="file" name="profile_avatar" id="profile_avatar" >
                </label>

                <span class="kt-avatar__cancel" {{(Auth::user()->avatar_location != '') ? ' style=display:flex !important ': ''}} data-toggle="kt-tooltip" title="" data-original-title="@lang('applicazione.cancella_immagine')">
                    <i class="fa fa-times"></i>
                </span>
               
            </div>
             <p style="margin-top:30px" class="form-text text-muted">@lang('applicazione.dimensioni_minime')</p>
        </div>

    </form>
</div>

