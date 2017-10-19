<?php

namespace App\Api\V1\Controllers;


use App\Api\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * @SWG\Tag(
 *     name="System",
 *     description="其它服务"
 * )
 * Class SystemController
 * @package App\Api\V1\Controllers
 */
class SystemController extends BaseController
{
    /**
     * @SWG\Post(path="/api/updateImage",
     *   tags={"System"},
     *   summary="图片上传",
     *   description="该接口需要登录",
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
     *     description="使用随机AES加密字符串加密后的Header信息 包含版本、请求时间、Token等信息",
     *     required=true,
     *   ),
     *@SWG\Parameter(
     *     in="formData",
     *     name="filename",
     *     type="file",
     *     description="文件上传",
     *     required=false,
     *   ),
     *   @SWG\Response(
     *     response="200",
     *     description="图片地址"
     *   ),
     * )
     */
    public function updateImage(Request $request)
    {
        $path = Storage::putFile('/upload', $request->file('filename'));
        return $this->response->array(['path'=>$path]);
    }





    /**
     * @SWG\Swagger(
     *   schemes={"http"},
     *   host="localhost/app-restful-api/public",
     *   consumes={"multipart/form-data"},
     *   produces={"application/json"},
     *   @SWG\Info(
     *     version="1.0",
     *     title="shopapp",
     *     description="shopapp 接口文档, V1.0."
     *   ),
     * )
     */
    public function getApiDoc()
    {
        $swagger = \Swagger\scan(app_path('Api/V1/Controllers/'));
        return response()->json($swagger, 200);
    }
}
