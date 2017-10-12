<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Route;



class LoginAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard = null)
    {

        //登录判断
        if (!Auth::guard($guard)->check()) {
            //未登录 做判断
            if($guard =='admin'){
                return redirect('/admin/login');
            }else{
                return redirect('/login');
            }
        }
        //权限判断
        if($guard =='admin'){
            //当前用户
            $user = Auth::guard($guard)->user();
            //当前路由名称
            $uri = Route::currentRouteName();

            //转数组
            $url = explode('.',$uri);
            //循环处理
            for($i=0;$i<2;$i++){
                //为空的补全index
                if(empty($url[$i])){
                    $url[$i] = 'index';
                }
                //为数字的去除
                if(is_numeric($url[$i])){
                    unset($url[$i]);
                }else{
                    //处理权限命名问题 如添加 展示页为create 提交页为store 这里统一一下好判断权限
                    if($url[$i] =='store'){
                        $url[$i] ='create';
                    }
                    if($url[$i] =='update'){
                        $url[$i] ='edit';
                    }
                }
            }
            $url = implode('.',$url);

            if(!$user->can($url)){
                return redirect('/admin/index');
            }
        }


        return $next($request);
    }
}
