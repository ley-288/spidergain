    <!--begin:: Widgets/Support Tickets -->

    <div class="kt-portlet kt-portlet--height-fluid">

        <div class="kt-portlet__head">

            <div class="kt-portlet__head-label">

                <h3 class="kt-portlet__head-title">

                    {{__('applicazione.recensioni')}}

                </h3>

            </div>

            <div class="kt-portlet__head-toolbar">



                @if(isset($user->media_voto))

               @php $voto = $user->media_voto @endphp

               @include('frontend.recensioni.stelle')

                @endif

            </div>

        </div>

        <div class="kt-portlet__body">

            <div class="kt-widget3">

                

                @if(count($user->recensioni_to) > 0)

                @foreach($user->recensioni_to as $recensione)



                <div class="kt-widget3__item">

                    <div class="kt-widget3__header">





                        @if($recensione->users_to->avatar_location != '')

                        <img style="max-width: 60px; border: 1px solid black; border-radius:30px;" class="kt-widget__img kt-hidden-" src="{{asset('storage/'.$recensione->users_to->avatar_location)}}" alt="image">

                            @else

                            <span class="kt-userpic kt-userpic--md kt-userpic--circle kt-userpic--danger kt-margin-r-5 kt-margin-t-5">

                                <span>{{$recensione->users_to->first_name[0]}} {{$recensione->users_to->last_name[0]}}</span>

                            </span>

                            @endif





                            <div class="kt-widget3__info">

                                <a href="#" class="kt-widget3__username">

                                    {{$recensione->users_to->first_name}} {{$recensione->users_to->last_name}}

                                </a><br>

                                    <span class="kt-widget3__time">

                                        {{date('d F Y',strtotime($recensione->created_at))}}

                                    </span>

                            </div>

                            <span class="kt-widget3__status kt-font-info">

                                @php $voto = $recensione->voto @endphp

                                @include('frontend.recensioni.stelle')

                            </span>

                    </div>

                    <div class="kt-widget3__body">

                        <p class="kt-widget3__text">

                            {{$recensione->descrizione}}

                        </p>

                    </div>

                </div>

                @endforeach

                @else

                {{__('applicazione.no_recensioni')}}

                @endif

            </div>

        </div>

    </div>



    <!--end:: Widgets/Support Tickets -->