@extends('frontend.layouts.interna')

@section('title', app_name() . ' | ' . __('applicazione.faq'))

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
        <div class="kt-portlet kt-faq-v1">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        {{__('applicazione.faq')}}
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="row">
                    <div class="col-xl-9">
                        <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample1">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <div class="card-title" data-toggle="collapse" data-target="#collapseOne1" aria-expanded="false" aria-controls="collapseOne1">
                                       Cos’è Spidergain?
                                    </div>
                                </div>
                                <div id="collapseOne1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample1" style="">
                                    <div class="card-body">
                                        Quando un’azienda crea una campagna, sul web o fuori dalla rete, ha bisogno di essere aiutata da professionisti del settore nella fase della comunicazione. Trovare le giuste risorse non è mai facile. Bisogna capire quali sono i giusti professionisti da coinvolgere per un determinato settore, bisogna indagare sulla loro affidabilità e bisogna scovarne i contatti per iniziare una trattativa di collaborazione. Spidergain rende tutto questo procedimento molto semplice e rapido. Come? Dando vita ad una comunità in cui aziende ed influencer possono interagire facilmente attraverso i loro account personali. Ogni account sarà sempre aggiornato sulle competenze, le novità, il settore di azione e i numeri spendibili e, soprattutto, potrà mostrare le recensioni di chi ci ha già lavorato insieme. Le aziende possono creare nuove campagne e cercare le risorse giuste da coinvolgere. Gli influencer potranno accettare le richieste ricevute o auto-candidarsi per quelle che ritengono occasioni interessanti. Un circuito virtuoso di comunicazione dove tutte le parti sono soddisfatte e guadagnano.
                                    </div>
                                </div>
                            </div>
                            
                            {{--
                            
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo1" aria-expanded="false" aria-controls="collapseTwo1">
                                        Come funziona il meccanismo dei crediti?
                                    </div>
                                </div>
                                <div id="collapseTwo1" class="collapse" aria-labelledby="headingTwo1" data-parent="#accordionExample1">
                                    <div class="card-body">
                                        Il meccanismo dei crediti su Spidergain riguarda soltanto il profilo da influencer. Il suo funzionamento è molto semplice. Ogni volta che una tua offerta di collaborazione ad una campagna è accettata, ti viene scalato 1 credito. Al momento dell’iscrizione, ti vengono regalati 10 crediti. Quando li esaurisci, potrai acquistarne di nuovi direttamente dal sito di Spidergain. Attenzione! Candidarsi per una collaborazione ad una campagna non significa che l’azienda abbia già accettato di lavorare con te. Questo vuol dire che non ti sarà scalato nessun credito durante questa fase. Per fare un esempio pratico, anche se hai 1 credito residuo, puoi comunque candidarti a 100 diverse collaborazioni. Qualora queste 100 collaborazioni vengano accettate, avrai bisogno di acquistare altri 98 crediti per farle partire effettivamente.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingThree1">
                                    <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseThree1" aria-expanded="false"aria-controls="collapseThree1">
                                       Come posso acquistare i crediti?
                                    </div>
                                </div>
                                <div id="collapseThree1" class="collapse" aria-labelledby="headingThree1" data-parent="#accordionExample1">
                                    <div class="card-body">
                                        All’interno del tuo profilo da influencer, trovi la sezione “I tuoi Crediti” dove visualizzi in tempo reale quanti crediti hai a disposizione. Là dentro c’è anche il link diretto per acquistarne di nuovi. La transazione economica online è sicura e protetta perché è gestita da PayPal. Per pagare puoi usare il credito del tuo account PayPal oppure, se non hai e non vuoi un account PayPal, puoi semplicemente pagare attraverso carta di credito. I nuovi crediti comprati appariranno nel profilo subito dopo aver terminato l’acquisto online.
                                    </div>
                                </div>
                            </div>
                            --}}
                            
                            <div class="card">
                                <div class="card-header" id="heading4">
                                    <div class="card-title collapsed" data-toggle="collapse" data-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                       A chi può interessare?
                                    </div>
                                </div>
                                <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#accordionExample1">
                                    <div class="card-body">
                                        Spidergain è una comunità che fa guadagnare in modo semplice e veloce aziende ed influencer. Le aziende possono creare dettagliate campagne web e fisiche ingaggiando esattamente i professionisti che sono più giusti per quella comunicazione. Molto spesso l’efficacia dei micro-influencer è maggiore rispetto a quella dei grandi nomi perché costano sensibilmente di meno ed hanno una grande specificità nel settore in cui stai agendo. Gli influencer possono tessere una rete di collaborazioni con le aziende facendosi facilmente conoscere attraverso il meccanismo dell’autocandidatura. Se hai creato una piccola comunità, questa è un’ottima occasione di crescita e di guadagno.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="heading5">
                                    <div class="card-title collapsed" data-toggle="collapse" data-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                    Come posso guadagnare con Spidergain?
                                    </div>
                                </div>
                                <div id="collapse5" class="collapse" aria-labelledby="heading5" data-parent="#accordionExample1">
                                    <div class="card-body">
                                        <p>Se sei un’azienda, hai la certezza di non disperdere l’investimento nella comunicazione della tua campagna. Spidergain, infatti, ti darà modo di evitare di inseguire costosi influencer che potrebbero non essere del tutto a fuoco con le tue esigenze e di puntare, invece, su influencer più piccoli, molto meno impegnativi come budget ma comunque molto credibili in determinati settori specialistici di loro competenza.</p>
                                        <p>Se sei un influencer, hai modo di farti conoscere da molte aziende e collaborare con loro in diverse campagne parlando direttamente con loro. Più lavori con loro e più recensioni ricevi costruendo in fretta una tua visibilità nella comunità.</p>

                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="heading6">
                                    <div class="card-title collapsed" data-toggle="collapse" data-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
                                    Che differenza c’è tra azienda e influencer?
                                    </div>
                                </div>
                                <div id="collapse6" class="collapse" aria-labelledby="heading6" data-parent="#accordionExample1">
                                    <div class="card-body">
                                       <p> Un’azienda crea il suo account con la mission, i contatti istituzionali e le aree di competenza. Dal suo profilo può attivare un numero infinito di campagne web e fisiche specificando i canali di comunicazione in cui agire e il budget che vuole investire per le collaborazioni.</p>
                                        <p>Un influencer crea un suo account per raccontare chi è, qual è il suo know-how e di quali numeri social può disporre. Dal suo profilo può vedere tutte le campagne attive e, eventualmente, auto-candidarsi per una collaborazione. Sempre da là può discutere e accettare una richiesta ricevuta.</p>

                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="heading11">
                                    <div class="card-title collapsed" data-toggle="collapse" data-target="#collapse11" aria-expanded="false" aria-controls="collapse11">
                                   Quale informazioni servono per l’iscrizione come azienda?
                                    </div>
                                </div>
                                <div id="collapse11" class="collapse" aria-labelledby="heading11" data-parent="#accordionExample1">
                                    <div class="card-body">
                                         <p>Per completare l&rsquo;iscrizione su Spidergain con un account da azienda devi inserire:</p>
                                            <ul>
                                            <li>Nome e cognome di chi gestisce la pagina;</li>
                                            <li>Ragione sociale;</li>
                                            <li>Partita Iva;</li>
                                            <li>Indirizzo aziendale;</li>
                                            <li>Citt&agrave; e paese in cui operi;</li>
                                            <li>Una email valida;</li>
                                            <li>Un numero di telefono;</li>
                                            <li>Canali social ufficiali;</li>
                                            <li>Sito web istituzionale;</li>
                                            <li>Logo aziendale.</li>
                                            </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="heading7">
                                    <div class="card-title collapsed" data-toggle="collapse" data-target="#collapse7" aria-expanded="false" aria-controls="collapse7">
                                   Quale informazioni servono per l’iscrizione come influencer?
                                    </div>
                                </div>
                                <div id="collapse7" class="collapse" aria-labelledby="heading7" data-parent="#accordionExample1">
                                    <div class="card-body">
                                         <p>Per completare l&rsquo;iscrizione su Spidergain con un account da influencer devi inserire:</p>
                                        <ul>
                                        <li>Nome e cognome;</li>
                                        <li>Una email valida;</li>
                                        <li>Un numero di telefono;</li>
                                        <li>Il paese e la citt&agrave; in cui risiedi;</li>
                                        <li>Una descrizione di te di massimo 1000 caratteri;</li>
                                        <li>Le categorie in cui operi;</li>
                                        <li>La tua presenza online divisa per singoli social;</li>
                                        <li>La tua presenza nei canali tradizionali;</li>
                                        <li>Una tua fotografia.</li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="heading12">
                                    <div class="card-title collapsed" data-toggle="collapse" data-target="#collapse12" aria-expanded="false" aria-controls="collapse12">
                                    Posso iscrivermi sia come azienda sia come influencer?
                                    </div>
                                </div>
                                <div id="collapse12" class="collapse" aria-labelledby="heading12" data-parent="#accordionExample1">
                                    <div class="card-body">
                                        E’ possibile farlo ma considerando che è necessario sempre avere due indirizzi email diversi. Per ragioni di sicurezza, infatti, ad ogni account corrisponde una sola mail. 
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="heading9">
                                    <div class="card-title collapsed" data-toggle="collapse" data-target="#collapse9" aria-expanded="false" aria-controls="collapse9">
                                   Esistono dei numeri dei social minimi per essere considerato influencer?
                                    </div>
                                </div>
                                <div id="collapse9" class="collapse" aria-labelledby="heading9" data-parent="#accordionExample1">
                                    <div class="card-body">
                                        No, non esistono numeri minimi per essere considerati influencer. Al contrario, la filosofia di Spidergain è che anche chi ha costruito una comunità apparentemente molto piccola può essere un supporto efficace se fatto operare nel settore in cui ha saputo costruirsi la sua credibilità.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end:: Content -->


    @endsection
