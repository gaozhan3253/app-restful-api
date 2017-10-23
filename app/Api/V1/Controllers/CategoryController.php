<?php

namespace App\Api\V1\Controllers;

use App\Api\BaseController;
use App\Api\V1\Transformers\CategoryTransformer;
use App\models\Category;
use Dingo\Api\Contract\Http\Request;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

/**
 *   @SWG\Tag(
 *     name="Categorys",
 *     description="商品栏目",
 *   ),
 */
class CategoryController extends BaseController
{
    /**
     * @SWG\Get(path="/api/categorys",
     *   tags={"Categorys"},
     *   summary="获取商品栏目列表",
     *   description="该接口不需要登录。",
     *   operationId="address",
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
     *     name="cid",
     *     type="string",
     *     description="商品栏目的父栏目ID 有传入时,会获取这个栏目的所有子栏目",
     *     required=false,
     *   ),
     *   @SWG\Response(
     *     response="200",
     *     description="商品栏目列表"
     *   ),
     *   @SWG\Response(
     *     response="404",
     *     description="无栏目信息"
     *   ),
     * )
     */
    public function index(Request $request)
    {
        //cID
        $cid =$request->input('cid','');
        //缓存有效时间 10分钟
        $expiresAt = Carbon::now()->addMinutes(30);
        // 通过缓存获取栏目列表 缓存有效期10分钟
        $categorys = Cache::store('redis')->remember('categorys'.$cid, $expiresAt, function () use( $cid ){
            //缓存过期不存在时 数据库查询
            $categorys = Category::getCategory($cid);  //获取栏目信息 传入cid的话 会取出当前cid下所有栏目
            if(empty($categorys)){
                return $this->response->error('无栏目信息',404);
            }
            $categorys = collect($categorys); //经过子孙树查找 会将collection对象列表的数据转成array 现在回转成对象
            return $categorys;
        });

//        //获取栏目信息 传入cid的话 会取出当前cid下所有栏目
//        $categorys =Category::getCategory($cid);
//        if(empty($categorys)){
//            return $this->response->error('无栏目信息',404);
//        }
//        //经过子孙树查找 会将collection对象列表的数据转成array 现在回转成对象
//        $categorys = collect($categorys);

        //返回json
        return $this->response->collection($categorys, new CategoryTransformer())
            ->setMeta(['message' => '获取成功', 'status' => 'success', 'status_code' => 200])
            ->statusCode(200);
    }


    /**
     * @SWG\Get(path="/api/categorys/{id}",
     *   tags={"Categorys"},
     *   summary="获取指定栏目信息",
     *   description="该接口不需要登录。",
     *   operationId="address",
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
     *     description="无此栏目"
     *   ),
     * )
     */
    public function show($id)
    {
            $expiresAt = Carbon::now()->addMinutes(30);
            $category = Cache::store('redis')->remember('category_' . $id, $expiresAt, function () use($id){
                $item =  Category::where(['status' => 1])->find($id);
                if(empty($item)){
                    return $this->response->error('无此栏目',404);
                }
                return $item;
            });

            if (empty($category)) {
                return $this->response->error('无此栏目',404);
            }
            return $this->response->item($category, new CategoryTransformer());

    }
}
