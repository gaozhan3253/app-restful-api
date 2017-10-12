<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class adminLoginPost extends FormRequest
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
            'email' => 'required',
            'password' => 'required',
            'verify' => 'required',
        ];
    }

    /**
     * 获取已定义的验证规则的错误消息。
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => '用户账号不能为空',
            'password.required' => '密码不能为空',
            'verify.required' => '验证码不能为空',
        ];
    }
}
