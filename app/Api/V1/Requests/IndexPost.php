<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/15 0015
 * Time: 下午 12:30
 */
namespace App\Api\V1\Requests;

use App\Api\BaseRequestPost;


class IndexPost extends BaseRequestPost
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
//            'username' => 'required|min:10',
//            'password' => 'required|email',
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
            'username.min' => '用户账户最小长度 :min',
            'password.required' => '密码不能为空',
            'password.email' => '请输入正确的邮箱',
        ];
    }
}