<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Send_Post extends Mailable
{
    use Queueable, SerializesModels;
    protected $data_post;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data_post)
    {
        $this->data_post = $data_post;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         return $this->subject('gửi mail cập nhật')
            ->view('mails.template_email_send_for_receives')
            ->with('data_post', $this->data_post);
    }
}
