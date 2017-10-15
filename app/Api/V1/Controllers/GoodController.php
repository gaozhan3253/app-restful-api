<?php

namespace App\Api\V1\Controllers;

use App\Api\BaseController;
use App\Api\V1\Transformers\GoodListTransformer;
use App\Api\V1\Transformers\GoodTransformer;
use App\models\Good;
use Mockery\CountValidator\Exception;

class GoodController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goods = Good::where(['status'=>1])->paginate(1);
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
        try{
            $good = Good::where(['status'=>1])->find($id);
            if(empty($good)){
                return $this->response->error('无此商品',404);
            }
            return $this->response->item($good,new GoodTransformer());
        }catch (Exception $e)
        {
            throw new Exception($e->getMessage(),$e->getCode());
        }
    }

}
