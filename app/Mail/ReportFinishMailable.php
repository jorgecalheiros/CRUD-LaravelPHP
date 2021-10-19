<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReportFinishMailable extends Mailable
{
    use Queueable, SerializesModels;

    /** @var string */
    public $fileName;

    /** @var string */
    public $requestedBy;

    /** @var string */
    public $requestedAt;

    /** @var string */
    private $filePath;

    public function __construct($fileName, $requestedBy, $requestedAt, $filePath)
    {
        $this->fileName = $fileName;
        $this->requestedBy = $requestedBy;
        $this->requestedAt = $requestedAt;
        $this->filePath = $filePath;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
            ->view('emails.report-finish')
            ->attach($this->filePath);
    }
}
