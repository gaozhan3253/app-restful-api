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
        $api->post('test', 'App\Api\V1\Controllers\IndexController@test');


        //jwt权限中间件
        $api->group(['middleware'=>'api.jwt.auth'],function ($api){
            $api->get('index', 'App\Api\V1\Controllers\IndexController@index');
            $api->post('index', 'App\Api\V1\Controllers\IndexController@index');
        });

        $api->post('login', 'App\Api\V1\Controllers\PublicController@login');
        $api->post('register', 'App\Api\V1\Controllers\PublicController@register');
        $api->get('updatetoken', 'App\Api\V1\Controllers\PublicController@updateToken');
    });
});

