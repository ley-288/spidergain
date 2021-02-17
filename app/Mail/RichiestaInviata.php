<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RichiestaInviata extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nome,$cognome, $azienda = "")
    {
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->azienda = $azienda;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('frontend.mail.richiesta',['nome'=> $this->cognome,'cognome' => $this->cognome,'azienda'=>$this->azienda]);
    } 
}
