<?php

namespace App\Api\V1\Controllers;

use App\Api\BaseController;
use App\Api\V1\Transformers\CategoryTransformer;
use App\models\Category;
use Dingo\Api\Http\Request;
use Mockery\CountValidator\Exception;


class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorys = Category::where(['status' => 1])->get();
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
        try{
            $category = Category::where(['status'=>1])->find($id);
            if(empty($category)){
                return $this->response->error('无此栏目',404);
            }
            return $this->response->item($category, new CategoryTransformer());
        }catch (Exception $e){
            throw new Exception($e->getMessage(),$e->getCode());
        }

    }
}
