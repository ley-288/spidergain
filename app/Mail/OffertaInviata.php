<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OffertaInviata extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nome, $cognome, $titolo)
    {
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
        return $this->markdown('frontend.mail.offerta')->with(['nome' => $this->nome,'cognome' => $this->cognome,'titolo' => $this->titolo ]);
    } 
}
