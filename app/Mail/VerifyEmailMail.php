<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifyEmailMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public string $verifyUrl;
    public ?string $code;

    public function __construct(User $user, string $verifyUrl = '#', ?string $code = null)
    {
        $this->user = $user;
        $this->verifyUrl = $verifyUrl;
        $this->code = $code;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirme seu e-mail para ativar sua conta no Pariva ✉️',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.verify-email',
            with: [
                'user' => $this->user,
                'verifyUrl' => $this->verifyUrl,
                'code' => $this->code,
            ],
        );
    }
}
