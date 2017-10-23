<?php

namespace App\Api\V1\Controllers;


use App\Api\BaseController;
use App\Api\V1\Requests\CartPost;
use App\Api\V1\Transformers\CartTransformer;
use App\Models\Cart;
use App\models\Good;
use App\Models\Member;
use Dingo\Api\Contract\Http\Request;
use JWTAuth;

/**
 *   @SWG\Tag(
 *     name="Carts",
 *     description="购物车操作",
 *   ),
 */
class CartController extends BaseController
{

    /**
     * @SWG\Get(path="/api/carts",
     *   tags={"Carts"},
     *   summary="获取当前用户的购物车列表",
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
     *     description="用户购物车商品列表"
     *   ),
     *   @SWG\Response(
     *     response="500",
     *     description="Token校验失败"
     *   ),
     * )
     */
    public function index()
    {
        //获取当前用户
        $user = JWTAuth::parseToken()->authenticate();
//        //测试 直接查询获取用户
//        $user = Member::find(12);
//        //测试 正式的无需使用这个 jwt获取不到用户会直接返回错误了
//        if (empty($user)) {
//            return $this->response->error('无效用户',401);
//        }
        //根据用户获取carts
        $carts = Cart::getAllCarts($user);
        //返回
        return $this->response->collection($carts, new CartTransformer);
    }


    /**
     * @SWG\Get(path="/api/totalCart",
     *   tags={"Carts"},
     *   summary="获取当前用户购物车统计信息",
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
     *     description="用户购物车商品的统计信息 总金额 总数量"
     *   ),
     *   @SWG\Response(
     *     response="500",
     *     description="Token校验失败"
     *   ),
     * )
     */
    public function totalCart()
    {
        //获取当前用户
        $user = JWTAuth::parseToken()->authenticate();

//        //测试获取用户
//        $user = Member::where(['status'=>1])->find(12);
//
//        //测试 正式的无需使用这个 jwt获取不到用户会直接返回错误了
//        if (empty($user)) {
//            return $this->response->error('无效用户',401);
//        }

        //获取购物车统计信息
        $total = Cart::getTotalCarts($user);

        return $this->response->array($total);
    }


    /**
     * @SWG\Post(path="/api/addCart",
     *   tags={"Carts"},
     *   summary="添加商品到购物车",
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
     *     name="good_id",
     *     type="string",
     *     default="无效参数",
     *     description="商品ID (组合后加密到aes-body中 本字段不要单独传递)",
     *     required=true,
     *   ),
     * @SWG\Parameter(
     *     in="formData",
     *     name="number",
     *     type="string",
     *     default="无效参数",
     *     description="商品数量 (组合后加密到aes-body中 本字段不要单独传递)",
     *     required=false,
     *   ),
     *   @SWG\Response(
     *     response="201",
     *     description="添加成功"
     *   ),
     *   @SWG\Response(
     *     response="404",
     *     description="无效商品"
     *   ),
     *   @SWG\Response(
     *     response="500",
     *     description="Token校验失败"
     *   ),
     * )
     */
    public function addCart(CartPost $request)
    {

        $user = JWTAuth::parseToken()->authenticate();
//        //测试 直接查询获取用户
//        $user = Member::where(['status'=>1])->find(12);
//        //测试 正式的无需使用这个 jwt获取不到用户会直接返回错误了
//        if (empty($user)) {
//            return $this->response->error('无效用户',401);
//        }

        $good_id = $request->input('good_id');
        $number = $request->input('number', 1);

        //查询商品信息
        $good = Good::where(['status'=>1,'id'=>$good_id])->first();
        if (empty($good)) {
            return $this->response->error('无效商品',404);
        }

        //添加购物车
        Cart::addCart($user,$good,$number);
        return $this->response->created();
    }

    /**
     * @SWG\Post(path="/api/delCart",
     *   tags={"Carts"},
     *   summary="将商品从购物车中减少/删除",
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
     *     name="good_id",
     *     type="string",
     *     default="无效参数",
     *     description="商品ID (组合后加密到aes-body中 本字段不要单独传递)",
     *     required=true,
     *   ),
     * @SWG\Parameter(
     *     in="formData",
     *     name="number",
     *     type="string",
     *     default="无效参数",
     *     description="商品数量 (组合后加密到aes-body中 本字段不要单独传递)",
     *     required=false,
     *   ),
     *   @SWG\Response(
     *     response="204",
     *     description="减少/删除成功"
     *   ),
     *   @SWG\Response(
     *     response="404",
     *     description="无效商品"
     *   ),
     *   @SWG\Response(
     *     response="500",
     *     description="Token校验失败"
     *   ),
     * )
     */
    public function delCart(CartPost $request)
    {
      $user = JWTAuth::parseToken()->authenticate();
//        //测试 直接查询获取用户
//        $user = Member::where(['status'=>1])->find(12);
//        //测试 正式的无需使用这个 jwt获取不到用户会直接返回错误了
//        if (empty($user)) {
//            return $this->response->error('无效用户',401);
//        }

        $good_id = $request->input('good_id');
        $number = $request->input('number', 1);

        //查询商品信息
        $good = Good::where(['status'=>1,'id'=>$good_id])->first();
        if (empty($good)) {
            return $this->response->error('无效商品',404);
        }

        //查询购物车信息
        $goodCart = Cart::checkGoodInCart($user->id,$good->id);
        if(empty($goodCart)){
            return $this->response->error('购物车无此商品',404);
        }

        //删除购物车商品
        Cart::delCart($goodCart,$number);

        return $this->response->noContent();
    }

}