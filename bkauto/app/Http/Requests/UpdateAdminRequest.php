<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required|min:6',
            'facebook' => 'required',
            'bank' => 'required',
            'phone' => 'min:10|max:11|regex:/^([0-9\s\-\+\(\)]*)$/'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Không đúng dạng Email',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu chứa tối thiểu 6 ký tự',
            'phone.min' => 'Tối thiểu 10 chữ số',
            'phone.max' => 'Tối đa 11 chữ số',
            'phone.regex' => 'Số điện thoại không đúng',
            'bank.required' => 'Bank không được để trống',
            'facebook.required' => 'Facebook không được để trống',
        ];
    }
}
