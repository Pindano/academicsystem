<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ParentCredentialsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $parent;
    public $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($parent, $password)
    {
        $this->parent = $parent;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Login Credentials')
            ->view('emails.parent_credentials')
            ->with([
                'name' => $this->parent->name,
                'email' => $this->parent->email,
                'password' => $this->password,
            ]);
    }
}
