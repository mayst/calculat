<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class UserRegistration extends Mailable
{
    use Queueable, SerializesModels;

    private $usr;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $usr)
    {
        //
        $this->usr = $usr;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        Auth::login($this->usr, true);

        return $this->markdown('emails.user.user_registration')
                    ->with([
                        'name' => Auth::user()->name,
                        'pass' => Auth::user()->password,
                        'url' => '/asd'
                    ]);
    }
}
