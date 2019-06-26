<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailReceiveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' =>'required|email',
        ];
    }
    
    public function messages()
    {
        return [
            'email.required' => 'Email là trường yêu cầu !',
            'email.email' => 'Email không đúng định dạng ! ',
        ];
    }
}
