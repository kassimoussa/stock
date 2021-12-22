<?php

namespace App\Mail;

use GuzzleHttp\Psr7\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifInter6 extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $nom;
    public $service;
    public $dir;
    public $fiche;
   

    public function __construct($nom , $service, $dir, $fiche  ) 
    {
        $this->nom = $nom;
        $this->service = $service;
        $this->dir = $dir;
        $this->fiche = $fiche;
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
        $dir_demandeur =  $this->dir;
        $fiche =  $this->fiche;
       return $this->view('emails.intervention.mail6')->subject("Fiche d'intervention")->with(compact('nom_demandeur', 'service_demandeur', 'dir_demandeur', 'fiche'));
    }
}
