<div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                @lang('applicazione.nuove_offerte')
            </h3>
        </div>
    </div>
       <div class="kt-portlet__body scrolldiv" style="overflow: auto">
        
        @if(count($richieste) > 0)
        
        @foreach($richieste as $richiesta)
        <div class="kt-widget4">
            <div class="kt-widget4__item offerta-ricevuta-home">
                <div class="kt-widget4__pic kt-widget4__pic--pic">
                    <a href="{{route('frontend.user.influencer.get',['uuid'=>$richiesta->users->uuid])}}">
                    @if($richiesta->users->avatar_location != '')
                    <img src="{{asset('storage/'.$richiesta->users->avatar_location)}}" alt="">
                    @else
                    <span class="kt-userpic kt-userpic--info">
                        <span>{{$richiesta->users->first_name[0]}} {{$richiesta->users->last_name[0]}}</span>
                    </span>
                    @endif
                     </a>
                </div>
                <div class="kt-widget4__info">
                    <a href="{{route('frontend.user.influencer.get',['uuid'=>$richiesta->users->uuid])}}" class="kt-widget4__username">
                        {{$richiesta->users->first_name}} {{$richiesta->users->last_name}} - {{ strftime('%e %B %Y',strtotime($richiesta->accettata_at))}}
                    </a>
                    <p class="kt-widget4__text">
                        <strong>@lang('applicazione.campagna'):</strong> {{$richiesta->campagne->titolo ?? __('applicazione.no_titolo')}}
                    </p>
                </div>
                <a href="{{route('frontend.user.campagna.dettaglio',['uuid'=>$richiesta->campagne->uuid])}}" class="btn btn-sm btn-label-brand btn-bold">@lang('applicazione.guarda_campagna')</a>
            </div>                
        </div>
        @endforeach
        @else
        @include('includes.partials.empty',['element'=>__('applicazione.no_offerte')])
        @endif

       
    </div>
</div>