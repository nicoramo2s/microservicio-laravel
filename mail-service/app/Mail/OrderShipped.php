<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $fromAddress;
    public $toAddress;
    public $subject;
    public $contentBody;

    /**
     * Create a new message instance.
     */
    public function __construct($order, $fromAddress, $toAddress, $subject, $contentBody)
    {
        $this->order = $order;
        $this->fromAddress = $fromAddress;
        $this->toAddress = $toAddress;
        $this->subject = $subject;
        $this->contentBody = $contentBody;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
            from: $this->fromAddress,
            to: $this->toAddress,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.order-shipped',
            with: [
                'subject' => $this->subject,
                'order' => $this->order,
                'contentBody' => $this->contentBody,
            ],
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
