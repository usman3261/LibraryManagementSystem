<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookRequestNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    public function build()
    {
        return $this->subject('New Book Request Received')
                    ->html("
                        <h3>New Book Request</h3>
                        <p><strong>Student:</strong> {$this->details['student_name']}</p>
                        <p><strong>Book:</strong> {$this->details['book_title']}</p>
                        <p>Please log in to the admin panel to approve or reject this request.</p>
                    ");
    }
}

