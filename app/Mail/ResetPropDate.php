<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPropDate extends Mailable
{
    use Queueable, SerializesModels;

    public $title;

    public function __construct($title)
    {
        $this->title = $title;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reset Property',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.resetProps',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
