<?php

namespace App\Mail;

use GuzzleHttp\Psr7\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifInter1 extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $nom;
    public $service;

    public function __construct($nom , $service )
    {
        $this->nom = $nom;
        $this->service = $service;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $nom_demandeur =  $this->nom;
        $service_demandeur =  $this->service;
       return $this->view('emails.intervention.mail1')->subject("Nouvelle Fiche d'intervention")->with(compact('nom_demandeur', 'service_demandeur'));
    }
}
