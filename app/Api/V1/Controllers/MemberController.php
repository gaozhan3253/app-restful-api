<?php

namespace App\Api\V1\Controllers;


use App\Api\BaseController;
use App\Api\V1\Requests\memberUpdateArchivesPost;
use App\Api\V1\Transformers\UserTransformer;
use App\Models\Member;


/**
 *   @SWG\Tag(
 *     name="Member",
 *     description="用户信息操作",
 *   ),
 */
class MemberController extends BaseController
{

    /**
     * @SWG\Get(path="/api/member",
     *   tags={"Member"},
     *   summary="获取当前用户信息",
     *   description="请求该接口需要先登录。",
     *   operationId="member",
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
     * )
     */
    public function index()
    {
        $user = JWTAuth::parseToken()->authenticate();
//        //测试 直接查询获取用户
//        $user = Member::find(12);
//        //测试 正式的无需使用这个 jwt获取不到用户会直接返回错误了
//        if (empty($user)) {
//            return $this->response->error('无效用户',401);
//        }
        return $this->response->item($user,new UserTransformer());
    }

    /**
     * @SWG\Put(path="/api/member",
     *   tags={"Member"},
     *   summary="更新用户资料",
     *   description="请求该接口需要先登录。",
     *   operationId="member",
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
     * @SWG\Parameter(
     *     in="formData",
     *     name="aes-body",
     *     type="string",
     *     description="使用随机AES加密字符串加密后的Body信息 包含如下内容：",
     *     required=true,
     *   ),
     * @SWG\Parameter(
     *     in="formData",
     *     name="nickname",
     *     type="string",
     *     default="无效参数",
     *     description="用户昵称 (组合后加密到aes-body中 本字段不要单独传递)",
     *     required=true,
     *   ),
     * @SWG\Parameter(
     *     in="formData",
     *     name="avatar",
     *     type="string",
     *     default="无效参数",
     *     description="用户头像 (组合后加密到aes-body中 本字段不要单独传递)",
     *     required=false,
     *   ),
     * @SWG\Parameter(
     *     in="formData",
     *     name="qq",
     *     type="string",
     *     default="无效参数",
     *     description="用户QQ号码 (组合后加密到aes-body中 本字段不要单独传递)",
     *     required=false,
     *   ),
     * @SWG\Parameter(
     *     in="formData",
     *     name="wechat",
     *     type="string",
     *     default="无效参数",
     *     description="用户微信号码 (组合后加密到aes-body中 本字段不要单独传递)",
     *     required=false,
     *   ),
     * @SWG\Parameter(
     *     in="formData",
     *     name="sex",
     *     type="string",
     *     default="无效参数",
     *     description="性别 0其他 1男 2女 (组合后加密到aes-body中 本字段不要单独传递)",
     *     required=false,
     *   ),
     *   @SWG\Response(
     *     response="201",
     *     description="修改成功"
     *   ),
     *   @SWG\Response(
     *     response="500",
     *     description="Token校验失败"
     *   ),
     * )
     */
    public function updateArchives(memberUpdateArchivesPost $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
//        //测试 直接查询获取用户
//        $user = Member::find(12);
//        //测试 正式的无需使用这个 jwt获取不到用户会直接返回错误了
//        if (empty($user)) {
//            return $this->response->error('无效用户',401);
//        }
        Member::updateArchives($user,$request);
        return $this->response->created();
    }
}
