<?php

namespace App\Api\V1\Controllers;

use App\Api\BaseController;
use App\Api\V1\Transformers\GoodListTransformer;
use App\Api\V1\Transformers\GoodTransformer;
use App\models\Good;
use Dingo\Api\Http\Request;
use Mockery\CountValidator\Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;


class GoodController extends BaseController
{
    /**
     * 商品列表
     * @param Request $request page 页码 category_id 指定栏目
     * @return \Dingo\Api\Http\Response
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
     * 商品详情
     *
     * @param  int  $id 商品ID
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//
//        $expiresAt = Carbon::now()->addMinutes(60);
//        $good = Cache::store('redis')->remember('good_' . $id, $expiresAt, function () use($id){
//            $item = Good::where(['status'=>1])->find($id);
//            if (empty($item)) {
//                throw new Exception('无此商品',404);
//            }
//            return $item;
//        });

        $good = Good::where(['status'=>1])->find($id);

        if (empty($good)) {
            throw new Exception('无此商品',404);
        }

        return $this->response->item($good,new GoodTransformer());

    }

    /**
     * 推荐产品 关联的hot字段
     * @param Request $request num指定获取的数量
     * @return \Dingo\Api\Http\Response
     */
    public function recommend(Request $request)
    {
        $num = $request->input('num','10');
//        //缓存有效时间 10分钟
//        $expiresAt = Carbon::now()->addMinutes(30);
//      //通过缓存获取栏目列表 缓存有效期10分钟
//        $goods = Cache::store('redis')->remember('recommendgoods'.$num, $expiresAt, function ()  use ($num){
//            //缓存过期不存在时 数据库查询
//            return  Good()::getRecommend($num);
//
//        });
        $goods = Good::getRecommend($num);

        return $this->response->collection($goods,new GoodListTransformer());
    }


}
