<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewUserMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Name of user
     */
    public $name;

    /**
     * Email of user
     */
    public $email;

    /**
     * Phone of user
     */
    public $phone;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $phone)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from(env("MAIL_FROM_ADDRESS"))
            ->view('emails.new-user');
    }
}
