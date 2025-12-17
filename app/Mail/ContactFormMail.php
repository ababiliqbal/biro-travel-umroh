<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data; // Data dari form

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            // Pengirim adalah email pengunjung yang mengisi form
            from: new Address($this->data['email'], $this->data['name']),
            subject: '[Kontak Website] ' . $this->data['subject'],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact', // Kita akan buat view ini di langkah 3
        );
    }
}
