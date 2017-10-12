<?php

namespace App\Api\V1\Requests;

use App\Api\BaseRequestPost;


class memberLoginPost extends BaseRequestPost
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required',
            'password' => 'required',
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
            'username.required' => '用户账号不能为空',
            'password.required' => '密码不能为空',
        ];
    }
}
