@extends('frontend.layouts.interna')

@section('content')

@push('after-scripts')

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {

                //$('.kt-avatar__holder img').attr('src', e.target.result);
                //$('.kt-avatar__holder').css('background-image','url('+ e.target.result +')');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).ready(function () {
        $('.cancella_profilo').click(function(e){
            
            var confirm = window.confirm('{{__('applicazione.conferma_cancella_account')}}');
            if (confirm == true) {
                $('#cancella_profilo').submit();
      }
        });
        
        
        $("#profile_avatar").change(function () {

            var token = '{{csrf_token()}}';
            var formData = new FormData();
            formData.append('avatar', this.files[0]);
            formData.append('_token', token);
            KTApp.block('#img_holder');
            $.ajax({
                type: 'POST',
                url: '{{route('frontend.user.avatar')}}',
                data: formData,
                contentType: false,
                 processData: false,
            }).done(function (data) {
               $('.kt-header__topbar-item--user img').attr('src','storage/'+data.avatar_location);
               $('.kt-avatar__holder').css('background-image','url(storage/'+data.avatar_location+')');
              KTApp.unblock('#img_holder');
              $('.kt-avatar__cancel').show();
            }).fail(function (jqXHR, textStatus, errorThrown) {
                KTApp.unblock('#img_holder');
                swal.fire({
                    "title": "", 
                    "text": "@lang('applicazione.errori_file')", 
                    "type": "error",
                    "confirmButtonClass": "btn btn-secondary"
                });
            });


        });

        $('.kt-avatar__cancel').click(function () {
            
           
            
            var token = '{{csrf_token()}}';
            var formData = new FormData();
            KTApp.block('#img_holder');
            formData.append('_token', token);
            $.ajax({

                type: 'POST',
                url: '{{route('frontend.user.avatar.delete')}}',
                data: formData,
                contentType: false,
                 processData: false,
            }).done(function (data) {
                 KTApp.unblock('#img_holder');
                 swal.fire({
                    "title": "", 
                    "text": "@lang('applicazione.immagine_cancellata')", 
                    "type": "success",
                    "confirmButtonClass": "btn btn-secondary"
                });
                $('.kt-header__topbar-item--user img').attr('src','{{url('/img/frontend/placeholder.jpg')}}');
                $('.kt-avatar__holder').css('background-image','url({{url('/img/frontend/placeholder.jpg')}})');
                $('.kt-avatar__cancel').hide();
            }).fail(function (jqXHR, textStatus, errorThrown) {
                KTApp.unblock('#img_holder');
            });
        });

    })
</script>

@endpush
<div class="kt-holder kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">


    </div>
    <!-- begin:: Content -->
    <div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="row justify-content-center align-items-center mb-3">

            <div class="col col-sm-12 align-self-center">
                @include('includes.partials.messages') 


                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                {{__('applicazione.modifica_profilo')}}
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <ul class="nav nav-pills" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#kt_tabs_3_1">@lang('navs.frontend.user.profile')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_tabs_3_3">@lang('labels.frontend.user.profile.update_information')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_tabs_3_4">@lang('navs.frontend.user.change_password')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_tabs_3_5">@lang('applicazione.modifica_immagine')</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="kt_tabs_3_1" role="tabpanel">
                                @include('frontend.user.account.tabs.profile')
                            </div>
                            <div class="tab-pane" id="kt_tabs_3_3" role="tabpanel">
                                @include('frontend.user.account.tabs.edit')
                            </div>
                            <div class="tab-pane" id="kt_tabs_3_4" role="tabpanel">
                                @include('frontend.user.account.tabs.change-password')
                            </div>
                            <div class="tab-pane" id="kt_tabs_3_5" role="tabpanel">
                                @include('frontend.user.account.tabs.change-avatar')
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- col-xs-12 -->
        </div><!-- row -->
    </div>

    @endsection