

<div class="kt-portlet">
    <div class="kt-portlet__body">
        <div class="kt-widget kt-widget--user-profile-3">
            <div class="kt-widget__top">
                
                 @if($user->avatar_location != '')
                        <div class="kt-widget__media kt-hidden-">
                            <img src="{{asset('storage/'.$user->avatar_location)}}" alt="image">
                        </div>
                        @else
                        <div class="kt-widget__pic kt-widget__pic--primary kt-font-danger kt-font-boldest kt-font-light kt-hidden-">
                            {{$user->first_name[0]}} {{$user->last_name[0]}}
                        </div>
                        @endif
                
                <div class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-boldest kt-font-light kt-hidden">
                    {{$user->first_name}}{{ $user->last_name}}
                </div>
                <div class="kt-widget__content">
                    <div class="kt-widget__head">
                        <a href="{{route('frontend.user.influencer.get',$user->uuid)}}" class="kt-widget__username">
                            {{$user->name}}
                           @if($user->verified == 1)
                           <i class="flaticon2-correct kt-font-brand"></i> <span class="kt-badge kt-badge--inline kt-badge--brand">@lang('applicazione.verificato')</span>
                           @endif
                        </a>
                        <div class="kt-widget__action">
                            <a href="{{route('frontend.user.influencer.get',$user->uuid)}}" target="_blank" type="button"  class="btn  btn-label-success btn-sm btn-upper">{{__('applicazione.vedi_profilo')}}</a>&nbsp; 
                            <button type="button" {{$user->invitato ? 'disabled' : ''}} data-influencer="{{$user->uuid}}" class="btn btn-brand btn-sm richiesta btn-upper">{!!$user->invitato ? '<i class="flaticon2-check-mark"></i> ' .__('applicazione.richiesta_inviata') : __('applicazione.invia_richiesta')!!}</button>
                        </div>
                    </div>
                    <div class="kt-widget__subhead">
                       
                        <a href="#"><i class="flaticon2-calendar-3"></i>{{$user->ruolo}}</a>
                       <!-- <a href="#"><i class="flaticon2-placeholder"></i>{{$user->residenza_citta}}</a> -->
                    </div>
                    <div class="kt-widget__info">
                        <div class="kt-widget__desc">
                            {!! $user->descrizione !!}
                        </div>
                        <div class="kt-widget__progress">
                            <div class="kt-widget__text">
                                {{ __('applicazione.giudizi_positivi') }}
                            </div>
                           
                            <div class="progress" style="height: 5px;width: 100%;">
                                <div class="progress-bar kt-bg-success"
                                     role="progressbar" style="width: {{isset($user->recensione) ? $user->recensione * 10 : 0}}%;"
                                     aria-valuenow="{{isset($user->recensione) ? $user->recensione * 10 : 0}}" aria-valuemin="0"
                                     aria-valuemax="100"></div>
                            </div>
                            <div class="kt-widget__stats">
                                
                                {{isset($user->recensione) ? round(($user->recensione*10),1).'%' : __('applicazione.nessuna_recensione')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-widget__bottom">
                @if($campagna->tipologia == 'online')
                @php
                $canali = json_decode($campagna->canali);
                @endphp
                @foreach($canali as $canale)
                @if($user->$canale != '')
                    <div class = "kt-widget__item">
                        <div class = "kt-widget__icon">
                            @if($canale == 'blog')
                              <i class = "fas fa-laptop"></i>
                            @elseif($canale == 'mailing_list')
                              <i class = "fa fa-envelope-open-text"></i>
                            @else
                            <i class = "fab fa-{{$canale}}"></i>
                            @endif
                        </div>
                        <div class = "kt-widget__details">
                            <span class = "kt-widget__title"><?php echo __('applicazione.'.$canale.'_follower') ?></span>
                            
                            <span class = "kt-widget__value"><?php echo number_format($user->{$canale.'_follower'},0,',','.')  ?></span>
                            
                        </div>
                    </div>
                @endif
                @endforeach
                @else
                 @php
                $canali = json_decode($campagna->canali);
                @endphp
                @foreach($canali as $canale)
                @if($user->$canale != '')
                    <div class = "kt-widget__item">
                        <div class = "kt-widget__details">
                            <span class = "kt-widget__title">{{__('applicazione.'.$canale.'_follower')}}</span>
                            @switch($canale)
                            @case('giornale_tiratura')
                            @php $valore = $user->giornale_tiratura @endphp
                            @break
                            @case('negozio_metri')
                            @php $valore = $user->negozio_metri @endphp
                            @break
                            @case('eventi_numero')
                            @php $valore = $user->eventi_numero @endphp
                            @endswitch
                            <span class = "kt-widget__value">{{$valore}}</span>
                            
                        </div>
                    </div>
                 @endif
                @endforeach
                   
                @endif
                 <div class="kt-widget__item">
                                    <div class="kt-widget__icon">
                                        <i class="flaticon-file-2"></i>
                                    </div>
                                    <div class="kt-widget__details">
                                        <span class="kt-widget__title">{{$user->numero_campagne}} Campagne</span>
                                        <a href="#" class="kt-widget__value kt-font-brand"></a>
                                        <p class="kt-widget__value kt-font-brand">{{__('applicazione.dal').' '.$user->created_at->formatLocalized('%d %B %Y')}}</p>
                                    </div>
                                </div>
                                <div class="kt-widget__item">
                                    <div class="kt-widget__icon">
                                        <i class="flaticon-chat-1"></i>
                                    </div>
                                    <div class="kt-widget__details">
                                        <span class="kt-widget__title">{{$user->numero_recensioni}} recensioni</span>
                                        <a href="{{route('frontend.user.influencer.get',$user->uuid)}}" class="kt-widget__value kt-font-brand">Vedi</a>
                                    </div>
                                </div>
              
            </div>
        </div>
    </div>
</div>