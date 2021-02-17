<div class="modal fade" id="offerta_{{$loop->index}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{__('applicazione.offerta')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
         
                <div class="modal-body scrolldiv" style="height: 350px; overflow: auto">
                  {!! clean($item->richieste[0]->offerta) !!}
                   
                   @if($item->richieste[0]->importo != '')
                   <p><strong>@lang('applicazione.importo'):</strong> {{number_format($item->richieste[0]->importo,0,',','.')}}€ </p>
                   @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('applicazione.chiudi')}}</button>
                    
                </div>
                
            </form>
        </div>
    </div>
</div>