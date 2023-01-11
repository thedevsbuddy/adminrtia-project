<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DynamicMail extends Mailable
{
    use Queueable, SerializesModels;

    public $body;
    public $subject;

    public function __construct($subject, $body)
    {
        $this->body = $body;
        $this->subject = $subject;
    }


    public function build(): DynamicMail
    {
        return $this->subject($this->subject)
            ->markdown('emails.dynamic-mail')
            ->with('body', $this->body);
    }
}
