<?php

namespace App\Api\V1\Middleware;

use Closure;
use Mockery\CountValidator\Exception;
use JWTAuth;
use Log;
use Cache;
use RsaOptions;
use AesOptions;


class Decrypt
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {

//            //测试用获取加密aes-key
            $aes_key = '8f14e45fceea167a5a36dedd4bea2543';
            $rsa_aes_key = 'GD9amEvsBbZuJS+rZ1iUjq5rkQMdn9O/+FM4x8Vv9EnnHOd6r8mxLO8xIc/b7+gJAGsDC08GzCAuUtAhdksK7P9Wh47z4Mrj6uRkJ6LqLP7u9ORjBIQPtkjy2InZFGs1faHqQptgZOZtILBDG//Ibv0gqf4IpLHoVFRP453KcVQ=';
            $loginregister_aes_header = 'o9RIO0I+1JETCq5wFRdp43ZlJPM7qKHYjzWTJxpf6hbSTaUt22IaSwMfal/vnO3SQznofSnkEjKQjcJU71twcGQKkZzvlnLscxxYXWSj4qvTC7WLAAp2HaJt1fyP4G3a';
            $login_aes_body = 'sAqgen1u8sVHqV8i9Pk97bHh/9k5OHPzAQ24423iwXfGP5j2NZ2rwGGcDodqDdAL625QuwCruw2prmDGNVDPww==';
            $register_aes_body = 'sAqgen1u8sVHqV8i9Pk97bHh/9k5OHPzAQ24423iwXfJtC95EPpsYuZAbYX84HGW0NS4CAWNcn3qEwR99UA+EyFxBqlKFa27pmAZ+hTL+sfLr4joBQoExQTY2GG3GbN7';
            $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEyLCJpc3MiOiJodHRwOi8vbG9jYWxob3N0L3Nob3BhcHAvcHVibGljL2FwaS9sb2dpbiIsImlhdCI6MTUwODA0MTQzMSwiZXhwIjoxNTA4MjU3NDMxLCJuYmYiOjE1MDgwNDE0MzEsImp0aSI6Ik9BMWlyZ3o2bFkzdTlkN3EifQ.G5ThtaVYe2EUy0dOmIHJbnro4Cylh6le4NBDkzIDtZw';
            $all_aes_header = '/MhbeX/fclqwBlSDwfkMLBfVDVO14raupMUnjA5w7Ju3H0pYY9aTb08IoEeX7tovfVq1+siMTWr9oQPXVHy2we+11T0u8kL8oq+wyzsjNPn0jeT37awWzoWgl6KMQ/kzMtJ7VBmOeksiqiDZPc6RF3nnRc3tEwxd4/aUfG3CD8bOE3wpTGG1ZljrpNc5PMVd7ueItjP2n3OP9cC2jDBg601bkLPOX1ObSE+HqxvTwwtTIJ8jT2quNWcLxPoHDjYGxm1PJIPe4PI/9F3yzadvQLVrU/7Skv90Xbg3BApgmO4A5e0f6OSkXN5rK7idDrDtB0yZ0lnot9+xLO9Zx4Rvykce2SralbCy0Y0tzg8R8UYfV0Au+2JPTXIx7RvxmqN140W84iSu47EGT1NMUgWgkp97x2uGNt6IqStN7TW3nxU4IBoVppemfQ+zOTtDMOga+1YaBVyNtU6fUkKrDvudPqb/drR0oxrUJRTylQuZ61o=';
//
//            $temp_header = [
//                "token" => "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEyLCJpc3MiOiJodHRwOi8vbG9jYWxob3N0L3Nob3BhcHAvcHVibGljL2FwaS9sb2dpbiIsImlhdCI6MTUwODA0MTQzMSwiZXhwIjoxNTA4MjU3NDMxLCJuYmYiOjE1MDgwNDE0MzEsImp0aSI6Ik9BMWlyZ3o2bFkzdTlkN3EifQ.G5ThtaVYe2EUy0dOmIHJbnro4Cylh6le4NBDkzIDtZw",
//                "time" => '1507802760',
//                "version" => "1.1",
//                "did" => "123456789",
//                "onlytoken" => '182709',
//            ];
//            $temp_header = json_encode( $temp_header );
//            $temp_header = AesOptions::aes128cbcEncrypt($temp_header,$aes_key);
//            dump($temp_header);
//            exit;
//            $temp_body = [
//              'username'=>'17603008613',
//                'password'=>'123456',
//                'email'=>'827951152@qq.com'
//            ];
//            $temp_body = json_encode( $temp_body );
//            $temp_body = AesOptions::aes128cbcEncrypt($temp_body,$aes_key);
//            dump($temp_body);
//            exit;


            //获取rsa_aes_key
            $rsa_aes_key = $request->header('rsa-aes-key');
            //不存在rsa加密字符串时
            if (empty($rsa_aes_key)) {
                return response()->json(['message' => '非法访问', 'status_code' => 401], 401);
            }

            //解密rsa加密字符串 得到aes加密字符串
            $aes_key = RsaOptions::decrypt($rsa_aes_key);
            if (empty($aes_key)) {
                return response()->json(['message' => '非法访问', 'status_code' => 401], 401);
            }

            //接收aes加密的header
            $aes_header = $request->header('aes-header');
            if (empty($aes_header)) {
                return response()->json(['message' => '无加密header信息', 'status_code' => 401], 401);
            }


            //解密aes加密字符串

            $headers = AesOptions::aes128cbcDecrypt($aes_header,$aes_key);
            $headers = json_decode($headers);
            //验证是否存在必须time字段 因为time字段绝对存在
            if (empty($headers) || empty($headers->time)) {
                return response()->json(['message' => '无效header', 'status_code' => 401], 401);
            }

            //验证唯一性
            $onlyToken = $headers->onlytoken;
            $onlyToken = $headers->onlytoken.rand(000001,999999); //测试用 唯一性处理
            $onlyTokenHasBool = Cache::store('file')->has($onlyToken);
            if ($onlyTokenHasBool) {
                return response()->json(['message' => '重复请求', 'status_code' => 401], 401);
            } else {
                Cache::store('file')->put($onlyToken, '', 5);
            }

            //验证时效性
            $requestTime = $headers->time; //请求的时间戳
            $expiresTime = strtotime('-' . env('API_EXPIRES_TIME', 1) . ' minute'); //请求有效时间
            if ($expiresTime > $requestTime) {
                return response()->json(['message' => '请求已过期', 'status_code' => 401], 401);
            }

            //将aes_key保存 用于将返回信息加密
             define('AES_KEY', $aes_key);
            //将解密后的header写回header中
            if(count($headers)){
                foreach ($headers as $key=>$value){
                    //jwt验证token格式化处理
                    if($key == 'token'){
                        $key = 'authorization';
                        $value = 'bearer '.$value;
                    }
                    $request->headers->set($key, $value);
                }
            }


            //获取body
            $aes_body = $request->get('aes-body','');
            //解密aes加密字符串
            $bodys = AesOptions::aes128cbcDecrypt($aes_body,$aes_key);
            $bodys = json_decode($bodys);
            if(count($bodys)){
                foreach ($bodys as $key=>$value){
                    $request->offsetSet($key,$value);
                }
            }

        } catch (Exception $e) {
            return $this->response()->error($e->getMessage(), 500);
        }

        return $next($request);
    }
}
