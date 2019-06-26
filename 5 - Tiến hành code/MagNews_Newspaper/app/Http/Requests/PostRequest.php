<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title'=>'required|min:3|max:300',
            'des' =>'required|max:500',
            'category_id'=> 'required| integer',
            'content'=> 'required',
            'slug'=> 'required|unique:posts,slug_post|alpha_dash',
            ];

    }
    public function rules_1()
    {
        return [
            'title'=>'required|min:3|max:300',
            'des' =>'required|max:500',
            'category_id'=> 'required| integer',
            'content'=> 'required',
        ];
    }
    /**
     * customize msg error
     * @return array
     */
    public function messages()
    {
        return [
            'title.required'=>'Không được bỏ trống tiêu đề.',
            'title.unique' => 'Tin này đã bị trùng, vui lòng nhập lại!',
            'title.min'=>'Tên tin tức gồm ít nhất 3 ký tự!',
            'title.max'=>'Tên tin tức gồm tối đa 300 ký tự!',
            'des.required'=>'Không được bỏ trống tóm tắt.',
            'content.required'=>'Không được bỏ trống nội dung',
            'category_id.required'=> 'Không được bỏ trống chuyên mục.',
            'category_id.integer'=> 'Chọn sai chuyên mục.',
            'slug.unique' => 'Url đã tồn tại, vui lòng nhập lại tiều đề!',
            'slug.required'=> 'Không được bỏ trống url',
            'slug.alpha_dash'=> 'Sai định dạng slug.',
            ];
    }
     public function messages_1()
    {
        return [
            'title.required'=>'Không được bỏ trống tiêu đề.',
            'title.unique' => 'Tin này đã bị trùng, vui lòng nhập lại!',
            'title.min'=>'Tên tin tức gồm ít nhất 3 ký tự!',
            'title.max'=>'Tên tin tức gồm tối đa 300 ký tự!',
            'des.required'=>'Không được bỏ trống tóm tắt.',
            'content.required'=>'Không được bỏ trống nội dung',
            'category_id.required'=> 'Không được bỏ trống chuyên mục.',
            'category_id.integer'=> 'Chọn sai chuyên mục.',
        ];
    }
}
