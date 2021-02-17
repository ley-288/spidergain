@push('after-scripts')
<script src="{{url('/')}}/js/read.js" type="text/javascript"></script>

@endpush

<div class="kt-portlet kt-portlet--height-fluid">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                {{__('applicazione.offerte_accettate')}}

            </h3>
        </div>

    </div>
    <div class="kt-portlet__body">
        <div class="kt-widget3">
            @if($influencer_attivi->isNotEmpty())
            @foreach($influencer_attivi as $item)

            <div class="kt-widget3__item">
                <div class="kt-widget3__header">
                    @if($item->avatar_location != '')
                    <div class="kt-widget3__user-img">
                        <img class="kt-widget3__img" src="{{asset('storage/'.$item->avatar_location)}}" alt="">
                    </div>
                    @else
                    <span class="kt-userpic kt-userpic--info kt-margin-r-5 kt-margin-t-5">
                        <span>{{$item->first_name[0]}} {{$item->last_name[0]}}</span>
                    </span>
                    @endif
                    <div class="kt-widget3__info">
                        @if(count($item->recensioni))
                        @php $voto = $item->recensioni[0]->voto @endphp
                        <span class="stelle-recensioni">
                            @include('frontend.recensioni.stelle')
                        </span>
                        @endif
                        <a href="{{route('frontend.user.influencer.get',$item->uuid)}}" class="kt-widget3__username">
                            {{$item->first_name}} {{$item->last_name}}
                        </a><br>
                        <span class="kt-widget3__time">
                            @lang('applicazione.accettata_il') {{ strftime('%e %B %Y',strtotime($item->richieste[0]->offerta_accettata_at))}}

                        </span>
                    </div>
                  
                    <span class="kt-widget3__status kt-font-info">
                        <div class="btn-group btn-group" role="group" aria-label="...">            
                            @if(Auth::user()->id == 165)
                            
                            @endif
                            
                            <button type="button" class="btn btn-brand leggi" data-tkn="{{csrf_token()}}" data-usr="{{$item->uuid}}" data-cmp="{{$campagna->uuid}}" data-url="{{route('frontend.user.leggi')}}" data-toggle="modal" data-target="#messaggi_{{$loop->index}}">@lang('Chat') <?php echo ((!$item->letto)) ? '<span class="kt-badge kt-badge--danger kt-badge--inline">'.__('applicazione.non_letti').'</span>':'' ?></button>
                            <button type="button" class="btn btn-brand"  data-toggle="modal" data-target="#offerta_{{$loop->index}}">@lang('applicazione.vedi_offerta')</button>

                            @if(count($item->recensioni))
                            <a href="#" data-toggle="modal" data-target="#recensione_dettaglio_{{$loop->index}}" class="btn btn-brand ">{{__('applicazione.vedi_recensione')}}</a>
                            @else
                            <button type="button" class="btn  btn-brand" data-toggle="modal" data-target="#recensione_{{$loop->index}}">{{__('applicazione.recensisci')}}</button>
                            @endif
                        </div>
                    </span>
                </div>
            </div>
            @include('frontend.campagne.modalmessaggi')
            @include('frontend.campagne.modalofferta')
            @if(count($item->recensioni))
            @include('frontend.campagne.modalrecensionedettaglio')
            @else
            @include('frontend.campagne.modalrecensione')
            @endif
            @endforeach
            @else
            <div class="alert alert-success" role="alert">
                <div class="alert-icon"><i class="flaticon-warning"></i></div>
                <div class="alert-text">{{__('applicazione.no_offerte_accettate')}}</div>
            </div>
            @endif

        </div>
    </div>
</div>