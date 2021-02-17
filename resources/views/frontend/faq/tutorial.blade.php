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
        <div class="kt-portlet ">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @lang('Come funziona')
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="row">
                    <div class="col-xl-12">
                        
                        @if(Auth::user()->hasRole('influencer'))
                        <p>
                        <p>Se sei un piccolo influencer e vuoi iniziare a guadagnare grazie alla comunit&agrave; che hai creato, questo &egrave; lo strumento ideale per te. <strong>SpiderGain &egrave; un network che ti mette direttamente in collegamento con le aziende</strong> che hanno bisogno della tua expertise.</p>
                        <p>Fashion blogger, speaker radiofonici, social media manager, web journalist, food recensor: non c&rsquo;&egrave; limite alle categorie che possono trarre profitto da questo servizio.</p>
                        <p><strong>Facile da usare</strong> e con risultati immediati, crea subito il tuo profilo con i tuoi numeri in rete e con la tua biografia e cerca le campagne in cui la tua visibilit&agrave; pu&ograve; dare un aiuto. Potrai candidarti in prima persona o aspettare che le aziende ti contattino spontaneamente.<strong> Non commettere l&rsquo;errore di pensare d&rsquo;essere troppo &ldquo;piccolo&rdquo;</strong> come opinion leader.</p>
                        <p>Recenti ricerche di marketing dimostrano che oltre il 30% delle promozioni andate a buon fine basa il suo successo sull&rsquo;apporto di piccoli esperti di settore che risultano credibili agli occhi degli altri utenti della rete. Ti fideresti del consiglio di un blogger di viaggi per organizzare al meglio una vacanza? E&rsquo; molto probabile e per questo non devi nascondere nell&rsquo;ombra la tua professionalit&agrave;.</p>
                        <p>Da un sassolino pu&ograve; nascere una valanga.</p>
                        <p>Inizia a rotolare.</p>
                        </p>
                        @else
                        <p>
                        <p>Le dimensioni non contano. Il mercato &egrave; fatto di nicchie e raggiungere una di esse pu&ograve; significare il successo di una campagna.<strong> Ecco perch&eacute; i piccoli e medi influencer sono sempre pi&ugrave; ricercati</strong>.</p>
                        <p>Recenti ricerche di marketing dimostrano che <strong>oltre il 30% delle promozioni andate a buon fine basa il suo successo sull&rsquo;apporto di esperti di settore</strong> che risultano credibili agli occhi degli altri utenti della rete. Coinvolgerli pu&ograve; essere efficace e non per forza troppo costoso.</p>
                        <p><strong>SpiderGain &egrave; lo strumento che ti aiuta a farlo</strong>. Si tratta di un network che ti mette velocemente in contatto con gli influencer che hanno una loro comunit&agrave; fedele nel settore che pi&ugrave; ti interessa.<br /> Fashion blogger, speaker radiofonici, social media manager, web journalist, food recensor: non c&rsquo;&egrave; limite alle categorie di professionisti che puoi raggiungere con questo servizio facile ed immediato da usare.</p>
                        <p>Crea la tua pagina aziendale ed attiva tutte le campagne su cui vuoi lavorare. Il software selezioner&agrave; per te gli influencer pi&ugrave; efficaci per raggiungere il tuo obiettivo e potrai subito entrare in contatto con loro per valutarne il coinvolgimento.</p>
                        <p><strong>Un piccolo budget non &egrave; mai un budget sbagliato</strong> se &egrave; investito nel canale giusto e comunicato dalle persone pi&ugrave; credibili.</p>
                        <p>Da un sassolino pu&ograve; nascere una valanga. SpiderGain ti d&agrave; la spinta iniziale.</p>
                        </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end:: Content -->


    @endsection
