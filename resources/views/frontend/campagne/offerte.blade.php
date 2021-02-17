<div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                {{__('applicazione.offerte_ricevute')}}
            </h3>
        </div>

    </div>
    <div class="kt-portlet__body">
        @if($offerte_ricevute->isNotEmpty())
        <div class="kt-widget4">
            @foreach($offerte_ricevute as $item)
            <div class="kt-widget4__item" style="padding: 7px;border: 3px solid #1dc9b7;">
                @if($item->users->avatar_location != '')
                <div class="kt-widget4__pic kt-widget4__pic--pic">
                    <a href="{{route('frontend.user.influencer.get',['uuid'=>$item->users->uuid])}}"><img src="{{asset('storage/'.$item->users->avatar_location)}}" alt=""></a>
                </div>
                @else
              
                <span class="kt-userpic kt-userpic--info kt-margin-r-5 kt-margin-t-5">
                     <a href="{{route('frontend.user.influencer.get',['uuid'=>$item->users->uuid])}}"> <span>{{$item->users->first_name[0]}} {{$item->users->last_name[0]}}</span></a>
                </span>
                
                @endif
                <div class="kt-widget4__info">
                    <a href="{{route('frontend.user.influencer.get',['uuid'=>$item->users->uuid])}}" class="kt-widget4__username">
                        {{$item->users->first_name}} {{$item->users->last_name}}
                    </a>
                    <p class="kt-widget4__text">
                        {{$item->users->dettagli->ruolo}}
                    </p>
                </div>

                <a href="#" data-toggle="modal" data-target="#modal-{{$loop->index}}" class="btn btn-sm btn-label-brand btn-bold">{{__('applicazione.guarda_offerta')}}</a>
                <div class="modal fade" id="modal-{{$loop->index}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Offerta</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body scrolldiv" style="height: 400px; overflow: auto">
                                {!! clean($item->offerta) !!}
                                @if($item->importo != '')
                                <p><strong>@lang('applicazione.importo'): </strong>{{number_format($item->importo,0,',','.')}}€</p>
                                @endif
                            </div>
                            <div class="modal-footer">
                                
                                <form id="accetta_offerta_{{$loop->index}}" action="{{route('frontend.user.accetta.offerta')}}" method="post">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('applicazione.chiudi')}}</button>
                                    <button type="button" class="btn btn-danger rifiuta" data-dismiss="modal">{{__('applicazione.rifiuta')}}</button>
                                    @csrf
                                    <input type="hidden" name="cmp" value="{{$campagna->uuid}}"/>
                                    <input type="hidden" name="offerta_id" value="{{$item->id}}" />
                                    <button type="submit" class="btn btn-primary">{{__('applicazione.accetta_offerta')}}</button>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="alert alert-warning" role="alert">
            <div class="alert-icon"><i class="flaticon-warning"></i></div>
            <div class="alert-text">{{__('applicazione.no_offerte')}}</div>
        </div>
        @endif


    </div>
</div>
@push('after-scripts')

<script>
    
    $(document).ready(function () {
        
        $('.rifiuta').click(function(){
            var form = $(this).parents('form:first');
         
            form.append('<input type="hidden" name="rifiuta" value="1" />');
            form.submit();
        });
        
        
        $('.btn').click(function () {

            
            

        });
    });
</script>

@endpush