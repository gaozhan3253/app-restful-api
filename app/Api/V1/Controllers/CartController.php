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
use League\Flysystem\Exception;

class CartController extends BaseController
{
    /**
     * 获取购物车内容
     * @return \Dingo\Api\Http\Response
     * @throws Exception
     */
    public function index()
    {
        //获取当前用户
//        $user = JWTAuth::parseToken()->authenticate();
        //测试 直接查询获取用户
        $user = Member::find(12);
        //测试 正式的无需使用这个 jwt获取不到用户会直接返回错误了
        if (empty($user)) {
            throw new Exception('无效用户', 401);
        }
        //根据用户获取carts
        $carts = Cart::getAllCarts($user);
        //返回
        return $this->response->collection($carts, new CartTransformer);
    }

    /**
     * 获取当前用户购物车统计信息
     * @return mixed price商品总金额 number商品总数量
     * @throws Exception
     */
    public function totalCart()
    {
        //获取当前用户
//        $user = JWTAuth::parseToken()->authenticate();

        //测试获取用户
        $user = Member::where(['status'=>1])->find(12);

        //测试 正式的无需使用这个 jwt获取不到用户会直接返回错误了
        if (empty($user)) {
            throw new Exception('无效用户', 401);
        }

        //获取购物车统计信息
        $total = Cart::getTotalCarts($user);

        return $this->response->array($total);
    }
    /**
     * 添加购物车
     * @param Request $request good_id 商品id number 商品数量 默认1
     * @return \Dingo\Api\Http\Response
     * @throws Exception
     */
    public function addCart(CartPost $request)
    {

//        $user = JWTAuth::parseToken()->authenticate();
        //测试 直接查询获取用户
        $user = Member::where(['status'=>1])->find(12);
        //测试 正式的无需使用这个 jwt获取不到用户会直接返回错误了
        if (empty($user)) {
            throw new Exception('无效用户', 401);
        }

        $good_id = $request->input('good_id');
        $number = $request->input('number', 1);

        //查询商品信息
        $good = Good::where(['status'=>1,'id'=>$good_id])->first();
        if (empty($good)) {
            throw new Exception('无效商品', 404);
        }

        //添加购物车
        Cart::addCart($user,$good,$number);
        return $this->response->accepted();
    }

    /**
     * 将商品从购物车中减少
     * @param CartPost $request good_id 商品id  number 减少的数量 减少的数量超过购物车中数量 会删除
     * @return \Dingo\Api\Http\Response|void
     * @throws Exception
     */
    public function delCart(CartPost $request)
    {
//      $user = JWTAuth::parseToken()->authenticate();
        //测试 直接查询获取用户
        $user = Member::where(['status'=>1])->find(12);
        //测试 正式的无需使用这个 jwt获取不到用户会直接返回错误了
        if (empty($user)) {
            throw new Exception('无效用户', 401);
        }

        $good_id = $request->input('good_id');
        $number = $request->input('number', 1);

        //查询商品信息
        $good = Good::where(['status'=>1,'id'=>$good_id])->first();
        if (empty($good)) {
            throw new Exception('无效商品', 404);
        }

        //查询购物车信息
        $goodCart = Cart::checkGoodInCart($user->id,$good->id);
        if(empty($goodCart)){
            return $this->response->error('购物车无此商品',404);
        }

        //删除购物车商品
        Cart::delCart($goodCart,$number);

        return $this->response->accepted();
    }



}
















