<?php

namespace App\Api\V1\Controllers;

use App\Api\BaseController;
use App\Api\V1\Transformers\UserTransformer;
use App\Jobs\SendEmail;
use App\Models\Member;
use JWTAuth;
use Dingo\Api\Http\Request;
use App\Api\V1\Requests\IndexPost;


class IndexController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexPost $request)
    {
        $token = JWTAuth::getToken(); //获取传入的token
        $user = JWTAuth::parseToken()->authenticate();
//        dump($user->user_login);
//        dump($request->all());
//        dump($request->session());

//            $this->dispatch( (new SendEmail($user))); //队列
//        return $this->response->item($user,new UserTransformer)->statusCode(200);

//        return $this->response->array(['s']);

//        返回单个信息 item setMeta:指定meta内容 statusCode:指定http响应码
//        $members = Member::find(10);
//        return $this->response->item($members, new UserTransformer())->setMeta(['message'=>'获取成功','status'=>'success','status_code'=>200])->statusCode(200);

//        返回列表 collection
//        $members = Member::get();
//        return $this->response->collection($members,new UserTransformer())->setMeta(['message'=>'获取成功','status'=>'success','status_code'=>200])->statusCode(250);

//        返回分页 和指定元数据
//        $members = Member::paginate(2);
//        return $this->response->paginator($members,new UserTransformer())->withHeader('hh','xx');

//         添加成功 201状态码
//         return $this->response->created()->withHeader('hh','xx');
//         修改成功 202
//         return $this->response->accepted();

//         删除成功 204
//        return $this->response->noContent();

//        返回错误信息 {  message: "This is an error.", status_code: 404}
//        return $this->response->error('This is an error.', 404);

    }


    public function test(Request $request)
    {
        dump($request->all());

//                return $this->response->array(['message'=>'test']);
    }

}
