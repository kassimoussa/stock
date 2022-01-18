<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Notif3 extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $dirdemandeur;
    public $date_submit;
    public $servicedemandeur;
    public $ficheId;

    public function __construct($dirdemandeur, $date_submit, $servicedemandeur, $ficheId)
    {
        $this->dirdemandeur =$dirdemandeur;
        $this->date_submit =$date_submit;
        $this->servicedemandeur =$servicedemandeur;
        $this->ficheId =$ficheId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $dirdemandeur =  $this->dirdemandeur;
        $date_submit =  $this->date_submit;
        $servicedemandeur =  $this->servicedemandeur;
        $ficheId =  $this->ficheId;

       return $this->view('emails.mail3')->subject("Nouvelle Fiche d'acquisition")->with(compact('dirdemandeur', 'date_submit', 'servicedemandeur', 'ficheId'));
    }
}
