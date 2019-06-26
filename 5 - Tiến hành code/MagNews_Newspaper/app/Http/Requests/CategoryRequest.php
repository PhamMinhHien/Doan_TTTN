<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'cate_name'=>'required|unique:categories,name_category|min:3|max:70',
            'slug'=> 'required|unique:categories,slug_category|alpha_dash|max:300',
            'parent_id'=> 'integer',
        ];
    }

    /**
     * customize msg error
     * @return array
     */
    public function messages()
    {
        return [
            'cate_name.required'=>'Bạn chưa nhập tên danh mục!',
            'cate_name.unique'=>'Tên danh mục đã tồn tại !',
            'cate_name.min'=>'Tên danh mục gồm ít nhất 3 ký tự!',
            'cate_name.max'=>'Tên danh mục gồm tối đa 70 ký tự!',

            'slug.unique' => 'Đường dẫn danh mục đã tồn tại !',
            'slug.required'=> 'Bạn chưa nhập đường dẫn danh mục !',
            'slug.alpha_dash'=> 'Sai định dạng đường dẫn !',
            'slug.max'=>'Tên đường dãn gồm tối đa 300 ký tự!',
            'parent_id.integer' => 'Danh mục cha phải là số.'
        ];
    }

     public function rules_update()
    {
        return [
            'cate-name'=>'required|min:3|max:70',
            'slug'=> 'required|alpha_dash|max:300',
        ];
    }

    /**
     * customize msg error
     * @return array
     */
    public function messages_update()
    {
        return [
            'cate-name.required'=>'Bạn chưa nhập tên danh mục!',
            'cate-name.min'=>'Tên danh mục gồm ít nhất 3 ký tự!',
            'cate-name.max'=>'Tên danh mục gồm tối đa 70 ký tự!',

            'slug.required'=> 'Bạn chưa nhập đường dẫn danh mục !',
            'slug.alpha_dash'=> 'Sai định dạng đường dẫn !',
            'slug.max'=>'Tên đường dãn gồm tối đa 300 ký tự!',
        ];
    }
}
