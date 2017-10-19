<?php

namespace App\Api\V1\Requests;

use App\Api\BaseRequestPost;


class memberAddressPost extends BaseRequestPost
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'region' => 'required',
            'address' => 'required',
            'mobile' => 'required',
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
            'name.required' => '收货人名称不能为空',
            'address.required' => '收货地址不能为空',
            'mobile.required' => '收货人联系方式不能为空',
            'region.required' => '收货区域不能为空',
        ];
    }
}
