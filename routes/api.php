<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    
    //数据解密中间件
    $api->group(['middleware'=>'api.decrypt'],function ($api){

        //jwt权限中间件
        $api->group(['middleware'=>'api.jwt.auth'],function ($api){
            $api->get('index', 'App\Api\V1\Controllers\IndexController@index');
            $api->post('index', 'App\Api\V1\Controllers\IndexController@index');
        });


        $api->post('login', 'App\Api\V1\Controllers\PublicController@login');
        $api->post('register', 'App\Api\V1\Controllers\PublicController@register');
        $api->get('updatetoken', 'App\Api\V1\Controllers\PublicController@updateToken');
        $api->get('getservertime', 'App\Api\V1\Controllers\PublicController@getServerTime');
    });


    $api->get('/test', 'App\Api\V1\Controllers\SystemController@test');
    $api->post('/smsVerify', 'App\Api\V1\Controllers\SystemController@smsVerify');
    $api->post('/sendEmail', 'App\Api\V1\Controllers\SystemController@sendEmail');
    $api->post('/checkSmsVerify', 'App\Api\V1\Controllers\SystemController@checkSmsVerify');


    //登陆 短信登陆
    //注册 短信注册

    //分类列表 cid参数 ok
    $api->get('/categorys', 'App\Api\V1\Controllers\CategoryController@index');
    //分类详情 ok
    $api->get('/categorys/{id}', 'App\Api\V1\Controllers\CategoryController@show');


    //有分类产品列表 category_id参数 分页参数 ok
    $api->get('/goods', 'App\Api\V1\Controllers\GoodController@index');

    //推荐产品列表 ok
    $api->get('/recommendGoods', 'App\Api\V1\Controllers\GoodController@recommend');

    //产品详情页 ok
    $api->get('/goods/{id}', 'App\Api\V1\Controllers\GoodController@show');



    //获取购物车列表
    $api->get('/carts', 'App\Api\V1\Controllers\CartController@index');

    //购物车合计 ok
    $api->get('/totalCart', 'App\Api\V1\Controllers\CartController@totalCart');

    //加入购物车 数量+n ok
    $api->post('/addCart', 'App\Api\V1\Controllers\CartController@addCart');

    //移出购物车 数量-n ok
    $api->post('/delCart', 'App\Api\V1\Controllers\CartController@delCart');



    //获取会员信息 ok
    $api->get('/member', 'App\Api\V1\Controllers\MemberController@index');

    //修改会员信息 ok
    $api->put('/member', 'App\Api\V1\Controllers\MemberController@updateArchives');

    //头像上传
    $api->post('/updateImage', 'App\Api\V1\Controllers\SystemController@updateImage');

    //密码修改

    //收货地址列表
    $api->get('/address', 'App\Api\V1\Controllers\AddressController@index');
    //收货地址详情
    $api->get('/address/{id}', 'App\Api\V1\Controllers\AddressController@show');
    //收货地址增加
    $api->post('/address', 'App\Api\V1\Controllers\AddressController@store');
    //收货地址修改
    $api->put('/address/{id}', 'App\Api\V1\Controllers\AddressController@update');
    //收货地址 删除
    $api->delete('/address/{id}', 'App\Api\V1\Controllers\AddressController@destroy');


    //swaggerAPI文档json数据
    $api->get('/getapi', 'App\Api\V1\Controllers\SystemController@getApiDoc');


});

