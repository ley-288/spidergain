
@push('after-scripts')
<!--<script src="{{url('/')}}/assets/js/demo1/pages/custom/apps/chat/chat.js" type="text/javascript"></script>-->

<script>$(document).ready(function () {
        $('.btn').click(function () {
            if ($('#text_messaggio').val() != '') {
                $('#messaggio').submit();
                $(this).attr('disabled', 'disabled');
                $(this).addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light');
            }
        });
    });
</script>
@endpush
<div class="kt-grid__item kt-grid__item--fluid kt-app__content" id="kt_chat_content">
    <div class="kt-chat">
        <div class="kt-portlet kt-portlet--head-lg kt-portlet--last">
            <div class="kt-portlet__head">
                <div class="kt-chat__head ">
                    <div class="kt-chat__left">

                    </div>
                    <div class="kt-chat__center">
                        <div class="kt-chat__label">
                            <a href="#" class="kt-chat__title">@lang('Messaggi')</a>
                        </div>
                    </div>
                    <div class="kt-chat__right">

                    </div>
                </div>
            </div>
            <div class="kt-portlet__body" style="background:#f7f7f7;  overflow: auto;height: 300px">
               

                   
                    <div class="kt-chat__messages">
                        
                    </div>
               
            </div>
            <div class="kt-portlet__foot">
                <form id="messaggio_chat" action="{{route('frontend.user.chat.create')}}" method="post" >
                    @csrf
                    <div class="kt-chat__input">
                        <div class="kt-chat__editor">
                            <textarea id="text_messaggio_chat" name="messaggio" required maxlength="500" style="height: 50px" placeholder="{{__('applicazione.scrivi')}}"></textarea>
                            <input name="cmp" type="hidden" value="{{$campagna->uuid}}"/>
                            <input name="i_id" type="hidden" value="{{Auth::user()->uuid}}"/>
                        </div>
                        <div class="kt-chat__toolbar">
                            <div class="kt_chat__tools">

                            </div>
                            <div class="kt_chat__actions">
                                <button type="submit" class="btn btn-brand btn-md btn-upper btn-bold kt-chat__reply">{{__('applicazione.invia_messaggio')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>