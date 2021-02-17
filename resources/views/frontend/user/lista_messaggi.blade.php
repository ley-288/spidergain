

{{--
@if(count($messaggi) > 0)
    <a href="{{url('/')}}/dashboard" class="kt-menu__link kt-menu__toggle">
                    <i class="material-icons nav__icon" id="message_ico" style="color:red;" id="ico_head">message</i>
                        <span class="kt-menu__link-icon"> </span>
    @else
    <a href="{{url('/')}}/dashboard" class="kt-menu__link kt-menu__toggle">
                    <i class="material-icons nav__icon" id="message_ico" style="color:blue;" id="ico_head">message</i>
                        <span class="kt-menu__link-icon"> </span>
    @endif
--}}

<div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                @lang('applicazione.nuovi_messaggi')
            </h3>
        </div>
    </div>
    
     
    <div class="kt-portlet__body scrolldiv" style="overflow: auto">
        
        @if(count($messaggi) > 0)
        <div class="kt-widget4">
        @foreach($messaggi as $messaggio)
        
        
            <div class="kt-widget4__item" >
                <div class="kt-widget4__pic kt-widget4__pic--pic">
                    <a href="{{route('frontend.user.campagna.dettaglio',['uuid'=>$messaggio->uuid])}}">
                    @if($messaggio->avatar_location != '')
                    <img src="{{asset('storage/'.$messaggio->avatar_location)}}" alt="">
                    @else
                    <span class="kt-userpic kt-userpic--info">
                        <span>{{$messaggio->first_name[0]}} {{$messaggio->last_name[0]}}</span>
                    </span>
                    @endif
                     </a>
                </div>
                <div class="kt-widget4__info">
                   
                    <a href="{{route('frontend.user.campagna.dettaglio',['uuid'=>$messaggio->uuid])}}" class="kt-widget4__username">
                        {{$messaggio->first_name}} {{$messaggio->last_name}} - {{ strftime('%e %B %Y',strtotime($messaggio->created_at))}}
                    </a>
                    <p class="kt-widget4__text">
                         <span class="kt-badge kt-badge--danger kt-badge--inline">@lang('Nuovo')</span> <strong>@lang('applicazione.campagna'):</strong> {{$messaggio->titolo ?? __('applicazione.no_titolo')}}
                    </p>
                </div>
                <a href="{{route('frontend.user.campagna.dettaglio',['uuid'=>$messaggio->uuid])}}" class="btn btn-sm btn-label-brand btn-bold">@lang('applicazione.guarda_campagna')</a>
            </div>                
        
        @endforeach
        </div>
        @else
        @include('includes.partials.empty',['element'=>__('applicazione.no_messaggi')])
        @endif

        
    </div>
</div>