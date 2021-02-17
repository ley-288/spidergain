@extends('frontend.layouts.interna')

@section('title', app_name() . ' | ' . __('applicazione.profilo'))

@section('content')
@push('after-styles')


@endpush

@push('after-scripts')

<script>
    $(document).ready(function () {
        $('.richiesta').click(function (e) {
            e.preventDefault();
            var el = $(this);
            $(this).addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light');

            var token = '{{csrf_token()}}';
            var influencer = $(this).data('influencer');

            $.ajax({

                type: 'POST',
                url: '{{route('frontend.user.richiesta.create')}}',
                data: {_token: token, cmp: '{{$campagna -> uuid}}', i_id: influencer}
            }).done(function (data) {
                el.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light');
                el.html('richiesta_inviata');
                el.attr('disabled', 'disabled');

            }).fail(function (jqXHR, textStatus, errorThrown) {
                alert();
                el.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light');
                el.html('errore_richiesta');
            });
        });
    });



</script>
@endpush

<div class="kt-holder kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title"> La tua campagna </h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home"><i
                        class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Ricerca influencer</a>

                <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
            </div>
        </div>

    </div>
    <!-- begin:: Content -->
    <div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">

        @if($users->isNotEmpty())
        <div class="row">
            <div class="col-lg-3 push-6">
                <div class="kt-portlet kt-portlet--mobile">
                    <div class="kt-portlet__body">
<!--                        <form action="" method="get">
                        <div class="form-group">
                            <label for="exampleSelects">Ordina per:</label>
                            <select onchange="this.form.submit()" class="form-control form-control-sm" id="exampleSelects">
                                <option value="">Scegli</option>
                                <option value="campagne">Numero di Campagne</option>
                                <option value="recensioni">Recensioni</option>
                                <option value="popolarita">Popolarità</option>
                            </select>
                        </div>
                        </form>    -->
<p> <strong>Ordina per :</strong></p><p><a class="btn btn-success btn-small" href="{{url('/campagne/'.$campagna->uuid.'/influencer?ord=campagne')}}">Numero di campagne</a> <a class="btn btn-success btn-small" href="{{url('/campagne/'.$campagna->uuid.'/influencer?ord=recensioni')}}">Recensioni</a>  <a class="btn btn-success btn-small" href="{{url('/campagne/'.$campagna->uuid.'/influencer?ord=popolarita')}}">Popolarità</a></p>
                    </div>
                </div>
            </div>
        </div>
        @foreach($users as $user)

        @include('frontend.campagne.boxinfluencer')
        @endforeach

        {{ $users->links() }}


        @else


        <h2>Nessun influencer per la tua ricerca</h2>

        @endif
        <!--End::Section-->
    </div>
    <!-- end:: Content -->


    @endsection
