<?php

namespace App\Api\V1\Controllers;

use App\Api\BaseController;
use App\Api\V1\Transformers\AddressTransformer;
use App\Models\MemberAddress;
use Dingo\Api\Http\Request;
use App\Models\Member;
use App\Api\V1\Requests\memberAddressPost;
use JWTAuth;

/**
 *   @SWG\Tag(
 *     name="MemberAddress",
 *     description="用户收货地址操作",
 *   ),
 */

class AddressController extends BaseController
{
    /**
     * @SWG\Get(path="/api/address",
     *   tags={"MemberAddress"},
     *   summary="获取当前用户的收货地址列表",
     *   description="请求该接口需要先登录。",
     *   operationId="address",
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
     *     description="用户收货地址列表"
     *   ),
     *   @SWG\Response(
     *     response="500",
     *     description="Token校验失败"
     *   ),
     * )
     */
    public function index()
    {
//      $user = JWTAuth::parseToken()->authenticate();
        //测试 直接查询获取用户
        $user = Member::where(['status'=>1])->find(12);
        //测试 正式的无需使用这个 jwt获取不到用户会直接返回错误了
        if (empty($user)) {
            return $this->response->error('无效用户',401);
        }
        $address = $user->address;

        return $this->response->collection($address,new AddressTransformer());
//        return $this->response->array($this->returnEncryptData(json_encode($address->toArray())));  //加密返回
    }

    /**
     * @SWG\Get(path="/api/address/{id}",
     *   tags={"MemberAddress"},
     *   summary="获取指定收货地址",
     *   description="请求该接口需要先登录。",
     *   operationId="address",
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
     *     response="404",
     *     description="无效的收货地址"
     *   ),
     * )
     */
    public function show($id)
    {
//      $user = JWTAuth::parseToken()->authenticate();
        //测试 直接查询获取用户
        $user = Member::where(['status'=>1])->find(12);
        //测试 正式的无需使用这个 jwt获取不到用户会直接返回错误了
        if (empty($user)) {
            return $this->response->error('无效用户',401);
        }
        $address = $user->address->find($id);
        if (empty($address)) {
            return $this->response->error('无效地址',404);
        }
        return $this->response->item($address,new AddressTransformer());
//        return $this->returnEncryptData(json_encode($address->toArray()));  //加密返回
    }




    /**
     * @SWG\Post(path="/api/address",
     *   tags={"MemberAddress"},
     *   summary="添加收货地址",
     *   description="请求该接口需要先登录。",
     *   operationId="address",
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
     *     name="region",
     *     type="string",
     *     default="无效参数",
     *     description="收货地址的地区ID (组合后加密到aes-body中 本字段不要单独传递)",
     *     required=true,
     *   ),
     * @SWG\Parameter(
     *     in="formData",
     *     name="name",
     *     type="string",
     *     default="无效参数",
     *     description="收件人名称 (组合后加密到aes-body中 本字段不要单独传递)",
     *     required=true,
     *   ),
     * @SWG\Parameter(
     *     in="formData",
     *     name="address",
     *     type="string",
     *     default="无效参数",
     *     description="详细收件地址 (组合后加密到aes-body中 本字段不要单独传递)",
     *     required=true,
     *   ),
     * @SWG\Parameter(
     *     in="formData",
     *     name="mobile",
     *     type="string",
     *     default="无效参数",
     *     description="收件人联系电话 (组合后加密到aes-body中 本字段不要单独传递)",
     *     required=true,
     *   ),
     * @SWG\Parameter(
     *     in="formData",
     *     name="alias",
     *     type="string",
     *     default="无效参数",
     *     description="收件地址别名 (组合后加密到aes-body中 本字段不要单独传递)",
     *     required=false,
     *   ),
     * @SWG\Parameter(
     *     in="formData",
     *     name="postcodes",
     *     type="string",
     *     default="无效参数",
     *     description="邮政编码 (组合后加密到aes-body中 本字段不要单独传递)",
     *     required=false,
     *   ),
     * @SWG\Parameter(
     *     in="formData",
     *     name="description",
     *     type="string",
     *     default="无效参数",
     *     description="地址备注 (组合后加密到aes-body中 本字段不要单独传递)",
     *     required=false,
     *   ),
     * @SWG\Parameter(
     *     in="formData",
     *     name="is_default",
     *     type="string",
     *     default="无效参数",
     *     description="是否默认地址 1是 0否 (组合后加密到aes-body中 本字段不要单独传递)",
     *     required=false,
     *   ),
     *   @SWG\Response(
     *     response="201",
     *     description="添加成功"
     *   ),
     *   @SWG\Response(
     *     response="422",
     *     description="添加失败"
     *   ),
     *   @SWG\Response(
     *     response="500",
     *     description="Token校验失败"
     *   ),
     * )
     */
    public function store(memberAddressPost $request)
    {
//      $user = JWTAuth::parseToken()->authenticate();
        //测试 直接查询获取用户
        $user = Member::where(['status'=>1])->find(12);
        //测试 正式的无需使用这个 jwt获取不到用户会直接返回错误了
        if (empty($user)) {
            return $this->response->error('无效用户',401);
        }

        if(MemberAddress::createAddress($request,$user)){
            return $this->response->created();
        }else{
            return $this->response->error('添加失败',422);
        }
    }




