@extends('frontend.layouts.interna')

@section('title', app_name() . ' | ' . __('applicazione.ricerca'))

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
                el.html('{{__('applicazione.richiesta_inviata')}}');
                el.attr('disabled', 'disabled');

            }).fail(function (jqXHR, textStatus, errorThrown) {
                
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
        

    </div>
    <!-- begin:: Content -->
    <div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">

        @if($users->isNotEmpty())
        @include('includes.partials.back')
        <div class="row">
            <div class="col-lg-12 push-6">
                <div class="kt-portlet kt-portlet--mobile">
                    <div class="kt-portlet__body">
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


      
         
        @include('includes.partials.empty',['element'=>__('applicazione.no_influencer')])
        <div class="col-xl-12"> <a href="{{ route('frontend.user.campagne.modifica',['uuid'=>$campagna->uuid]) }}" class="btn btn-lg text-center btn-block btn-light kt-margin-t-20">@lang('applicazione.indietro')</a></div>
        @endif
        <!--End::Section-->
    </div>
    <!-- end:: Content -->


    @endsection
