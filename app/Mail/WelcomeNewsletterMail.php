<?php

namespace App\Mail;

use App\Models\Setting;
use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class WelcomeNewsletterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subscriber;
    public $confirmationUrl;
    public string $emailBody;

    public function __construct(Subscriber $subscriber)
    {
        $this->subscriber = $subscriber;

        $this->confirmationUrl = URL::signedRoute('subscribe.confirm', $subscriber);

        $rawBody = Setting::where('key', 'welcome_email_body')->value('value')
            ?? '<h1>¡Gracias por suscribirte!</h1><p><a href="{url}">Haz clic aquí para activar tu suscripción</a>
                    </p>';
        $this->emailBody = str_replace('{url}', $this->confirmationUrl, $rawBody);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = Setting::where('key', 'welcome_email_subject')->value('value')
            ?? '¡Bienvenido a nuestra comunidad!';

        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            htmlString: $this->emailBody, // Inyecta directamente el HTML del editor Quill
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
