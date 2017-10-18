<?php

namespace App\Api\V1\Requests;

use App\Api\BaseRequestPost;


class memberUpdateArchivesPost extends BaseRequestPost
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nickname' => 'required',
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
            'nickname.required' => '用户昵称不能为空',
        ];
    }
}
