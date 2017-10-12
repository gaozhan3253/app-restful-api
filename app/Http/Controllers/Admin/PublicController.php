<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests\adminLoginPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Gregwar\Captcha\CaptchaBuilder;
use Session;
use Log;

class PublicController extends Controller
{

    /**
     * 登录界面展示
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login()
    {
        Log::info('public.login.'.rand(0,9));

        return view('admin.public.login');
    }

    /**
     * 登录响应
     * @param adminLoginPost $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function loginAct(adminLoginPost $request)
    {
        //接收参数
        $user = $request->input('email', '');
        $passwd = $request->input('password', '');
        $autoLogin = $request->input('online', 0);
        $verify = $request->input('verify', '');

        //校验验证码
        if (Session::get('verify_code') !== $verify) {
            return back()->withErrors( '验证码错误')->withInput();
        }

        //验证登录
        if (Auth::guard('admin')->attempt(['name' => $user, 'password' => $passwd],$autoLogin)) {
            return redirect()->intended('/admin/index');
        } else {
            return back()->withErrors('账号或密码错误')->withInput();
        }
    }

    /**
     * 退出登录
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->intended('/admin/login');
    }


    /**
     * 图片验证码
     */
    public function verify()
    {
        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 100, $height = 40, $font = null);
        // 设置背景颜色
        $builder->setBackgroundColor(220, 210, 230);
        $builder->setMaxAngle(25);
        $builder->setMaxBehindLines(0);
        $builder->setMaxFrontLines(0);
        //获取验证码的内容
        $phrase = $builder->getPhrase();


        //把内容存入session
        Session::flash('verify_code', $phrase);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
    }
}
