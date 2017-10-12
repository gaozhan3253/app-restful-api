<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/12 0012
 * Time: 10:22
 */

namespace App\Facades\Rsa;

use Tymon\JWTAuth\Exceptions\JWTException;

class Rsa
{
    //key路径
    protected $key_path = '/certs/';

    //加密Key名称
    protected $public_key_name = 'rsa_public_key.pem';

    //解密Key名称
    protected $private_key_name = 'rsa_private_key.pem';

    //加密Key
    protected $public_key = '';

    //解密Key
    protected $private_key = '';


    public function __construct()
    {
        $path = storage_path().$this->key_path;
        $public_key = file_get_contents($path.$this->public_key_name);
        $private_key = file_get_contents($path.$this->private_key_name);

        $this->private_key =  openssl_pkey_get_private($private_key);//这个函数可用来判断私钥是否是可用的，可用返回资源id Resource id
        $this->public_key = openssl_pkey_get_public($public_key);//这个函数可用来判断公钥是否是可用的
       if(! $this->private_key ){
           throw new JWTException('RSA配置错误');
       }
        if(! $this->public_key ){
            throw new JWTException('RSA配置错误');
        }
    }


    /**
     * 加密
     * @param $data  要加密的内容
     * @return string 加密后的密文
     */
    public function encrypt($data)
    {
        $encrypted = ''; //加密内容
        openssl_public_encrypt($data, $encrypted, $this->public_key);//公钥加密
        $encrypted = base64_encode($encrypted);// base64传输转换
        return $encrypted;
    }


    /**
     * 解密
     * @param $data 要解密的密文
     * @return string 解密后的内容
     */
    public function decrypt($data)
    {
        $decrypted = ''; //解密内容
        $data = base64_decode($data); //base64传输解码
        openssl_private_decrypt($data, $decrypted, $this->private_key);//私钥解密
        return $decrypted;
    }

}