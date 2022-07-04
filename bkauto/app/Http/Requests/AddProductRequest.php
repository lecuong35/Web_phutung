<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
            'name' => 'required',
            'price' => 'required|regex:/^(\d+(,\d{1,2})?)?$/',
            'describe' => 'required',
            'image' => 'required',
            'type_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nhập tên sản phẩm',
            'price.required' => 'Nhập giá cho sản phẩm',
            'price.regex' => 'Giá phải là số',
            'image.required' => 'Nhập ảnh',
            'typed_id.required' => ' Chọn loại sản phẩm',
            'describe.required' => 'Nhập miêu tả cho sản phẩm'
        ];
    }
}