    /**
     * @SWG\Put(path="/api/address/{id}",
     *   tags={"MemberAddress"},
     *   summary="修改收货地址",
     *   description="请求该接口需要先登录。",
     *   operationId="address",
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
     *     name="region",
     *     type="string",
     *     default="无效参数",
     *     description="收货地址的地区ID (组合后加密到aes-body中 本字段不要单独传递)",
     *     required=true,
     *   ),
     * @SWG\Parameter(
     *     in="formData",
     *     name="name",
     *     type="string",
     *     default="无效参数",
     *     description="收件人名称 (组合后加密到aes-body中 本字段不要单独传递)",
     *     required=true,
     *   ),
     * @SWG\Parameter(
     *     in="formData",
     *     name="address",
     *     type="string",
     *     default="无效参数",
     *     description="详细收件地址 (组合后加密到aes-body中 本字段不要单独传递)",
     *     required=true,
     *   ),
     * @SWG\Parameter(
     *     in="formData",
     *     name="mobile",
     *     type="string",
     *     default="无效参数",
     *     description="收件人联系电话 (组合后加密到aes-body中 本字段不要单独传递)",
     *     required=true,
     *   ),
     * @SWG\Parameter(
     *     in="formData",
     *     name="alias",
     *     type="string",
     *     default="无效参数",
     *     description="收件地址别名 (组合后加密到aes-body中 本字段不要单独传递)",
     *     required=false,
     *   ),
     * @SWG\Parameter(
     *     in="formData",
     *     name="postcodes",
     *     type="string",
     *     default="无效参数",
     *     description="邮政编码 (组合后加密到aes-body中 本字段不要单独传递)",
     *     required=false,
     *   ),
     * @SWG\Parameter(
     *     in="formData",
     *     name="description",
     *     type="string",
     *     default="无效参数",
     *     description="地址备注 (组合后加密到aes-body中 本字段不要单独传递)",
     *     required=false,
     *   ),
     * @SWG\Parameter(
     *     in="formData",
     *     name="is_default",
     *     type="string",
     *     default="无效参数",
     *     description="是否默认地址 1是 0否 (组合后加密到aes-body中 本字段不要单独传递)",
     *     required=false,
     *   ),
     *   @SWG\Response(
     *     response="201",
     *     description="修改成功"
     *   ),
     *   @SWG\Response(
     *     response="404",
     *     description="无效的收货地址"
     *   ),
     *   @SWG\Response(
     *     response="500",
     *     description="Token校验失败"
     *   ),
     * )
     */
    public function update(Request $request, $id)
    {

        //$user = JWTAuth::parseToken()->authenticate();
        //测试 直接查询获取用户
        $user = Member::find(12);
        //测试 正式的无需使用这个 jwt获取不到用户会直接返回错误了
        if (empty($user)) {
            return $this->response->error('无效用户',401);
        }
        $address = $user->address->find($id);
        if(empty($address)){
            return $this->response->error('无效地址',404);
        }
        MemberAddress::updateAddress($request,$address);
        return $this->response->accepted();
    }

    /**
     * @SWG\Delete(path="/api/address/{id}",
     *   tags={"MemberAddress"},
     *   summary="修改收货地址",
     *   description="请求该接口需要先登录。",
     *   operationId="address",
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
     *     response="204",
     *     description="删除用户收货地址成功"
     *   ),
     *   @SWG\Response(
     *     response="404",
     *     description="无效的收货地址"
     *   ),
     *   @SWG\Response(
     *     response="422",
     *     description="删除失败"
     *   ),
     *   @SWG\Response(
     *     response="500",
     *     description="Token校验失败"
     *   ),
     * )
     */
    public function destroy($id)
    {
        //$user = JWTAuth::parseToken()->authenticate();
        //测试 直接查询获取用户
        $user = Member::find(12);
        //测试 正式的无需使用这个 jwt获取不到用户会直接返回错误了
        if (empty($user)) {
            return $this->response->error('无效用户',401);
        }
        $address = $user->address->find($id);
        if(empty($address)){
            return $this->response->error('无效地址',404);
        }
        $bool = $address->delete();
        if($bool){
            return $this->response->accepted();
        }else{
            return $this->response->error('删除失败');
        }
    }
}
