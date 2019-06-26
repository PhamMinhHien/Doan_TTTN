<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Email_Receive extends Model
{
    protected $fillable = [
    	'id',
    	'email',
    ];
    protected $table = 'email_receives';
    protected $primarykey = 'id';

    public function getEmail_Active()
    {
        $data = Email_Receive::where('active', 1)->get();
        return $data;
    }

    public function getEmail_checkRegister($email)
    {
        $data = Email_Receive::where('email', $email)->get();
        return $data;
    }
}
