<div data-id="{{$messaggio->id}}" class="kt-chat__message {{(Auth::user()->id == $messaggio->autore_id) ? 'kt-chat__message--right':''}}">
    <div class="kt-chat__user">
        @if($messaggio->users->avatar_location != '')
        <span class="kt-userpic kt-userpic--circle kt-userpic--sm">
            <img src="{{asset('storage/'.$messaggio->users->avatar_location)}}" alt="image">
        </span>
        @else
        <span style="display:inline-block !important" class="kt-userpic kt-userpic--circle kt-userpic--danger kt-margin-r-5 kt-margin-t-5"><span>{{$messaggio->users->first_name[0]}} {{$messaggio->users->last_name[0]}}</span></span>
        @endif
        <a href="#" class="kt-chat__username"><span>{{$messaggio->users->first_name}} {{$messaggio->users->last_name}} {!!($messaggio->autore_id == $campagna->user_id) ? '<span class="kt-badge kt-badge--primary kt-badge--inline">'.__('applicazione.autore').'</span>':''!!}</span></a>
        <span style="display: block" class="kt-chat__datetime">{{$messaggio->created_at->formatLocalized('%d %B %Y')}} {!!($messaggio->letto == 0 && $messaggio->autore_id == Auth::user()->id) ? '  <i class="read-label"> - Non letto</i>': ''!!} </span>
    </div>
    <div class="kt-chat__text {{(Auth::user()->id == $messaggio->autore_id) ? 'kt-bg-light-brand':'kt-bg-light-success'}}">
        {{$messaggio->messaggio}}
    </div>
</div>