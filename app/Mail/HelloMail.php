<?php

namespace App\Mail;

use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\View\View;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class HelloMail extends Mailable
{
    use Queueable, SerializesModels;
    public $otp;
    public $data;
    /**
     * Create a new message instance.
     */
    public function __construct($token_otp,$date)
    {
        $this->otp='ssas';
        $this->data = '$data';
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Hello Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $this->data=[];
        return new Content(
            view: 'mail.hello',
        );
    }
    public function build() {
        return $this->from('mailadress@blabla', 'my site')
        ->subject('hello you')
        ->view('emails.hello')->with(['data', '$this->data']);
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
