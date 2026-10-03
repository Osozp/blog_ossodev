<?php

namespace App\Mail;

use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class DailyNewsletterMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $subjectText;
    public string $bodyHtml;

    // Recibe el asunto y el HTML del cuerpo en el constructor
    public function __construct(string $subjectText, string $bodyHtml, Subscriber $subscriber)
    {
        $this->subjectText = $subjectText;
        $unsubscribeUrl = URL::signedRoute('subscribe.unsubscribe', $subscriber);

        $footerHtml = '<hr style="border: none; border-top: 1px solid #e5e7eb; margin: 30px 0 15px 0;">
            <p style="font-size: 12px; color: #6b7280; text-align: center;">
                Si ya no deseas recibir estos correos, puedes <a href="' . $unsubscribeUrl . '" style="color: #6b7280; text-decoration: underline;">darte de baja aquí</a>.
            </p>
        ';
        if (str_contains($bodyHtml, '{unsubscribe}')) {
            $this->bodyHtml = str_replace('{unsubscribe}', $unsubscribeUrl, $bodyHtml);
        } else {
            $this->bodyHtml = $bodyHtml . $footerHtml;
        }
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subjectText,
        );
    }

    public function content(): Content
    {
        return new Content(
            htmlString: $this->bodyHtml, // Renderiza el HTML directamente desde Quill
        );
    }
}
