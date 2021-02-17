<div class="col-xl-4 col-lg-12">

    <!--Begin::Portlet-->
    <div class="kt-portlet kt-portlet--height-fluid" style="border:1px solid black">
        <div class="kt-portlet__head kt-portlet__head--noborder">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                </h3>
            </div>

        </div>
        <div class="kt-portlet__body">

            <!--begin::Widget -->
            <div class="kt-widget kt-widget--user-profile-2">
                <div class="kt-widget__head">
                    <div class="kt-widget__media">
                        @if($campagna->avatar_location )
                        <span class="kt-userpic kt-userpic--xl">
                            <img class="kt-widget3__img" src="{{asset('storage/'.$campagna->avatar_location)}}" style="border:1px solid black;" alt="">
                        </span>

                        @else
                        <div class="kt-widget__pic kt-widget__pic--success kt-font-success kt-font-boldest ">
                            {{$campagna->first_name[0]}} {{$campagna->last_name[0]}}
                        </div>
                        @endif
                    </div>
                    <div class="kt-widget__info">
                        <p class="kt-widget__titel" style="font-size:18px;font-weight: bold; color: #1E1E2D;">
                            {{$campagna->titolo}}
                        </p>
                        <p class="kt-widget__username">
                            <a target="_blank" href="{{route('frontend.user.brand.get',$campagna->user_uuid)}}"> {{$campagna->first_name}} {{$campagna->last_name}}</a>
                        </p>
                       
                      
                    </div>
                </div>
                <div class="kt-widget__body">
                    <div class="kt-widget__section">
                         {{Str::limit(strip_tags($campagna->descrizione),300,'...')}}
                    </div>
                    <div class="alert alert-secondary" role="alert">
                        <div class="alert-text ">@lang('applicazione.lista_canali')
                            <div class="canali d-flex justify-content-start">
                                @if(isset($campagna->canali_view))
                                @foreach($campagna->canali_view as $item)
                                <div class="kt-widget__item kt-margin-r-20">
                                    <div class="kt-widget__icon">
                                        <i data-container="body" data-toggle="kt-tooltip" data-placement="top" data-original-title="{{$item['name']}}" class="{{$item['icon']}}"></i>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    @if(isset($campagna->categorie))
                    @foreach($campagna->categorie as $categoria)
                    <span class="kt-badge kt-badge--unified-brand  kt-badge--inline">{{$categoria->nome}}</span>
                    @endforeach
                    @endif
                    <div class="kt-widget__item">
                        
                        @if($campagna->budget != '' || $campagna->budget != null)
                        <div class="kt-widget__contact">
                            <span class="kt-widget__label">@lang('applicazione.budget')</span>
                            <a href="#" class="kt-widget__data">{{$campagna->budget}} € / {{__('applicazione.budget_'.$campagna->budget_periodo)}}</a>
                        </div>
                        @endif
                        
                        <div class="kt-widget__contact">
                            <span class="kt-widget__label">{{__('applicazione.inizio_campagna')}}</span>
                            <a href="#" class="kt-widget__data">{{$campagna->data_inizio->formatLocalized('%d %B %Y')}}</a>
                        </div>
                        <div class="kt-widget__contact">
                            <span class="kt-widget__label">{{__('applicazione.fine_campagna')}}</span>
                            <a href="#" class="kt-widget__data">{{$campagna->data_fine->formatLocalized('%d %B %Y')}}</a>
                        </div>
                    </div>
                </div>
                <div class="kt-widget__footer">
                    <a href="{{route('frontend.user.campagna.dettaglio',['uuid' => $campagna->uuid])}}" class="btn btn-label-success btn-lg btn-upper" style="color:white; background-color:#e72b38; border:1px solid #e72b38;">@lang('Guarda Campagna')</a>
                </div>
            </div>

            <!--end::Widget -->
        </div>
    </div>

    <!--End::Portlet-->
</div>

