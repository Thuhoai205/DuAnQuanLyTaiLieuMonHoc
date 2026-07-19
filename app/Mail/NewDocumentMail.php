<?php

namespace App\Mail;

use App\Models\Document;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewDocumentMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public Subject $course;
    public Document $document;

    public function __construct(
        User $user,
        Subject $course,
        Document $document
    ) {
        $this->user = $user;
        $this->course = $course;
        $this->document = $document;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Có tài liệu mới - ' . $this->course->subject_name,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.new-document',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}