<?php

namespace App\Mail;

use App\User;
use App\Info;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class UserRegistration extends Mailable
{
    use Queueable, SerializesModels;

    private $usr;
    private $pass;
    private $id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $usr, $pass, $id)
    {
        //
        $this->usr = $usr;
        $this->pass = $pass;
        $this->id = $id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.user.user_registration')
                    ->with([
                        'name' => $this->usr->name,
                        'pass' => $this->pass,
                        'url' => url('/profile') . "/$this->id"
                    ]);
    }
}
