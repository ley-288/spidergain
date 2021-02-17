@component('mail::message')
# {{__('applicazione.nuova_richiesta')}}

{{__('applicazione.nuova_richiesta_ricevuta',['nome'=>$nome,'cognome'=>$cognome,'azienda'=>$azienda])}}

@component('mail::button', ['url' => config('app.url') ])
{{__('applicazione.vai_al_sito')}}
@endcomponent

{{__('applicazione.grazie')}},<br>
{{ config('app.name') }}
@endcomponent
