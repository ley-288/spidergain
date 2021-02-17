@extends('frontend.layouts.interna')

@section('title', app_name() . ' | ' . __('applicazione.richieste_aperte'))

@section('content')
@push('after-styles')


@endpush

@push('after-scripts')

@endpush

<div class="kt-holder kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">

    </div>
    <!-- begin:: Content -->
    <div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="row">
            <div class="col">

                <div class="kt-portlet kt-portlet--mobile">

                    <div class="kt-portlet__body">
                        
                        
                        {{__('applicazione.richieste_aperte_spiegazione')}}
                        
                    </div>
                </div>
            </div>
                
        </div>

        @if($campagne->isNotEmpty())

        @foreach($campagne as $campagna)
        @if($loop->first || ($loop->index % 4 == 1 && $loop->index != 1))

        <div class="row">
            @endif
            @include('frontend.campagne.boxcampagne')
            @if($loop->last || ($loop->index%4 == 0 && !$loop->first))
        </div>
        @endif
        @endforeach

        {{ $campagne->links() }}


        @else

        @include('includes.partials.empty',['element'=>__('applicazione.no_richieste')])




        @endif
        <!--End::Section-->

    </div>
    <!-- end:: Content -->

    @endsection
