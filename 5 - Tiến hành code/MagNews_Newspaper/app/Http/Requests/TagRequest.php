<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
            'tag-name'=>'required|unique:tags,name_tag|max:100',
            'slug'=> 'required|unique:tags,slug_tag|alpha_dash|max:100',
        ];
    }

    public function messages()
    {
        return [
                'tag-name.required'=>'Bạn chưa nhập tên tag !',
                'tag-name.unique' => 'Tag đã tồn tại, vui lòng nhập lại tên khác !',
                'tag-name.max'=>'Tên tag gồm tối đa 100 ký tự! ',
                'slug.unique' => 'Đường dẫn đã tồn tại, vui lòng nhập lại tên khác!',
                'slug.required'=> 'Bạn chưa nhập tên đường dẫn ! ',
                'slug.alpha_dash'=> 'Sai định dạng đường dẫn ! ',
        ];
    }


    public function rules_update()
    {
        return [
                'tag-name' => 'required|max:100 ',
                'slug' => 'required|max:100'
            ];
    }

    public function messages_update()
    {
        return [
            'tag-name.required' => 'Tag không được bỏ trống !',
            'tag-name.max' => 'Tag phải ít hơn :max ký tự.',
            'slug.max' => 'Slug phải ít hơn :max ký tự.',
            'slug.required' => 'Đường dẫn không được bỏ trống.',
        ];
    }
}
