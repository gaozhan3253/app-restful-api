<?php

namespace App\Api\V1\Controllers;

use App\Api\BaseController;
use App\Api\V1\Transformers\CategoryTransformer;
use App\models\Category;
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
    public function index()
    {
//        ini_set('max_execution_time','3600');
            //缓存有效时间 10分钟
            $expiresAt = Carbon::now()->addMinutes(10);
            //通过缓存获取栏目列表 缓存有效期10分钟
            $categorys = Cache::store('redis')->remember('categorys', $expiresAt, function () {
                //缓存过期不存在时 数据库查询
                return Category::on('mysql')->where(['status' => 1])->get();
            });
       
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
            $expiresAt = Carbon::now()->addMinutes(10);
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
