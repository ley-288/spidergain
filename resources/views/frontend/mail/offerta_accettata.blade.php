@component('mail::message')
# {{__('applicazione.tua_offerta')}}

{{__('applicazione.offerta_accettata',['nome'=>$nome,'cognome'=>$cognome,'titolo' => $titolo])}}

@component('mail::button', ['url' => config('app.url') ])
{{__('applicazione.vai_al_sito')}}
@endcomponent

{{__('applicazione.grazie')}},<br>
{{ config('app.name') }}
@endcomponent
