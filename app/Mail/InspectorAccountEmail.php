<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InspectorAccountEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $addressFrom = 'inspectie@pilshuisje.nl';
        $addressTo = $this->data['email'];
        $subject = "Account aangemaakt!";
        $name = 'Inspectie';

        return $this->view('inspector.emails.create-account')
            ->from($addressFrom, $name)
            ->replyTo($addressTo, $name)
            ->subject($subject)
            ->with(["firstname" => $this->data['firstname'], "lastname" => $this->data['lastname'],
                "email" => $this->data['email'], "password" => $this->data['password']]);
    }
}
