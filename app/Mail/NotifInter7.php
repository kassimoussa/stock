<?php

namespace App\Mail;

use GuzzleHttp\Psr7\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifInter7 extends Mailable implements ShouldQueue
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
    public $status;

    public function __construct($nom , $service, $dir, $fiche, $status  ) 
    {
        $this->nom = $nom;
        $this->service = $service;
        $this->dir = $dir;
        $this->fiche = $fiche;
        $this->status = $status;
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
        $status =  $this->status;
       return $this->view('emails.intervention.mail7')->subject("Fiche d'intervention")->with(compact('nom_demandeur', 'service_demandeur', 'dir_demandeur', 'fiche', 'status'));
    }
}
