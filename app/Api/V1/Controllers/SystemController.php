<?php

namespace App\Api\V1\Controllers;


use App\Api\BaseController;
use App\Api\V1\Requests\SendEmailPost;
use App\Api\V1\Requests\UploadImagePost;
use App\Jobs\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SmsManager;

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
     *   @SWG\Response(
     *     response="422",
     *     description="文件不正确"
     *   ),
     * )
     */
    public function updateImage(UploadImagePost $request)
    {
        $path = Storage::putFile('/upload', $request->file('filename'));
        return $this->response->array(['path'=>$path]);
    }


    public function sendEmail(SendEmailPost $request)
    {
        $email = $request->input('email');
        $this->dispatch((new SendEmail($email))->onQueue('emails'));
        return $this->response->accepted();
    }

    public function checkSmsVerify()
    {

    }

    /**
     * @SWG\Post(path="/api/smsVerify",
     *   tags={"System"},
     *   summary="短信验证码",
     *   description="该接口不需要登录",
     *   operationId="smsVerify",
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
     *     description="使用随机AES加密字符串加密后的Header信息 包含版本、请求时间、等信息",
     *     required=true,
     *   ),
     *@SWG\Parameter(
     *     in="formData",
     *     name="mobile",
     *     type="file",
     *     description="接收短信的号码",
     *     required=true,
     *   ),
     *   @SWG\Response(
     *     response="202",
     *     description="发送成功"
     *   ),
     *   @SWG\Response(
     *     response="500",
     *     description="短信配置失败"
     *   ),
     *   @SWG\Response(
     *     response="422",
     *     description="参数校验失败"
     *   ),
     *   @SWG\Response(
     *     response="404",
     *     description="发送失败"
     *   ),
     * )
     */
    public function smsVerify(Request $request)
    {
        //接收手机号码
        $mobile = $request->input('mobile','');
        $result = SmsManager::validateSendable();
        if($result['success'] == false){
            return $this->response->error($result['message'],500);
        }

        $result = SmsManager::validateFields();
        if($result['success'] == false){
            return $this->response->error($result['message'],422);
        }

        $result = SmsManager::requestVerifySms();
        if($result['success'] == false){
            return $this->response->error($result['message'],404);
        }else{
            return $this->response->accepted();
        }
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
