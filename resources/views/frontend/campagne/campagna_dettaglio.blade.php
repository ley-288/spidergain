{{-- 'Vai alla campagne' --}}


@extends('frontend.layouts.interna')

@section('title', app_name() . ' | ' . __('applicazione.campagna'))

@section('content')
@push('after-styles')

<style>
    @media (max-width: 768px) {
        .kt-widget3__header{
            flex-wrap: wrap
        }
        .kt-font-info{
            flex-grow: 0 !important;
            margin-top:7px;
            text-align: left;
        }
    }

</style>
<link href="{{url('/')}}/js/photo/magnific-popup.css" rel="stylesheet" type="text/css" />
@endpush

@push('after-scripts')
<script src="{{url('/')}}/assets/vendors/general/bootstrap-maxlength/src/bootstrap-maxlength.js" type="text/javascript"></script>
<script src="{{url('/')}}/js/bootstrap-maxlength.js" type="text/javascript"></script>
<script src="{{url('/')}}/js/photo/jquery.magnific-popup.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
$('.image-link').magnificPopup({type:'image', mainClass: 'mfp-fade'});
});</script>
@push('after-scripts')
<script>
   
    function startChat(influencer, el ){
        startChat.timer = setInterval(
            function(){
                let last = el.find('.kt-chat__message').last().data('id');
                if (typeof last === 'undefined') {
                    getMessages(influencer, el);
                }else{
                    getLastMessages(influencer, el, last);
                }
            },
    15000);
    }
    
    function stopChat(){
        clearInterval(startChat.timer);
    }
    function scroll(el){
        el.animate({
        scrollTop: el.get(0).scrollHeight+200
    }, 1);
    }
    $('.chats').on('show.bs.modal', function (e) {
    let el = $(this);
    let scrolldiv = el.find('.kt-portlet__body');
    scroll(scrolldiv);
    
    let influencer = $(this).data('influencer');
    getMessages(influencer, el);
    startChat(influencer,el);
       
    });
    
    $('.chats').on('hidden.bs.modal', function () {
         stopChat();
    });
   

            $('.chats .kt-chat__reply').click(function(e){
                e.preventDefault();
                let el = $(this);
                el.attr('disabled', true);
                let form = el.closest('form');
                let scrollDiv = el.closest('.chats');
                let modal = el.closest('.modal').find('.kt-chat__messages');
                let data = form.serialize();
                $.ajax({
                type: 'POST',
                        dataType : 'html',
                        url:'{{route('frontend.user.chat.send')}}',
                        data: data,
                        success: function(data){
                        modal.append(data);
                        el.attr('disabled', false);
                        form.find('textarea').val('');
                        scrollBottom(scrollDiv);
                        },
                        error: function(){
                        alert('@lang('Errore.Riprovare più tardi')');
                        el.attr('disabled', false);
                        }
                });
    });
    function getMessages(influencer, el) {
            $.ajax({
            type:'GET',
                    dataType:'html',
                    url:'{{route('frontend.user.chat.get')}}',
                    data:{
                    _token: "{{ csrf_token() }}",
                            cmp : "{{$campagna->uuid}}",
                            influencer : influencer
                    },
                    success: function(data) {
                    el.find('.kt-chat__messages').html(data);
                    scrollBottom(el);
                    },
                    error: function(){
                    alert('@lang('Errore.Riprovare più tardi')');
                    }
            });
    }
    
    function getLastMessages(influencer, el, last) {
    $.ajax({
    type:'GET',
            dataType:'html',
            url:'{{route('frontend.user.chat.last')}}',
            data:{
            _token: "{{ csrf_token() }}",
                    cmp : "{{$campagna->uuid}}",
                    influencer : influencer,
                    last: last
            },
            success: function(data) {
                
            
            removeread();
                
            el.find('.kt-chat__messages').append(data);
            if(data != ''){
            scrollBottom(el);
        }
            },
            error: function(){
            alert('@lang('Errore.Riprovare più tardi')');
            }
    });
    }
    
    function scrollBottom(el){
        el.find('.kt-portlet__body').animate({
        scrollTop: el.find('.kt-portlet__body').get(0).scrollHeight
    }, 1);
    };
    function removeread(){
        $('.read-label').remove();
    };
    $('.kt-portlet__body').animate({
        scrollTop: $('.kt-portlet__body').get(0).scrollHeight
    }, 1);
</script>
@endpush
@endpush

