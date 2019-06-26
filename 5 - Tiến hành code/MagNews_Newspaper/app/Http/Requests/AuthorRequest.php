<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
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
                'authorname'=>'required|unique:users,name|min:3|max:70',
                'email' =>'required|unique:users,email|email',
                'password' => 'required|min:6|max:50',
            ];
    }
    
    public function messages()
    {
        return [
                'authorname.required'=>' Bạn chưa nhập tên tác giả ',
                'authorname.min'=>' Tên tác giả gồm ít nhất 3 ký tự ',
                'authorname.max'=>' Tên tác giả gồm tối đa 70 ký tự ',
                'authorname.unique'=>'Tên tác giả đã tồn tại. Vui lòng nhập tên khác ',
                'email.unique' => ' Email đã tồn tại, vui lòng nhập lại email khác ',
                'email.required'=> ' Email là trường yêu cầu ',
                'email.email'=> ' Email không đúng định dạng ',
                'password.required'=> ' Password là trường yêu cầu ',
                'password.min' => ' Password gồm ít nhất 6 ký tự ',
                'password.max' => ' Password gồm nhiều nhất 50 ký tự '
            ];
    }
}
