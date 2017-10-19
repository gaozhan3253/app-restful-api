<?php

namespace App\Api\V1\Controllers;

use App\Api\BaseController;
use App\Api\V1\Transformers\GoodListTransformer;
use App\Api\V1\Transformers\GoodTransformer;
use App\models\Good;
use Dingo\Api\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;


/**
 *   @SWG\Tag(
 *     name="Goods",
 *     description="商品",
 *   ),
 */
class GoodController extends BaseController
{

    /**
     * @SWG\Get(path="/api/goods",
     *   tags={"Goods"},
     *   summary="获取商品列表",
     *   description="该接口不需要登录。",
     *   operationId="goods",
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
     *     in="query",
     *     name="page",
     *     type="string",
     *     description="页码",
     *     required=false,
     *   ),
     *@SWG\Parameter(
     *     in="query",
     *     name="category_id",
     *     type="string",
     *     description="栏目ID",
     *     required=false,
     *   ),
     *   @SWG\Response(
     *     response="200",
     *     description="商品列表"
     *   ),
     * )
     */
    public function index(Request $request)
    {
        //栏目
        $category_id = $request->input('category_id',0);
        //页码
        $page = $request->input('page',1);
//        //缓存有效时间 10分钟
//        $expiresAt = Carbon::now()->addMinutes(30);
//        //通过缓存获取栏目列表 缓存有效期10分钟
//        $goods = Cache::store('redis')->remember('goods_category_'.$category_id.'_page_'.$page, $expiresAt, function () use( $category_id ) {
//            //缓存过期不存在时 数据库查询
//            return Good::getGoods($category_id,100);
//        });
        $goods = Good::getGoods($category_id,100);

        return $this->response->paginator($goods,new GoodListTransformer());
    }


    /**
     * @SWG\Get(path="/api/goods/{id}",
     *   tags={"Goods"},
     *   summary="获取指定商品信息",
     *   description="该接口不需要登录。",
     *   operationId="goods",
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
     *   @SWG\Response(
     *     response="200",
     *     description="获取成功"
     *   ),
     *   @SWG\Response(
     *     response="404",
     *     description="无此商品"
     *   ),
     * )
     */
    public function show($id)
    {

        $expiresAt = Carbon::now()->addMinutes(60);
        $good = Cache::store('redis')->remember('good_' . $id, $expiresAt, function () use($id){
            $item = Good::where(['status'=>1])->find($id);
            if (empty($item)) {
                return $this->response->error('无此商品',404);
            }
            return $item;
        });

//        $good = Good::where(['status'=>1])->find($id);

        if (empty($good)) {
            return $this->response->error('无此商品',404);
        }

        return $this->response->item($good,new GoodTransformer());

    }


    /**
     * @SWG\Get(path="/api/recommendGoods",
     *   tags={"Goods"},
     *   summary="获取推荐商品列表",
     *   description="该接口不需要登录。",
     *   operationId="goods",
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
     *     in="query",
     *     name="number",
     *     type="string",
     *     description="获取的数量 默认为10",
     *     default="10",
     *     required=false,
     *   ),
     *   @SWG\Response(
     *     response="200",
     *     description="商品列表"
     *   ),
     * )
     */
    public function recommend(Request $request)
    {
        $num = $request->input('number','10');
        //缓存有效时间 10分钟
//        $expiresAt = Carbon::now()->addMinutes(30);
//      //通过缓存获取栏目列表 缓存有效期10分钟
//        $goods = Cache::store('redis')->remember('recommendgoods'.$num, $expiresAt, function ()  use ($num){
//            //缓存过期不存在时 数据库查询
//            return  Good::getRecommend($num);
//
//        });
        $goods = Good::getRecommend($num);

        return $this->response->collection($goods,new GoodListTransformer());
    }


}
