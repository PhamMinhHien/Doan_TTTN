<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UserActivation extends Model
{
    protected $table = 'user_activations';

    protected function getToken()
    {
        return hash_hmac('sha256', str_random(40), config('app.key'));
    }

    public function createActivation($user)
    {
        $activation = $this->getActivation($user);
        if (!$activation) 
        {
            return $this->createToken($user);
        }
        return $this->regenerateToken($user);

    }

    private function regenerateToken($user)
    {

        $token = $this->getToken();
        UserActivation::where('email_id', $user->email_id)->update([
            'activation_code' => $token,
            'created_at' => new Carbon()
        ]);
        return $token;
    }

    private function createToken($user)
    {
        $token = $this->getToken();
        UserActivation::insert([
            'email_id' => $user->id,
            'activation_code' => $token,
            'created_at' => new Carbon()
        ]);
        return $token;
    }

    public function getActivation($user)
    {
        return UserActivation::where('email_id', $user->id)->first();
    }

    public function getActivationByToken($token)
    {
        return UserActivation::where('activation_code', $token)->first();
    }

    public function deleteActivation($token)
    {
        UserActivation::where('activation_code', $token)->delete();
    }
}
