<?php

namespace App\Api;

use App\Http\Controllers\Controller;
use Dingo\Api\Contract\Http\Request;
use Dingo\Api\Routing\Helpers;
use Illuminate\Contracts\Validation\Validator;
use AesOptions;


class BaseController extends Controller
{
    use Helpers;

    /**
     * 加密要返回的信息
     * @param $data
     * @param null $aes_key
     * @return bool
     */
    protected function aesEncrypt($data,$aes_key = null)
    {
        if(empty($aes_key)){
            $aes_key = AES_KEY;
        }

        if(!empty($aes_key)){
            return AesOptions::aes128cbcEncrypt($data,$aes_key);
        }else{
            return false;
        }
    }

    /**
     *传入要返回的信息 使用本次访问的传入的aes密码加密 再组装
     * @param $data 要加密的返回信息
     * @return mixed
     */
    protected function returnEncryptData($data)
    {
        $data = $this->aesEncrypt($data);
        $returnData = [
          'message'=>'success',
            'data'=>$data,
            'message_code'=>200
        ];
        return $returnData;
    }
}
