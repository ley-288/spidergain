@push('after-scripts')

<script src="{{url('/')}}/js/maxlength.js"></script>
<script>
$(document).ready(function () {
    $('#invia').click(function () {
        if ($('#invia_offerta').val() != '') {

            $(this).addClass('kt-spinner kt-spinner--center kt-spinner--sm kt-spinner--light');
            $(this).height($(this).height());
            $(this).html('');

        }
    });
});
</script>
<script src="{{url('/')}}/assets/vendors/general/summernote/dist/summernote.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/vendors/general/summernote/dist/lang/summernote-it-IT.js" type="text/javascript"></script>
<script src="{{url('/')}}/js/editor.js" type="text/javascript"></script>
<script>


$(function () {
    registerSummernote('.summernote', '', 1000, function (max) {
        $('#maxContentPost').text(max)
    });
});

</script>
@endpush
@push('after-styles')
<link href="{{url('/')}}/assets/vendors/general/summernote/dist/summernote.css" rel="stylesheet" type="text/css" />
@endpush
<div class="row">
    <div class="col-lg-6 col-push-3">
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="flaticon2-send"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        {{__('applicazione.invia_offerta')}}
                    </h3>
                </div>
            </div>
            <form action="{{route('frontend.user.offerta.create')}}" method="post">
                <div class="kt-portlet__body">
                    <div class="col-lg-12 m--valign-middle">
                        @include('includes.partials.messages')
                        <div class="form-group row">
                            <div class="col-lg-12">
                                @csrf 
                                <label class="col-form-label">{{__('applicazione.descrivi_offerta')}}</label>
                                <textarea name="offerta" required id="invia_offerta" class="form-control summernote"  maxlength="1000" placeholder="" rows="6"></textarea>
                                <span class="form-text text-muted">{{__('applicazione.offerta_dettagliata')}}</span>
                                <span class="form-text text-muted text-right" id="maxContentPost"></span>
                                <input name="cmp" type="hidden" value="{{$campagna->uuid}}" />

                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                @csrf 
                                <label class="col-form-label">@lang('applicazione.inserisci_importo') </label>
                                <div class="input-group">
                                    <input required min="1" step="1" pattern="\d+" type="number" name="importo" class="form-control" placeholder="@lang('applicazione.importo')" aria-describedby="basic-addon2">
                                    <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="la la-euro"></i></span></div>
                                </div>
                                 <span class="text-muted form-text">@lang('Indicare l\'importo totale incluso di un\'eventuale IVA')</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__foot">
                    <div class="row align-items-center">

                        <div class="col-lg-12">
                            <button type="submit" id="invia" class="btn btn-brand btn-block">{{__('applicazione.invia')}}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>