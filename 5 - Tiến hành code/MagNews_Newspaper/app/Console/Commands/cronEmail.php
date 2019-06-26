<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Mail;
use App\Models\Email_Receive;
use App\Jobs\Send_Post_To_Email;
use App\Models\Post;
use App\Mail\Send_Post;



class cronEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:sendemail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Email For User !';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $email_receive = new Email_Receive();
        $data_email = $email_receive->getEmail_Active();
        for($i = 0 ; $i < $data_email->count() ; $i++ )
        {
            $post = new Post();
	        $data_post = $post->getPost_ForEmailReceive();
	        Mail::to($data_email[$i]->email)->send(new Send_Post($data_post));
        }
    }
}
