<?php

namespace App\Api\V1\Middleware;

use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
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
//            $aes_key = '8f14e45fceea167a5a36dedd4bea2543';
//            $rsa_aes_key = 'GD9amEvsBbZuJS+rZ1iUjq5rkQMdn9O/+FM4x8Vv9EnnHOd6r8mxLO8xIc/b7+gJAGsDC08GzCAuUtAhdksK7P9Wh47z4Mrj6uRkJ6LqLP7u9ORjBIQPtkjy2InZFGs1faHqQptgZOZtILBDG//Ibv0gqf4IpLHoVFRP453KcVQ=';
//



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
//            $temp_header = [
//                "token" => "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEyLCJpc3MiOiJodHRwOi8vbG9jYWxob3N0L3Nob3BBcHAvcHVibGljL2FwaS9yZWdpc3RlciIsImlhdCI6MTUwNzc3OTk0OSwiZXhwIjoxNTA3OTk1OTQ5LCJuYmYiOjE1MDc3Nzk5NDksImp0aSI6IjRkS0tBb0ZoUHk5TzhuanQifQ.6ce16ZUKzxs2td2cpaZ0OUAnZUmArzw9Yk8WpNa3-jo",
//                "time" => '1507792760',
//                "version" => "1.1",
//                "did" => "123456789",
//                "onlytoken" => '182709',
//            ];
//            $temp_header = json_encode( $temp_header );
//            $temp_header = AesOptions::aes128cbcEncrypt($temp_header,$aes_key);
//            dump($temp_header);
//            exit;
//            $temp_body = [
//              'username'=>'gaozhan',
//                'city'=>'深圳'
//            ];
//            $temp_body = json_encode( $temp_body );
//            $temp_body = AesOptions::aes128cbcEncrypt($temp_body,$aes_key);
//            dump($temp_body);
//            exit;

            //接收aes加密的header
            $aes_header = $request->header('aes-header');
            if (empty($aes_header)) {
                return response()->json(['message' => '非法访问', 'status_code' => 401], 401);
            }



            //解密aes加密字符串
            $headers = AesOptions::aes128cbcDecrypt($aes_header,$aes_key);
            $headers = json_decode($headers);

            //验证是否存在必须time字段 因为time字段绝对存在
            if (empty($headers) || empty($headers->time)) {
                return response()->json(['message' => '非法访问', 'status_code' => 401], 401);
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

            //将解密后的header写回header中
            foreach ($headers as $key=>$value){
                //jwt验证token格式化处理
                if($key == 'token'){
                    $key = 'authorization';
                    $value = 'bearer '.$value;
                }
                $request->headers->set($key, $value);
            }

            //获取body
            $aes_body = $request->get('aes-body','');
            //解密aes加密字符串
            $bodys = AesOptions::aes128cbcDecrypt($aes_body,$aes_key);
            $bodys = json_decode($bodys);
            $request->bodys = $bodys;

        } catch (JWTException $e) {
            throw new JWTException($e->getMessage(),$e->getStatusCode());
        }

        return $next($request);
    }
}
