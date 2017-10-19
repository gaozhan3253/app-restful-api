<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/8 0008
 * Time: 17:14
 */
namespace App\Api\V1\Controllers;

use App\Api\BaseController;

use App\Api\V1\Requests\memberLoginPost;
use App\Api\V1\Requests\memberRegisterPost;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\Member;
use Log;

/**
 * @SWG\Tag(
 *     name="Public",
 *     description="登录注册"
 * )
 * Class PublicController
 * @package App\Api\V1\Controllers
 */
class PublicController extends BaseController
{
    /**
     * @SWG\Post(path="/api/login",
     *   tags={"Public"},
     *   summary="登录",
     *   description="登录功能",
     *   operationId="login",
     *   produces={"application/json"},
     * @SWG\Parameter(
     *     in="header",
     *     name="rsa-aes-key",
     *     type="string",
     *     description="Rsa加密后的随机AES加密字符串",
     *     required=true,
     *   ),
     * @SWG\Parameter(
     *     in="header",
     *     name="aes-header",
     *     type="string",
     *     description="使用随机AES加密字符串加密后的Header信息 包含版本、请求时间 等信息",
     *     required=true,
     *   ),
     *@SWG\Parameter(
     *     in="formData",
     *     name="username",
     *     type="string",
     *     description="用户名",
     *     required=true,
     *   ),
     *@SWG\Parameter(
     *     in="formData",
     *     name="password",
     *     type="string",
     *     description="密码",
     *     required=true,
     *   ),
     *   @SWG\Response(
     *     response="200",
     *     description="登录成功"
     *   ),
     *   @SWG\Response(
     *     response="401",
     *     description="登录失败,用户名或密码错误"
     *   ),
     *   @SWG\Response(
     *     response="500",
     *     description="JWT报错"
     *   ),
     * )
     */
    public function login(memberLoginPost $request)
    {
        $username = $request->input('username', '');
        $password = $request->input('password', '');
        $checkLogin = [
            'user_login' => $username,
            'password' => $password,
            'status' => 1,
        ];

        try {
            if (!$token = JWTAuth::attempt($checkLogin)) {
                return $this->response()->error('登录失败,用户名或密码错误', 401);
            }
        } catch (JWTException $e) {
            return $this->response()->error($e->getMessage(), 500);
        }

        $user = Member::where(['user_login'=>$username,'status'=>1])->first();
        return $this->response->array(compact('token','user'));
    }



    /**
     * @SWG\Post(path="/api/register",
     *   tags={"Public"},
     *   summary="注册",
     *   description="注册功能",
     *   operationId="register",
     *   produces={"application/json"},
     * @SWG\Parameter(
     *     in="header",
     *     name="rsa-aes-key",
     *     type="string",
     *     description="Rsa加密后的随机AES加密字符串",
     *     required=true,
     *   ),
     * @SWG\Parameter(
     *     in="header",
     *     name="aes-header",
     *     type="string",
     *     description="使用随机AES加密字符串加密后的Header信息 包含版本、请求时间 等信息",
     *     required=true,
     *   ),
     *@SWG\Parameter(
     *     in="formData",
     *     name="username",
     *     type="string",
     *     description="用户名",
     *     required=true,
     *   ),
     *@SWG\Parameter(
     *     in="formData",
     *     name="email",
     *     type="string",
     *     description="邮箱",
     *     required=true,
     *   ),
     *@SWG\Parameter(
     *     in="formData",
     *     name="password",
     *     type="string",
     *     description="密码",
     *     required=true,
     *   ),
     *   @SWG\Response(
     *     response="200",
     *     description="注册成功"
     *   ),
     *   @SWG\Response(
     *     response="401",
     *     description="邮箱已经被注册"
     *   ),
     * )
     */
    public function register(memberRegisterPost $request)
    {
        $newUser = [
            'user_login' => $request->get('username'),
            'user_email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ];
        $userExist = Member::findUserEmail($newUser['user_email']);
        if (!empty($userExist)) {
            return $this->response()->error('该邮箱已注册', 401);
        }
        $user = Member::create($newUser);
        $token = JWTAuth::fromUser($user);
        return $this->response->array(compact('token','user'));
    }


    /**
     * @SWG\Get(path="/api/updatetoken",
     *   tags={"Public"},
     *   summary="刷新token",
     *   description="刷新token功能",
     *   operationId="updatetoken",
     *   produces={"application/json"},
    @SWG\Parameter(
     *     in="header",
     *     name="rsa-aes-key",
     *     type="string",
     *     description="Rsa加密后的随机AES加密字符串",
     *     required=true,
     *   ),
     * @SWG\Parameter(
     *     in="header",
     *     name="aes-header",
     *     type="string",
     *     description="使用随机AES加密字符串加密后的Header信息 包含版本、请求时间、Token等信息",
     *     required=true,
     *   ),
     *   @SWG\Response(
     *     response="200",
     *     description="获取成功"
     *   ),
     *   @SWG\Response(
     *     response="400",
     *     description="JWT报错"
     *   ),
     * )
     */
    public function updateToken()
    {
        try{
            //换新token
            $token = JWTAuth::refresh();
            return $this->response->array(['token' => $token]);
        }catch (JWTException $e){
            return $this->response->error($e->getMessage(),400);
        }
    }



    /**
     * @SWG\Get(path="/api/getservertime",
     *   tags={"Public"},
     *   summary="获取服务器时间戳",
     *   description="获取服务器时间戳功能",
     *   operationId="getservertime",
     *   produces={"application/json"},
     * @SWG\Parameter(
     *     in="header",
     *     name="rsa-aes-key",
     *     type="string",
     *     description="Rsa加密后的随机AES加密字符串",
     *     required=true,
     *   ),
     * @SWG\Parameter(
     *     in="header",
     *     name="aes-header",
     *     type="string",
     *     description="使用随机AES加密字符串加密后的Header信息 包含版本、请求时间、Token等信息",
     *     required=true,
     *   ),
     *   @SWG\Response(
     *     response="200",
     *     description="获取成功"
     *   ),
     * )
     */
    public function getServerTime()
    {
        return $this->response->array(['time'=>time()]);
    }
}