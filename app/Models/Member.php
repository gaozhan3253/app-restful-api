<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;


class Member extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_login', 'password', 'user_nickname','user_email', 'mobile','status','description', 'remember_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_pass', 'remember_token',
    ];

    /**
     * 判断邮箱是否存在
     * @param $email
     * @return Model|null|static
     */
    protected static function  findUserEmail($email) {
        return  Member::where('user_email', $email)->first();
    }




    /**
     * 更新用户资料
     * @param $user
     * @param $request
     */
    public static function updateArchives($user,$request)
    {
        $user->user_nickname = $request->input('nickname');
        $user->avatar = $request->input('avatar','');
        $user->qq = $request->input('qq','');
        $user->wechat = $request->input('wechat','');
        $user->sex = $request->input('sex','');
        $user->save();
    }

    /**
     * 一对多关联 关联购物车
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carts()
    {
        return $this->hasMany('App\Models\Cart','user_id','id');
    }

    /**
     * 一对多关联 关联收货地址
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function address()
    {
        return $this->hasMany('App\Models\MemberAddress','user_id','id');
    }
}
