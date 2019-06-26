<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailReceiveActivation extends Mailable
{
    use Queueable, SerializesModels;
    protected $email_receive;
    /**
     * Create a new message instance.
     *  
     * @return void
     */
    public function __construct($email_receive)
    {
         $this->email_receive = $email_receive;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.template_active_email')->with('email_receive', $this->email_receive);
    }
}
