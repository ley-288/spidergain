@extends('frontend.layouts.interna')

@section('title', app_name() . ' | ' . __('applicazione.acquista_crediti'))

@section('content')
@push('after-styles')
<link href="{{url('/')}}/css/pricing-1.css" rel="stylesheet" type="text/css" />
<link href="{{url('/')}}/fonts/flaticon.css" rel="stylesheet" type="text/css" />
@endpush

@push('after-scripts')

@endpush

<style>

.strikethrough {
  position: relative;
}
.strikethrough:before {
  position: absolute;
  content: "";
  left: 0;
  top: 50%;
  right: 0;
  border-top: 1px solid;
  border-color: inherit;

  -webkit-transform:rotate(-5deg);
  -moz-transform:rotate(-5deg);
  -ms-transform:rotate(-5deg);
  -o-transform:rotate(-5deg);
  transform:rotate(-5deg);
}
</style>

<div class="kt-holder kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">


    </div>
    <!-- begin:: Content -->
    <div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
        @include('includes.partials.messages')
        <div class="d-flex justify-content-center">
        <div class="col-xl-12">
            
            <!--begin:: Widgets/Personal Income-->
            <div class="kt-portlet kt-portlet--fit kt-portlet--head-lg kt-portlet--head-overlay kt-portlet--height-fluid">
                <div class="kt-portlet__head kt-portlet__space-x">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title kt-font-light">
                            @lang('Crediti Personali')
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="kt-widget27">
                        <div class="kt-widget27__visual">
                            <img style="height: auto" src="./assets/media/sfondo_spg.jpg" alt="">
                            <h3 class="kt-widget27__title">
                                <span><span>@lang('Crediti'): </span>{{$budget}}</span>
                            </h3>
                            <div class="kt-widget27__btn">
                                <a href="#crediti" class="btn btn-pill btn-light btn-elevate btn-bold">Acquista altri crediti</a>
                            </div>
                        </div>
                        <div class="kt-widget27__container kt-portlet__space-x">
                            <p>@lang('applicazione.spiegazione_crediti')</p>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <!--end:: Widgets/Personal Income-->
        </div>
        <div id="crediti" class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">

                    </span>
                    <h3 class="kt-portlet__head-title">
                        {{__('applicazione.acquista')}}
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="kt-pricing-1 kt-pricing-1--fixed">
                    <div class="kt-pricing-1__items row">
                        <div class="kt-pricing-1__item col-lg-4">
                            <div class="kt-pricing-1__visual">
                                <span class="kt-pricing-1__icon kt-font-brand"><i class="fa flaticon-mail"></i></span>
                            </div>
                            <span class="kt-pricing-1__price">10 {{__('applicazione.crediti')}}</span>
                            <span class="strikethrough" style="color:red;">50 €</span>
                            <h2 class="" style="color:black;font-weight:bold;">40 €</h2>
                            
                            <h1 class="kt-pricing-1__subtitle" style="color:black;">(iva compresa)</h1>
                            <span class="kt-pricing-1__description">

                            </span>
                            <div class="kt-pricing-1__btn">
                                <form action="{{route('frontend.user.crediti.compra')}}" method="post">
                                    <button type="submit" class="btn btn-pill  btn-brand btn-wide btn-uppercase btn-bolder btn-sm">{{__('applicazione.acquista')}}</button>
                                    @csrf
                                    <input type="hidden" value="40" name="crediti">
                                </form>
                            </div>
                        </div>
                        <div class="kt-pricing-1__item col-lg-4">
                            <div class="kt-pricing-1__visual">
                                <span class="kt-pricing-1__icon kt-font-brand"><i class="fa flaticon-air-freight"></i></span>
                            </div>
                            <span class="kt-pricing-1__price">20 {{__('applicazione.crediti')}}</span>
                            <span class="strikethrough" style="color:red;">90 €</span>
                            <h2 class="" style="color:black;font-weight:bold;">70 €</h2>
                            
                            <h1 class="kt-pricing-1__subtitle" style="color:black;">(iva compresa)</h1>
                            <span class="kt-pricing-1__description">

                            </span>
                            <div class="kt-pricing-1__btn">
                                <form action="{{route('frontend.user.crediti.compra')}}" method="post">
                                    <button type="submit" class="btn btn-pill  btn-brand btn-wide btn-uppercase btn-bolder btn-sm">{{__('applicazione.acquista')}}</button>
                                    @csrf
                                    <input type="hidden" value="70" name="crediti">
                                </form>
                            </div>
                        </div>
                        <div class="kt-pricing-1__item col-lg-4">
                            <div class="kt-pricing-1__visual">
                                <span class="kt-pricing-1__icon kt-font-brand"><i class="fa flaticon-rocket"></i></span>
                            </div>
                            <span class="kt-pricing-1__price">30 {{__('applicazione.crediti')}} </span>
                            <span class="strikethrough" style="color:red;">120 €</span>
                            <h2 class="" style="color:black;font-weight:bold;">90 €</h2>
                            
                            <h1 class="kt-pricing-1__subtitle" style="color:black;">(iva compresa)</h1>
                            <span class="kt-pricing-1__description">

                            </span>
                            <div class="kt-pricing-1__btn">
                                <form action="{{route('frontend.user.crediti.compra')}}" method="post">
                                    <button type="submit" class="btn btn-pill btn-brand btn-wide btn-uppercase btn-bolder btn-sm">{{__('applicazione.acquista')}}</button>
                                    @csrf
                                    <input type="hidden" value="90" name="crediti">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end:: Content -->


    @endsection
