<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class TextMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $user;
    public $customText;

    public function __construct(User $user, $customText)
    {
        $this->user = $user;
        $this->customText = $customText;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       return $this->subject('Request Approval Notification')
                    ->text('emails.blank')
                    ->withSwiftMessage(function ($message) {
                    $message->setBody($this->customText, 'text/plain');
                });
    }
}
