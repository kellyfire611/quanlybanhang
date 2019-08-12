<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_code' => 'required|min:3|max:20|unique:categories', //tên table categories
            'category_name' => 'required|min:3|max:20',
        ];
    }

    public function messages()
    {
        return [
            'category_code.required' => 'Vui lòng nhập Mã Loại sản phẩm',
            'category_code.min' => 'Vui lòng nhập Mã Loại sản phẩm ít nhất 3 ký tự',
            'category_code.max' => 'Vui lòng nhập Mã Loại sản phẩm tối đa 20 ký tự',
            'category_code.unique' => 'Mã loại sản phẩm này đã tồn tại. Vui lòng nhập mã khác',
            'category_name.required' => 'Vui lòng nhập Tên sản phẩm',
            'category_name.min' => 'Vui lòng nhập Tên sản phẩm ít nhất 3 ký tự',
            'category_name.max' => 'Vui lòng nhập Tên sản phẩm tối đa 20 ký tự',
        ];
    }
}
