
@push('after-scripts')


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
                            <a href="#" class="kt-chat__title">@lang('Bacheca pubblica dei messaggi della campagna')</a>
                            @role('influencer')
                            <span class="kt-chat__status">
                                <span class="kt-badge kt-badge--dot kt-badge--success"></span> @lang('Scrivi qui dubbi o domande riguardo la Campagna.')
                            </span>
                            @endrole
                        </div>
                    </div>
                    <div class="kt-chat__right">

                    </div>
                </div>
            </div>
            <div id="bacheca" class="kt-portlet__body scrolldiv" style="background: #f7f7f7; height: 300px; overflow: auto">
                

                    @if($messaggi->isNotEmpty())
                    <div class="kt-chat__messages">
                        @foreach($messaggi as $messaggio)
                        <div class="kt-chat__message {{(Auth::user()->id == $messaggio->autore_id) ? 'kt-chat__message--right':''}}">

                            <div class="kt-chat__user">
                                @if($messaggio->users->avatar_location != '')
                                <span class="kt-userpic kt-userpic--circle kt-userpic--sm">
                                     <img src="{{asset('storage/'.$messaggio->users->avatar_location)}}" alt="image">
                                </span>
                                @else
                                <span style="display:inline-block !important" class="kt-userpic kt-userpic--circle kt-userpic--danger kt-margin-r-5 kt-margin-t-5"><span>{{$messaggio->users->first_name[0]}} {{$messaggio->users->last_name[0]}}</span></span>
                                @endif
                                <a href="#" class="kt-chat__username"><span>{{$messaggio->users->first_name}} {{$messaggio->users->last_name}} {!!($messaggio->autore_id == $campagna->user_id) ? '<span class="kt-badge kt-badge--primary kt-badge--inline">'.__('applicazione.autore').'</span>':''!!}</span></a>
                                <span style="display:block;" class="kt-chat__datetime">{{$messaggio->created_at->formatLocalized('%d %B %Y')}}</span>
                            </div>
                            <div class="kt-chat__text {{(Auth::user()->id == $messaggio->autore_id) ? 'kt-bg-light-brand':'kt-bg-light-success'}}">
                                {{$messaggio->messaggio}}
                            </div>
                        </div>

                        @endforeach
                    </div>
                    @else
                    <div class="alert alert-light alert-elevate" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">{{__('applicazione.no_messaggi')}}</div>
                    </div>
                    @endif
               
            </div>
            <div class="kt-portlet__foot">
                <form id="messaggio" action="{{route('frontend.user.messaggio.create')}}" method="post" >
                    @csrf
                    <div class="kt-chat__input">
                        <div class="kt-chat__editor">
                            <textarea id="text_messaggio" name="messaggio" required maxlength="500" style="height: 50px" placeholder="{{__('applicazione.scrivi')}}"></textarea>
                            <input name="cmp" type="hidden" value="{{$campagna->uuid}}"/>
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