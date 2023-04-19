<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TmpGuardianUserRegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $auth_code;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($auth_code)
    {
        $this->auth_code = $auth_code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.tmp_guardian_user_register')
        ->from(env('MAIL_FROM_ADDRESS', 'test@test.com'))
        ->subject('【キッズパーク】メール認証のお知らせ')
        ->with(['auth_code' => $this->auth_code])
        ->withSwiftMessage(function (\Swift_Message $message) {
            $message->setReturnPath(env('MAIL_FROM_ADDRESS', 'test@test.com'));
        });
    }
}
