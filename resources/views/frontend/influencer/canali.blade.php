

@if(!empty($user->canali))

<div class="kt-widget__content">

    @foreach($user->canali as $key=>$canale)

   

    <div class="kt-widget__stats ">

        <div class="kt-widget__icon">

            

            @if(isset($canale['link']))

            <a target="_blank" href="{{$canale['link']}}">

            @endif

            <i class="{{$canale['icon']}}"></i>

            @if(isset($canale['link']))

            </a>

            @endif

        </div>

        <div class="kt-widget__details">

            <span class="kt-widget__title">{{__('applicazione.'.$canale['label'])}}</span>

            <span class="kt-widget__value">{{number_format($canale['count'],0,',','.')}}</span>

        </div>

    </div>

    @if($loop->last)

</div>

@elseif($loop->even && !$loop->last)

</div>

<div class="kt-widget__content">

    @endif

    

 @endforeach

@endif