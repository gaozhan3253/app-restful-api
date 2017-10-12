<?php
/**
 * 所有api的验证器的基类 重写了failedValidation方法
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/9 0009
 * Time: 9:26
 */

namespace App\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Dingo\Api\Exception\StoreResourceFailedException;

class BaseRequestPost extends FormRequest
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
     * 重写的方法 错误返回改用dingo的api json方式
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        $message = $validator->errors()->first();
        throw new StoreResourceFailedException($message);
    }

}
