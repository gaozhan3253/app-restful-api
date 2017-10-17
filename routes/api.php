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
    });


    $api->get('/test', 'App\Api\V1\Controllers\SystemController@test');


    //登陆 短信登陆
    //注册 短信注册

    //推荐产品列表
    $api->get('/RecommendGoods', 'App\Api\V1\Controllers\IndexController@RecommendGood');

    //分类列表 pid参数
    $api->get('/categorys', 'App\Api\V1\Controllers\CategoryController@index');
    //分类详情 可有可无
    $api->get('/category/{id}', 'App\Api\V1\Controllers\CategoryController@show');


    //有分类产品列表 category_id参数
    $api->get('/goods', 'App\Api\V1\Controllers\GoodController@index');

    //产品详情页
    $api->get('/good/{id}', 'App\Api\V1\Controllers\GoodController@show');

    //获取购物车列表
    $api->get('/carts', 'App\Api\V1\Controllers\CartController@index');

    //加入购物车 数量+1
    $api->post('/addCart', 'App\Api\V1\Controllers\CartController@addCart');

    //移出购物车 数量-1
    $api->post('/delCart', 'App\Api\V1\Controllers\CartController@delCart');

    //购物车详情
    $api->get('/totalCart', 'App\Api\V1\Controllers\CartController@totalCart');

    //获取会员信息
    $api->get('/member', 'App\Api\V1\Controllers\MemberController@index');

    //修改会员信息
    $api->put('/member', 'App\Api\V1\Controllers\MemberController@update');

    //头像修改
    $api->put('/memberLogo', 'App\Api\V1\Controllers\MemberController@updateLogo');

    //密码修改

    //收货地址 增加 修改 删除
    $api->get('/address', 'App\Api\V1\Controllers\MemberController@index');



});

