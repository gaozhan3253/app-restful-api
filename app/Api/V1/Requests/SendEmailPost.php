<?php

namespace App\Api\V1\Requests;

use App\Api\BaseRequestPost;


class SendEmailPost extends BaseRequestPost
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
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
            'email.required' => '邮箱必须',
            'email.email' => '邮箱格式不正常',
        ];
    }
}
