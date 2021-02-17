@extends('frontend.layouts.interna')

@section('title', app_name() . ' | ' . __('applicazione.faq'))

@section('content')
@push('after-styles')
<style>
video {
  width: 100%;
  max-height: 100%;
}
</style>
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
            <div class="col-xl-12">
                <div class="kt-portlet ">
                    <div class="kt-portlet__body">
                        <h2>@lang('Video Tutorial')</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4">
                <div class="kt-portlet ">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                @lang('Campagna locale')
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        
                                <video controls>
                                    @if(Auth::user()->hasRole('influencer'))
                                      <source src="https://www.spidergain.com/video/SpiderGain-tutorial-Campagna-Locale-INFUENCER.mp4" type="video/mp4">
                                    @else
                                      <source src="https://www.spidergain.com/video/SpiderGain-tutorial-Campagna-Locale-AZIENDA.mp4" type="video/mp4">
                                    @endif
                                   
                                    
                                    Your browser does not support the video tag.
                                </video>
                                
                            
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="kt-portlet ">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                @lang('Campagna Nazionale')
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        
 <video controls>
                                @if(Auth::user()->hasRole('influencer'))
                                <source src="https://www.spidergain.com/video/SpiderGain-tutorial-campagna-Nazionale-INFLUENCER.mp4" type="video/mp4">
                                @else
                                <source src="https://www.spidergain.com/video/SpiderGain-tutorial-Campagna-Nazionale-AZIENDA.mp4" type="video/mp4">
                                @endif
 </video>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="kt-portlet ">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                @lang('Campagna tradizionale')
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                         <video controls>
                                @if(Auth::user()->hasRole('influencer'))
                                <source src="https://www.spidergain.com/video/SpiderGain-tutorial-Campagna-OffWeb-INFLUENCER.mp4" type="video/mp4">
                                @else
                                 <source src="https://www.spidergain.com/video/SpiderGain-tutorial-Campagna-OffWeb-AZIENDA.mp4" type="video/mp4">
                                @endif
                         </video>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end:: Content -->


    @endsection
