<?php

namespace App\Mail;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SubjectUnassignedMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $teacher;

    public Subject $courseSubject;

    /**
     * Create a new message instance.
     */
    public function __construct(User $teacher, Subject $courseSubject)
    {
        $this->teacher = $teacher;
        $this->courseSubject = $courseSubject;
    }

    /**
     * Tiêu đề email
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Thông báo hủy phân công môn học',
        );
    }

    /**
     * Nội dung email
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.subject-unassigned',
        );
    }

    /**
     * File đính kèm
     */
    public function attachments(): array
    {
        return [];
    }
}