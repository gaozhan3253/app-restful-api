<?php

namespace App\Api\V1\Controllers;

use App\Api\BaseController;
use App\Api\V1\Transformers\CategoryTransformer;
use App\models\Category;
use Dingo\Api\Contract\Http\Request;
use Mockery\CountValidator\Exception;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //PID
        $cid =$request->input('cid','');
        //缓存有效时间 10分钟
        $expiresAt = Carbon::now()->addMinutes(30);
        //通过缓存获取栏目列表 缓存有效期10分钟
//        $categorys = Cache::store('redis')->remember('categorys'.$cid, $expiresAt, function () use( $cid ){
//            //缓存过期不存在时 数据库查询
//        $categorys = Category::getCategory($cid)  //获取栏目信息 传入cid的话 会取出当前cid下所有栏目
//        if(empty($categorys)){
//            throw new Exception('无栏目信息', 404);
//        }
//        $categorys = collect($categorys); //经过子孙树查找 会将collection对象列表的数据转成array 现在回转成对象
//            return $categorys;
//        });


        //获取栏目信息 传入cid的话 会取出当前cid下所有栏目
        $categorys =Category::getCategory($cid);
        if(empty($categorys)){
            throw new Exception('无栏目信息', 404);
        }
        //经过子孙树查找 会将collection对象列表的数据转成array 现在回转成对象
        $categorys = collect($categorys);

        //返回json
        return $this->response->collection($categorys, new CategoryTransformer())
            ->setMeta(['message' => '获取成功', 'status' => 'success', 'status_code' => 200])
            ->statusCode(200);
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
            $expiresAt = Carbon::now()->addMinutes(30);
            $category = Cache::store('redis')->remember('category_' . $id, $expiresAt, function () use($id){
                $item =  Category::where(['status' => 1])->find($id);
                if(empty($item)){
                    throw new Exception('无此栏目', 404);
                }
                return $item;
            });

            if (empty($category)) {
                throw new Exception('无此栏目', 404);
            }
            return $this->response->item($category, new CategoryTransformer());

    }
}
