<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Notif2 extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $dirdemandeur;
    public $date_submit;

    public function __construct($dirdemandeur, $date_submit )
    {
        $this->dirdemandeur =$dirdemandeur;
        $this->date_submit =$date_submit;
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

       return $this->view('emails.mail2')->subject("Nouvelle Fiche d'acquisition")->with(compact('dirdemandeur', 'date_submit'));
    }
}
