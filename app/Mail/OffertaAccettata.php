<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OffertaAccettata extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($rifiutata = false, $nome = '', $cognome= '', $titolo = '')
    {
        $this->rifiutata = $rifiutata;
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->titolo = $titolo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->rifiutata){
            return $this->markdown('frontend.mail.offerta_rifiutata')->with(['nome'=>$this->nome,'cognome'=>$this->cognome,'titolo' => $this->titolo]);
        }
        return $this->markdown('frontend.mail.offerta_accettata')->with(['nome'=>$this->nome,'cognome'=>$this->cognome,'titolo' => $this->titolo]);
    }
}
