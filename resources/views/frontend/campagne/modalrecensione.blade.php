<div class="modal fade" id="recensione_{{$loop->index}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{__('applicazione.lascia_recensione')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form name="recensione_{{$loop->index}}" class="invia-recensione-form" id="recensione_form_{{$loop->index}}"  method="post" action="{{route('frontend.user.recensione.create')}}">
                @csrf
                <div class="modal-body">
                    <div style="display:none" class="alert alert-danger fade show" role="alert">
                        <div class="alert-text">A simple danger alert—check it out!</div>
                        <div class="alert-close">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"><i class="la la-close"></i></span>
                            </button>
                        </div>
                    </div>
                    <div class="kt-radio-list">
                        @for($i=1; $i<=5; $i++)
                        <label class="kt-radio kt-radio--bold kt-radio--brand">
                            <input required type="radio" value="{{$i}}" name="radio6"> 
                                @for($j=1; $j<=$i; $j++)
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon id="Shape" points="0 0 24 0 24 24 0 24"></polygon>
                                        <path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" id="Star" fill="#000000" ></path>
                                    </g>
                                </svg>
                                @endfor
                                <span></span>
                        </label>
                        @endfor
                        <textarea class="form-control" style="position: relative" name="descrizione" id="descrizione" maxlength="500" placeholder="" rows="6"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('applicazione.chiudi')}}</button>
                    <button type="submit" class="btn btn-primary invia-recensione">{{__('applicazione.invia_recensione')}}</button>
                </div>
                <input type="hidden" value="{{$campagna->uuid}}" name="campagna"/>
                <input type="hidden" value="{{$item->uuid}}" name="influencer"/>
            </form>
        </div>
    </div>
</div>
@push('after-scripts')
<script>

    
    $(document).ready(function () {
        $('.invia-recensione-form').submit(function (e) {
           
            var el = $(this);
            el.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light');
            
        });
    });


</script>
@endpush