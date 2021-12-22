<?php

namespace App\Mail;

use GuzzleHttp\Psr7\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Notif1 extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $nom;
    public $service;
    public $submitby;
    public $direction;
    public $materiel;

    public function __construct($nom , $service, $direction , $submitby, $materiel )
    {
        $this->nom = $nom;
        $this->service = $service;
        $this->submitby = $submitby;
        $this->direction = $direction;
        $this->materiel = $materiel;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $nom =  $this->nom;
        $service =  $this->service;
        $submitby =  $this->submitby;
        $direction =  $this->direction;
        $materiel =  $this->materiel;
       return $this->view('emails.mail1')->subject("Nouvelle Fiche d'acquisition")->with(compact('nom', 'service', 'submitby', 'direction', 'materiel'));
    }
}
