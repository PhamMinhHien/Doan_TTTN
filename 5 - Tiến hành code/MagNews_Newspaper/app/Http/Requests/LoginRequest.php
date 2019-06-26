<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return false;
    }
    
    public function rules()
    {
        return [
            'email' =>'required|email',
            'password' => 'required|min:6|max:50',
            'g-recaptcha-response'=>'required|recaptcha'
        ];
    }
    
    public function messages()
    {
        return [
            'email.required' => 'Email là trường yêu cầu !',
            'email.email' => 'Email không đúng định dạng ! ',
            'password.required' => 'Password là trường yêu cầu ! ',
            'password.min' => 'Password chứa ít nhất 6 ký tự !',
            'password.max' => 'Password chứa nhiều nhất 50 ký tự !',
            'g-recaptcha-response.required'=> ' Captcha là trường yêu cầu  !',
            'g-recaptcha-response.recaptcha'=>'Hãy đảm bảo rằng bạn không phải là robot!',
        ];
    }
}
