<?php

namespace App\Api\V1\Requests;

use App\Api\BaseRequestPost;


class CartPost extends BaseRequestPost
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'good_id' => 'required|integer',
            'number' => 'integer',
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
            'good_id.required' => '商品ID必须存在',
            'good_id.integer' => '商品ID必须为int格式',
            'number.integer' => '商品数量必须为int格式',
        ];
    }
}
