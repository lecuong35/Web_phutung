<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required|min:6',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên không được để trống',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Không đúng dạng Email',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu chứa tối thiểu 6 ký tự',
            'phone.min' => 'Tối thiểu 10 chữ số',
            'phone.required' => 'Nhập số điện thoại',
            'phone.regex' => 'Số điện thoại không đúng'
        ];
    }
}
