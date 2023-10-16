<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;
    public $cuerpo1;
    public $cuerpo2;
    public $verification_code;
    public $view;

    /**
     * Create a new message instance.
     */
    public function __construct($mailData, $verification_code, $view, $cuerpo1, $cuerpo2)
    {
        $this->mailData = $mailData;
        $this->verification_code = $verification_code;
        $this->view = $view;
        $this->cuerpo1 = $cuerpo1;
        $this->cuerpo2 = $cuerpo2;
        //
    }

    /**]
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bienvenidos a sqlapio.com',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: $this->view,
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
