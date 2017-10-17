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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //页码
        $page = $request->input('page',1);
        //缓存有效时间 10分钟
        $expiresAt = Carbon::now()->addMinutes(30);
        //通过缓存获取栏目列表 缓存有效期10分钟
        $goods = Cache::store('redis')->remember('goods_page_'.$page, $expiresAt, function () {
            //缓存过期不存在时 数据库查询
            return Good::where(['status'=>1])->paginate(100);
        });
        return $this->response->paginator($goods,new GoodListTransformer());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $expiresAt = Carbon::now()->addMinutes(60);
        $good = Cache::store('redis')->remember('good_' . $id, $expiresAt, function () use($id){
            $item = Good::where(['status'=>1])->find($id);
            if (empty($item)) {
                throw new Exception('无此商品',404);
            }
            return $item;
        });

        if (empty($good)) {
            throw new Exception('无此商品',404);
        }

        return $this->response->item($good,new GoodTransformer());

    }

}
