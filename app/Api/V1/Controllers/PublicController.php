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


class PublicController extends BaseController
{
    /**
     * 登录
     * @param memberLoginPost $request
     * @return \Illuminate\Http\JsonResponse|void
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
                return $this->response()->error('登录失败', 401);
            }
        } catch (JWTException $e) {
            return $this->response()->error($e->getMessage(), 500);
        }

        $user = Member::where(['user_login'=>$username,'status'=>1])->first();


        return $this->response->array(compact('token','user'));
    }

    /**
     * 注册
     * @param memberRegisterPost $request
     * @return \Illuminate\Http\JsonResponse|void
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
     * 刷新token
     * @return mixed
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

    public function getServerTime()
    {
        return $this->response->array(['time'=>time()]);
    }
}