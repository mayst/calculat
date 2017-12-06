<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendContact extends Mailable
{
    use Queueable, SerializesModels;

    private $name;
    private $viber;
    private $email;
    private $msg;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $viber, $email, $msg)
    {
        $this->name = $name;
        $this->viber = $viber;
        $this->email = $email;
        $this->msg = $msg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.send_contact')
            ->with([
                'name' => $this->name,
                'number' => $this->viber,
                'email' => $this->email,
                'msg' => $this->msg
            ]);
    }
}
