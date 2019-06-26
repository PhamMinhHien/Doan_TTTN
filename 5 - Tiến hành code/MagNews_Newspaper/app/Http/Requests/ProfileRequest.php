<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
    public function rule_1()
    {
        return [
                'name'=>'required|min:3|max:100',
                'password' =>'required|min:6 | max:100',
                'email'=> 'required| email |unique:user,email',
                'birthday'=> ' date',
                'avatar' => 'mimes:jpeg,jpg,png'
            ];
    }

    public function rule_2 ()
    {
        return [
                'name'=>'required|min:3|max:100|unique:users,name',
                'password' =>'required|min:6|max:100',
                'email'=> 'required|email',
                'birthday'=> 'date',
                'avatar' => 'mimes:jpeg,jpg,png'
            ];
    }

    public function rule_3 ()
    {
        return [
                'name'=>'required|min:3|max:100',
                'password' =>'required|min:6|max:100',
                'email'=> 'required|email',
                'birthday'=> 'date',
                'avatar' => 'mimes:jpeg,jpg,png'
            ];
    }
    public function rule_4 ()
    {
        return [
                'name'=>'required|min:3|max:100|unique:users,name',
                'password' =>'required|min:6 | max:100',
                'email'=> 'required| email | unique:admin,email',
                'birthday'=> 'date',
                'avatar' => 'mimes:jpeg,jpg,png'
            ];
    }
    /**
     * customize msg error
     * @return array
     */
    public function messages()
    {
        return [
            'required'=>'Không được bỏ trống :attribute.',
            'name.min'=>'Tên gồm ít nhất 3 ký tự!',
            'name.max'=>'Tên gồm tối đa 100 ký tự!',
            'password.min'=>'Password gồm ít nhất 6 ký tự!',
            'password.max'=>'Password gồm tối đa 100 ký tự!',
            'email'=>'Email không đúng định dạng .',
            'email.unique'=> 'Email đã tồn tại.',
            'birthday.date' => 'Sai định dạng thời gian !',
            'avatar.mimes'=>'Chỉ hỗ trợ định dạng file : jpg , fpeg , png .'
        ];
    }
}
