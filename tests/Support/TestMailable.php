<?php

declare(strict_types=1);

namespace Worksofallen\MailScheduler\Tests\Support;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class TestMailable extends Mailable
{
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Test subject',
        );
    }

    public function content(): Content
    {
        return new Content(
            text: 'Test content',
        );
    }
}
