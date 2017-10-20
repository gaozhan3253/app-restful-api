<?php

namespace App\Api\V1\Requests;

use App\Api\BaseRequestPost;


class UploadImagePost extends BaseRequestPost
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'filename' => 'required|image',
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
            'filename.required' => '文件必须',
            'filename.image' => '文件必须问图片',
        ];
    }
}
