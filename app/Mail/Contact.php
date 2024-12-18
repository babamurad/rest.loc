<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    public $sender_name;
    public $sender_email;
    public $sender_phone;
    public $sender_subject;
    public $sender_message;

    public function __construct($name, $email, $phone, $subject, $messageText)
    {
        $this->sender_name = $name;
        $this->sender_email = $email;
        $this->sender_phone = $phone;
        $this->sender_subject = $subject;
        $this->sender_message = $messageText;

        Log::info('Mail data initialized:', [
            'name' => $this->sender_name,
            'email' => $this->sender_email,
            'phone' => $this->sender_phone,
            'subject' => $this->sender_subject,
            'message' => $this->sender_message
        ]);
    }

    public function build()
    {
        return $this->subject('Новое сообщение')
                   ->view('components.mail.contact');
    }
}
