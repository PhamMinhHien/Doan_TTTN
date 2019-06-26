<?php
namespace App\Classes;

use Mail;
use App\Models\UserActivation;
use App\Mail\EmailReceiveActivation;
// use App\Jobs\SendActiveEmail;
use App\Models\Email_Receive;

class ActivationService
{
    protected $resendAfter = 24; // Sẽ gửi lại mã xác thực sau 24h nếu thực hiện sendActivationMail()
    protected $userActivation;

    public function __construct(UserActivation $userActivation)
    {
        $this->userActivation = $userActivation;
    }
    // hàm chạy 
    public function sendActivationMail($user)
    {
        // tồn tại trong bảng user 
        if ($user->activated || !$this->shouldSend($user)) return;
        $token = $this->userActivation->createActivation($user);
        $user->activation_link = route('user.activate', $token);
        Mail::to($user->email)->send( new EmailReceiveActivation($user));
        // gửi mail 
    }

    public function activateUser($token)
    {
        $activation = $this->userActivation->getActivationByToken($token);
        if ($activation === null) return null;
        $user = Email_Receive::find($activation->email_id);
        $user->active = true;
        $user->save();
        $this->userActivation->deleteActivation($token);

        return $user;
    }

    private function shouldSend($user)
    {
        $activation = $this->userActivation->getActivation($user);
        return $activation === null || strtotime($activation->created_at) + 60 * 60 * $this->resendAfter < time();
    }

}