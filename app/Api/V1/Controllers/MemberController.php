<?php

namespace App\Api\V1\Controllers;


use App\Api\BaseController;
use App\Api\V1\Requests\memberUpdateArchivesPost;
use App\Api\V1\Transformers\UserTransformer;
use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends BaseController
{
    /**
     * 获取当前用户信息
     * @return \Dingo\Api\Http\Response
     * @throws Exception
     */
    public function index()
    {
//        $user = JWTAuth::parseToken()->authenticate();
        //测试 直接查询获取用户
        $user = Member::find(12);
        //测试 正式的无需使用这个 jwt获取不到用户会直接返回错误了
        if (empty($user)) {
            throw new Exception('无效用户', 401);
        }
        return $this->response->item($user,new UserTransformer());
    }

    /**
     * 更新用户资料
     * 接收
     * nickname 用户昵称
     * avatar 用户头像
     * qq
     * wechat
     * sex 1男 2女 0其他
     * @param memberUpdateArchivesPost $request
     * @return \Dingo\Api\Http\Response
     * @throws Exception
     */
    public function updateArchives(memberUpdateArchivesPost $request)
    {
        //        $user = JWTAuth::parseToken()->authenticate();
        //测试 直接查询获取用户
        $user = Member::find(12);
        //测试 正式的无需使用这个 jwt获取不到用户会直接返回错误了
        if (empty($user)) {
            throw new Exception('无效用户', 401);
        }
        Member::updateArchives($user,$request);
        return $this->response->accepted();
    }
}
