<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;


use Illuminate\Queue\SerializesModels;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    /**
     * Create a new message instance.
     */
    public function __construct(array $details)
    {
        $this->details = $details;
    }

    public function build()
    {
        return $this->subject('Mono Contact Messges')
                    ->view('emails.contact_message')
                    ->with([
                        'details' => $this->details,
                    ]);
    }
}