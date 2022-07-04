<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddTypeRequest extends FormRequest
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
            'code' => 'required',
            'describe' => 'required',
            'branch' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nhập tên loại sản phẩmm',
            'code.required' => 'Nhập mã Code cho loại sản phẩm',
            'describe.required' => 'Nhập miêu tả loại',
            'branch.required' => 'Nhập nhãn chi nhánh'
        ];
    }
}