<div class="kt-holder kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">


    </div>
    <!-- begin:: Content -->
    <div class="kt-content kt-grid__item kt-grid__item--fluid">
        @include('includes.partials.back')
        <div class="kt-portlet ">
            <div class="kt-portlet__body">
                <div class="kt-widget kt-widget--user-profile-3">
                    <div class="kt-widget__top">
                        @if($campagna->users->avatar_location != '')
                        <div class="kt-widget__media kt-hidden-">
                            <img src="{{asset('storage/'.$campagna->users->avatar_location)}}" style="border:1px solid black ;" alt="image">
                        </div>
                        @else
                        <div class="kt-widget__pic kt-widget__pic--primary kt-font-danger kt-font-boldest kt-font-light kt-hidden-">
                            {{$campagna->users->first_name[0]}} {{$campagna->users->last_name[0]}}
                        </div>
                        @endif
                        <div class="kt-widget__content">
                            <div class="kt-widget__head">

                                <a href="#" class="kt-widget__title">{{$campagna->titolo}}</a>
                                <a href="#" class="kt-widget__username kt-hidden-">
                                    <!--                                    {{$campagna->users->first_name}} {{$campagna->users->last_name}}
                                                                        <i class="flaticon2-correct"></i>-->
                                </a>
                                @if(Auth::user()->id === $campagna->user_id)
                                <div style="margin-left: auto;" class="kt-widget__action">

                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{__('applicazione.azioni')}}
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">

                                            <a href="{{route('frontend.user.campagne.influencer',$campagna->uuid)}}" class="dropdown-item"><i class="fa fa-search"></i> {{__('applicazione.start_ricerca')}}</a>&nbsp;
                                            <a href="{{route('frontend.user.campagne.modifica',$campagna->uuid)}}" class="dropdown-item "><i class="fa fa-edit"></i> {{__('applicazione.modifica')}}</a>&nbsp;
                                            @if($campagna->active == 1)
                                            <a href="{{route('frontend.user.campagne.disattiva',$campagna->uuid)}}" class="dropdown-item"><i class="fa fa-power-off"></i> {{__('applicazione.disattiva')}}</a>&nbsp;
                                            @else
                                            <a href="{{route('frontend.user.campagne.disattiva',$campagna->uuid)}}?attiva" class="dropdown-item"><i class="fa fa-power-off"></i> {{__('applicazione.attiva')}}</a>&nbsp;
                                            @endif
                                            <div class="dropdown-divider"></div>
                                            <a onclick="return confirm('{{__('applicazione.conferma_cancella')}}');" href="{{route('frontend.user.campagne.cancella',$campagna->uuid)}}" class="dropdown-item btn-upper"><i class="fa fa-trash"></i> {{__('applicazione.cancella')}}</a>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="kt-widget__subhead kt-hidden-">
                                <p><strong>{{__('applicazione.autore')}}:</strong>  <a target="_blank" href="{{route('frontend.user.brand.get',$campagna->users->uuid)}}">{{$campagna->users->first_name}} {{$campagna->users->last_name}}</a></p>
                            </div>
                            <div class="kt-widget__info">
                                <div class="kt-widget__desc">
                                    {!! clean($campagna->descrizione) !!}
                                    <div class="allegati">

                                        @if($campagna->allegati != '')
                                        @php
                                        $immagini = json_decode($campagna->allegati,true);
                                        @endphp
                                        <div class="immagini">
                                            @foreach($immagini as $key=>$immagine)
                                            @if($immagine != '')
                                           <a href="{{asset('storage/'.$immagine)}}" class="image-link" title="@lang('Immagine Campagna') - {{$campagna->titolo}}">
                                                <img src="{{asset('storage/'.$immagine)}}" alt="image" />
                                            </a>
                                            @endif
                                            @endforeach
                                        </div>
                                        @endif
                                        @foreach($allegati as $allegato)
                                        @if(strtolower($allegato->ext) != 'pdf')
                                        <div class="allegato-container">
                                            <div class="allegati_placeholder">
                                                <img src="{{asset('storage/allegati/'.$allegato->filename)}}" />
                                            </div>
                                            <a target="_blank" class="btn btn-sm btn-brand btn-block" href="{{asset('storage/allegati/'.$allegato->filename)}}" title="">@lang('applicazione.apri_allegato')</a>
                                        </div>
                                        @else
                                        <div class="allegato-container">
                                            <div class="allegati_placeholder">
                                                <img src="{{asset('img/frontend/pdf.jpg')}}" />
                                            </div>
                                            <a target="_blank" class="btn btn-sm btn-brand btn-block" href="{{asset('storage/allegati/'.$allegato->filename)}}" title="">@lang('applicazione.apri_allegato')</a>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                    <div class="budget">
                                        <p><strong>@lang('applicazione.budget')</strong></p>
                                        @if($campagna->budget != '' || $campagna->budget != null)
                                        <p>{{$campagna->budget}} € / {{__('applicazione.budget_'.$campagna->budget_periodo)}}</p>
                                        @else
                                        <p>@lang('applicazione.nobudget')</p>
                                        @endif
                                    </div>
                                    @if(!empty($campagna->comuni))
                                    <div class="citta">
                                        <p><strong>@lang('Città')</strong></p>
                                        <p>
                                            @foreach($campagna->comuni as $comune)
                                            <span class="badge badge-sm badge-light"><i class="fa fa-map-marker-alt"></i> {{$comune->nome}}</span>
                                            @endforeach
                                        </p>
                                    </div>
                                    @endif
                                </div>
                                <div class="kt-widget__stats d-flex align-items-center flex-fill">

                                    <div class="kt-widget__item flex-fill">
                                        <span class="kt-widget__date">
                                            {{__('applicazione.inizio_campagna')}}
                                        </span>
                                        <div class="kt-widget__label">
                                            <span class="btn btn-label-brand btn-sm btn-bold btn-upper">{{date('d/m/Y',strtotime($campagna->data_inizio))}}</span>
                                        </div>
                                    </div>
                                    <div class="kt-widget__item flex-fill">
                                        <span class="kt-widget__date">
                                            {{__('applicazione.fine_campagna')}}
                                        </span>
                                        <div class="kt-widget__label">
                                            <span class="btn btn-label-danger btn-sm btn-bold btn-upper">{{date('d/m/Y',strtotime($campagna->data_fine))}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-widget__stats d-flex align-items-center flex-fill">

                                    <div class="kt-widget__item flex-fill">
                                        <span class="kt-widget__subtitel">{{__('applicazione.avanzamento')}}</span>
                                        <div class="kt-widget__progress d-flex  align-items-center">
                                            <div class="progress" style="height: 5px;width: 100%;">
                                                <div class="progress-bar kt-bg-success" role="progressbar" style="width:{{$days_perc}}%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <span class="kt-widget__stat">
                                                {{number_format($days_perc,0)}}%
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="position:relative" class="kt-widget__bottom kt-margin-t-50">
                        <p class="label-canali">@lang('applicazione.lista_canali')</p>
                        @foreach($canali_view as $item)
                        <div class="kt-widget__item">
                            <div class="kt-widget__icon">
                                <i class="{{$item['icon']}}"></i>
                            </div>
                            <div class="kt-widget__details">
                                <span class="kt-widget__title">{{$item['name']}}</span>
    <!--                            <span class="kt-widget__value"><span>$</span>249,500</span>-->
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>

        @if($campagna->active != 0 && $campagna->data_fine >= date('Y-m-d')  )
        @include('includes.partials.messages')
        @role('influencer')
        @if(isset($richiesta))
        @if($richiesta->accettata == 2)
        @if($budget <= 0)
        @include('frontend.campagne.no_budget')
        @else
        @include('frontend.campagne.invia_offerta')
        @endif
        @elseif($richiesta->accettata == 1 && $richiesta->offerta_accettata == 1)
        @include('frontend.campagne.influencer_attiva')
        @elseif($richiesta->accettata == 1 && $richiesta->offerta_accettata === null && $richiesta->offerta_rifiutata === null)
        <div class="row">
            <div class="col-lg-6">
                <div style="margin:20px auto" class="alert alert-warning" role="alert">
                    <strong>{{__('applicazione.offerta_non_ancora_accettata')}}</strong>
                </div>
            </div>
            <div class="col-lg-6">
                @include('frontend.campagne.offerta',['box'=>'yes'])
            </div>
        </div>
        @else
        <div class="row">
            <div class="col-lg-6">
                <div class="alert alert-danger" role="alert">
                    <strong>{{__('applicazione.offerta_non_accettata')}}</strong>
                </div>
            </div>
            <div class="col-lg-6">
                @include('frontend.campagne.offerta',['box'=>'yes'])
            </div>
        </div>

        @endif
        @else
        @if($budget <= 0)
        @include('frontend.campagne.no_budget')
        @else
        @include('frontend.campagne.invia_offerta')
        @endif
        @endif
        @else
        @include('frontend.campagne.brand_attiva')
        @endrole
        @endif

        <!-- end:: Content -->
        </br></br></br>
    </div>

    @endsection
