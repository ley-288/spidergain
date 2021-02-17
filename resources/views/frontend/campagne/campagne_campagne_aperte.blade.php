@extends('frontend.layouts.interna')

@section('title', app_name() . ' | ' . __('applicazione.campagne'))

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
        @if(Auth::user()->role('influencer') && Route::current()->getName() != 'frontend.user.cercacampagne')
      
            <div class="col">
                <div class="kt-portlet kt-portlet--mobile">

                    <div class="kt-portlet__body">
                        @if(Route::current()->getName() === 'frontend.user.campagne.aperte.index')
                        {{__('applicazione.campagne_aperte_spiegazione')}}
                        @elseif(Route::current()->getName() === 'frontend.user.campagne.chiuse.index')
                        {{__('applicazione.campagne_chiuse_spiegazione')}}
                        @endif
                    </div>
                </div>

            </div>
        
        @endif
        @if(count($campagne))
        <div class="row">
            @foreach($campagne as $campagna)
            
            @include('frontend.campagne.boxcampagne_lista')

            @endforeach
        </div>
        {{ $campagne->links() }}
        
        @else

        @include('includes.partials.empty',['element'=>__('applicazione.no_campagne')])

        @endif
        <!--End::Section-->

    </div>
    <!-- end:: Content -->

    @endsection
