<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/12 0012
 * Time: 10:22
 */

namespace App\Facades\Aes;


class Aes
{
    /**
     * pkcs7补码
     * @param string $string  明文
     * @param int $blocksize Blocksize , 以 byte 为单位
     * @return String
     */
    private function addPkcs7Padding($string, $blocksize = 16) {
        $len = strlen($string); //取得字符串长度
        $pad = $blocksize - ($len % $blocksize); //取得补码的长度
        $string .= str_repeat(chr($pad), $pad); //用ASCII码为补码长度的字符， 补足最后一段
        return $string;
    }

    /**
     * 除去pkcs7 补码
     * @param String 解密后的结果
     * @return String
     */
    private function stripPkcs7Padding($string){
        if(empty($string)){
            return false;
        }
        $slast = ord(substr($string, -1));
        $slastc = chr($slast);

        if(preg_match("/$slastc{".$slast."}/", $string)){
            $string = substr($string, 0, strlen($string)-$slast);
            return $string;
        } else {
            return false;
        }
    }


    /**
     * AES-128-CBC加密
     * @param $data 要加密的内容
     * @return string 加密后内容
     */
    function aes128cbcEncrypt($data,$key,$iv = null)
    {
        if(empty($iv)){
            $iv = $key;
        }
        $iv = $this->ivSbustr($iv);

//        openssl_encrypt("加密内容", "加密方式", "key", 0, "16补码");
        return openssl_encrypt($this->addPkcs7Padding($data),'AES-128-CBC',$key,0, $iv);
    }

    /**
     * AES-128-CBC解密
     * @param $data 要解密的内容
     * @return String 解密后的内容
     */
    function aes128cbcDecrypt($data,$key,$iv = null)
    {
        if(empty($iv)){
            $iv = $key;
        }
        $iv = $this->ivSbustr($iv);
        return  $this->stripPkcs7Padding(openssl_decrypt($data, 'AES-128-CBC',$key,0, $iv));
    }

    private function ivSbustr($iv,$length=16)
    {
        return substr($iv,0,$length);
    }
}