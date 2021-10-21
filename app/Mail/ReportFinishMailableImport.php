<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReportFinishMailableImport extends Mailable
{
    use Queueable, SerializesModels;

    public $UserName;
    public $UserPassword;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $username, string $password)
    {
        $this->UserName = $username;
        $this->UserPassword = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env("MAIL_FROM_ADDRESS"))
            ->view('emails.report-finish-import');
    }
}
